<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\Region;
use App\Models\Service;
use App\Models\Stantion;
use App\Models\TrainRoad;
use App\MyDesigns\Interfaces\ProductRepositoryInterface;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Auth;

class PurchasesController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('general');
    }

	public function trainCar(Region $region, ProductCart $productCart)
	{
		$regionsWithRelations = $region->with('train_road.stantion')->get();
//		$regions = $region->all();
//		$regionsWithRelations = [];
//		foreach($regions as $key => $oneRegion) {
//			$regionsWithRelations[$key] = $region->with('train_road.stantion')->where('id',$oneRegion->id)->first();
//		}
		$sumAndCount = $this->getGeneralViewOfCart($productCart);

        $regionsWithoutEmptyDepos = [];
		$keysForUnset = [];
//**********************************************************************
        foreach($regionsWithRelations as $oneRegion) {
            foreach($oneRegion->train_road as $trKey => $tr ) {
                if(count($tr->stantion)) {
					if( ! isset($regionsWithoutEmptyDepos[$oneRegion->id])) {
						$regionsWithoutEmptyDepos[$oneRegion->id] = $oneRegion;
					}
					foreach($tr->stantion as $depoKey => $depo) {
						$flag = true;
						foreach($depo->price as $price) {
							if($price->amount) {
								$flag = true;
							} else {
								$flag = false;
							}
						}
						if( ! $flag) {
							$keysForUnset[] = ['region'=>$oneRegion->id, 'tr'=>$trKey, 'depo'=>$depoKey];
						}
					}
                } /*else {
					$keysForUnset[] = ['region'=>$oneRegion->id, 'tr'=>$trKey];
				}*/
            }
        }
		foreach($keysForUnset as $key) {
			if(isset($regionsWithoutEmptyDepos[$key['region']])) {
				unset($regionsWithoutEmptyDepos[$key['region']]->train_road[$key['tr']]->stantion [$key['depo']]);
			}
		}
//************************************************************************

		$regionsWithoutEmptyDeposNew = [];
		$keysForUnset = [];
//**************************************************
        foreach($regionsWithoutEmptyDepos as $oneRegion) {
            foreach($oneRegion->train_road as $trKey => $tr ) {
                if(count($tr->stantion)) {
					if( ! isset($regionsWithoutEmptyDeposNew[$oneRegion->id])) {
						$regionsWithoutEmptyDeposNew[$oneRegion->id] = $oneRegion;
					}
                } else {
					$keysForUnset[] = ['region'=>$oneRegion->id, 'tr'=>$trKey];
				}
            }
        }

		foreach($keysForUnset as $key) {
			if(isset($regionsWithoutEmptyDepos[$key['region']])) {
				unset($regionsWithoutEmptyDepos[$key['region']]->train_road [$key['tr']]);
			}
		}

		return view('purchases.trainCar', [
			                                'p'=>'purchases',
//											'regions'=>$regionsWithRelations,
											'regions'=>$regionsWithoutEmptyDeposNew,
											'productsCount'=>$sumAndCount['productsCount'],
											'productsSum'=>$sumAndCount['productsSum']
		]);
	}

//	public function trainCarService(Region $region)
//	{
//		$regions = $region->all();
//		return view('purchases.trainCarService', ['regions'=>$regions]);
//	}

	public function getPriceList($depoID, ProductCart $productCart)
	{
		$depo = Stantion::with('price.product.category')->where('id',$depoID)->first();

		$categoriesArr = [];

		if(Auth::guest()) {
			$userID = 0;
		} else {
			$userID = Auth::user()->id;
		}

		foreach($depo->price as $price) {
			if($price->product[0]->category) {
				$key = $price->product[0]->category->category;
			} else {
				$key = 'Прочие товары';
			}
            if(($price->price > 0) && ($price->amount >0)) {
                $categoriesArr[$key][] =[
                    'name'=>$price->product[0]->name,
                    'product_id'=>$price->product[0]->id,
                    'depo_id'=>$depo->id,
                    'price_id'=>$price->id,
                    'article'=>$price->product[0]->article,
                    'description'=>$price->product[0]->description,
                    'price'=>$price->price,
                    'amount'=>$price->amount,
                ];
            }
		}
		$sumAndCount = $this->getGeneralViewOfCart($productCart);

		return view('purchases.trainCarPriceList', [
                                                        'p'=>'purchases',
														'categoriesArr'=>$categoriesArr,
														'depoName'=>$depo->stantion_name,
                                                        'depoId'=>$depoID,
														'userID'=>$userID,
														'productsCount'=>$sumAndCount['productsCount'],
														'productsSum'=>$sumAndCount['productsSum']
		]);
	}

	public function showTrainCarProduct($id, $depoId, ProductRepositoryInterface $productFromRepository, ProductCart $cart)
	{
		try{
			$product = Product::with(['price', 'price.stantion'])->where('id', $id)->first();
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		if( ! $product) {
			abort(404);
		}

		if($product->category_id) {
			$productParams = $productFromRepository->getProductProperties($id, true);
		} else {
			$productParams = $productFromRepository->getProductProperties($id, false);
		}

		$prices = $product->price;

		$pricesArr = [];
		foreach($prices as $price) {
            if(($price->price > 0) && ($price->amount >0)) {
                $pricesArr[$price->stantion[0]->train_road->tr_name][] = [
                    'stantion_name' => $price->stantion[0]->stantion_name,
                    'stantion_id' => $price->stantion[0]->id,
                    'price_id' => $price->id,
                    'product_id' => $product->id,
                    'price' => $price->price,
                    'amount' => $price->amount,
                ];
            }
		}
		unset($prices);

		if(Auth::guest()) {
			$userID = 0;
		} else {
			$userID = Auth::user()->id;
		}

		$sumAndCount = $this->getGeneralViewOfCart($cart);

		return view('purchases.showTrainCarProduct',[
			                                            'p'=>'purchases',
														'depoId'=>$depoId,
														'productParams'=>$productParams,
														'prices'=>$pricesArr,
														'product'=>$product,
														'userID'=>$userID,
														'productsCount'=>$sumAndCount['productsCount'],
														'productsSum'=>$sumAndCount['productsSum']
		]);
	}

    public function getPriceListInCurrentCategory( ProductCart $productCart, $categoryName, $depoId) {
        $category = Category::with('product.price.stantion.train_road')->where('category',$categoryName)->first();

        $stantion = Stantion::where('id',$depoId)->first();
        $depoName = $stantion->stantion_name;

        $productsArr = [];

        if(Auth::guest()) {
            $userID = 0;
        } else {
            $userID = Auth::user()->id;
        }

        foreach($category->product as $product) {
            foreach($product->price as $price) {
                if (($price->price > 0) && ($price->amount > 0)) {
                    $productsArr[$price->stantion[0]->train_road->tr_name][$price->stantion[0]->stantion_name][] = [
                        'name' => $product->name,
                        'product_id' => $product->id,
                        'depo_id' => $price->stantion[0]->id,
                        'price_id' => $price->id,
                        'article' => $product->article,
                        'description' => $product->description,
                        'price' => $price->price,
                        'amount' => $price->amount,
                    ];
                }
            }
        }

        $sumAndCount = $this->getGeneralViewOfCart($productCart);

        return view('purchases.trainCarPriceListInCurrentCategory', [
			'p'=>'purchases',
            'productsArr'=>$productsArr,
            'category'=>$categoryName,
            'userID'=>$userID,
            'productsCount'=>$sumAndCount['productsCount'],
            'productsSum'=>$sumAndCount['productsSum'],
            'whatDepoIdWeAre'=>$depoId,
            'whatDepoNameWeAre'=>$depoName,
        ]);
    }

	private function getGeneralViewOfCart($productCart) {
		//корзина
		if(Auth::guest()) {
			$productsCount = 0;
			$productsSum = 0;
		} else {
			$productsFromUserCart = $productCart->with('price')->where('user_id', Auth::user()->id)->get();
			$productsCount = 0;
			$productsSum = 0;
			foreach($productsFromUserCart as $item) {
				$productsSum += $item->price->price * $item->product_count;
				$productsCount += $item->product_count;
			}
		}
		return ['productsSum'=>$productsSum, 'productsCount'=>$productsCount];
	}

    public function trainCarService(ProductCart $productCart) {
        $services = Service::all();
        $sumAndCount = $this->getGeneralViewOfCart($productCart);
        if(Auth::guest()) {
            $userID = 0;
        } else {
            $userID = Auth::user()->id;
        }
        return view('purchases.servicePriceList', ['services' => $services,'productsCount'=>$sumAndCount['productsCount'],
            'userID'=>$userID, 'productsSum'=>$sumAndCount['productsSum'], 'p'=>'purchases']);
    }
}

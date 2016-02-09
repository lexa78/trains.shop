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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
//	public function index()
//	{
//		return view('purchases.purchases');
//	}

	public function trainCar(Region $region, ProductCart $productCart)
	{
		$regions = $region->all();
		$regionsWithRelations = [];
		foreach($regions as $oneRegion) {
			$regionsWithRelations[] = $region->with('train_road.stantion')->where('id',$oneRegion->id)->first();
		}

		$sumAndCount = $this->getGeneralViewOfCart($productCart);

		return view('purchases.trainCar', [
											'regions'=>$regionsWithRelations,
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
		$depo = Stantion::with('price.product.category','price.product.factory','price.product.year')->where('id',$depoID)->first();

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
                    'year'=>$price->product[0]->year->year,
                    'factory_code'=>$price->product[0]->factory->factory_code,
                    'factory_name'=>$price->product[0]->factory->factory_name,
                    'price'=>$price->price,
                    'amount'=>$price->amount,
                ];
            }
		}

		$sumAndCount = $this->getGeneralViewOfCart($productCart);

		return view('purchases.trainCarPriceList', [
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
        $category = Category::with('product.price.stantion.train_road','product.year','product.factory')->where('category',$categoryName)->first();

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
                        'year' => $product->year->year,
                        'factory_code' => $product->factory->factory_code,
                        'factory_name' => $product->factory->factory_name,
                        'price' => $price->price,
                        'amount' => $price->amount,
                    ];
                }
            }
        }

        $sumAndCount = $this->getGeneralViewOfCart($productCart);

        return view('purchases.trainCarPriceListInCurrentCategory', [
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
}

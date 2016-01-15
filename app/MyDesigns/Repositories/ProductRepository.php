<?php
namespace App\MyDesigns\Repositories;


use App\MyDesigns\Interfaces\ProductRepositoryInterface;
use DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function getProductProperties($id, $categories = false)
    {
        if($categories) {
            return DB::table('products')
                ->join('years', 'years.id', '=', 'products.year_id')
                ->join('conditions', 'conditions.id', '=', 'products.condition_id')
                ->join('factories', 'factories.id', '=', 'products.factory_id')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->where('products.id',$id)
                ->select('years.year', 'conditions.condition', 'factories.factory_name', 'factories.factory_code', 'categories.category')
                ->get();
        } else {
            return DB::table('products')
                ->join('years', 'years.id', '=', 'products.year_id')
                ->join('conditions', 'conditions.id', '=', 'products.condition_id')
                ->join('factories', 'factories.id', '=', 'products.factory_id')
                ->where('products.id',$id)
                ->select('years.year', 'conditions.condition', 'factories.factory_name', 'factories.factory_code')
                ->get();
        }
    }
}
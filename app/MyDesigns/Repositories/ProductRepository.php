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
                ->join('conditions', 'conditions.id', '=', 'products.condition_id')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->where('products.id',$id)
                ->select('conditions.condition', 'categories.category')
                ->get();
        } else {
            return DB::table('products')
                ->join('conditions', 'conditions.id', '=', 'products.condition_id')
                ->where('products.id',$id)
                ->select('conditions.condition')
                ->get();
        }
    }
}
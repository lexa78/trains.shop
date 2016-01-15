<?php
namespace App\MyDesigns\Interfaces;

interface ProductRepositoryInterface
{
    public function getProductProperties($id, $categories);
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
   public function index(Request $request){
    
    $products = Product::with('category', 'brand')
                        ->orderBy('score', 'desc')
                        ->paginate(2); 
    
    $pagination = [
        'total' =>$products->total(),
        'current_page' => $products->currentPage(),
        'per_page' => $products->perPage(),
        'last_page' => $products->lastPage(),
        'from' => $products->firstItem(),
        'to' => $products->lastPage(),
    ];
  
    $results = [
        'pagination' => $pagination,
        'products'   => $products
    ];

    return $results;
   }

   public function searchProduct(Request $request){
    $text = strtolower($request->text);
    
    $products = Product::select('products.*')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->join('brands', 'products.brand_id', '=', 'brands.id')
                        ->orWhereRaw("lower(products.name) like '%$text%' ")
                        ->orWhereRaw("lower(categories.name) like '%$text%'")
                        ->orWhereRaw("lower(brands.name) like '%$text%'")
                        ->with('category', 'brand')
                        ->paginate(2);

                        //dd($products->toSql());

    $pagination = [
            'total' =>$products->total(),
            'current_page' => $products->currentPage(),
            'per_page' => $products->perPage(),
            'last_page' => $products->lastPage(),
            'from' => $products->firstItem(),
            'to' => $products->lastPage(),
        ];
      
    $results = [
            'pagination' => $pagination,
            'products'   => $products
        ];

    return $results;
   }


}

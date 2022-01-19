<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ForHerController extends Controller
{
    public function index(Request $request)
    {
        $sorter = $request->sorter;
        $products = Product::with('category')->where('type', 0);
        if(!empty($sorter) && $sorter == CHAR_A_Z) {
            $products = $products->orderBy('name', 'asc');
        }
        if(!empty($sorter) && $sorter == CHAR_Z_A) {
            $products = $products->orderBy('name', 'desc');
        }
        if(!empty($sorter) && $sorter == ASC) {
            $products = $products->orderBy('price', 'asc');
        }
        if(!empty($sorter) && $sorter == DESC) {
            $products = $products->orderBy('price', 'desc');
        }
        if(!empty($sorter) && $sorter == LATEST_SORT) {
            $products = $products->orderBy('updated_at', 'desc');
        }
        $products = $products->paginate(8);
        $categories = Category::where('name', 'LIKE', 'nu')->get();
        $for_him = 'for her';
//        dd($products);
        return view('layout.for-him.index', compact( 'products','categories', 'for_him'));
    }
    protected function filterCategory(Request $request)
    {
        $products = Product::with('category');
        $sorter = $request->sorter ?? "";
        $cat = $request->cat;
        if(!empty($sorter) && $sorter == CHAR_A_Z) {
            $products = $products->orderBy('name', 'asc');
        }
        if(!empty($sorter) && $sorter == CHAR_Z_A) {
            $products = $products->orderBy('name', 'desc');
        }
        if(!empty($sorter) && $sorter == ASC) {
            $products = $products->orderBy('price', 'asc');
        }
        if(!empty($sorter) && $sorter == DESC) {
            $products = $products->orderBy('price', 'desc');
        }
        if (!empty($sorter) && $sorter == LATEST_SORT) {
            $products = $products->orderBy('updated_at', 'desc');
        }
        $products = $products->whereHas('category', function ($q) use ($cat) {
            $q->where('categoryvi', 'LIKE', $cat);
        });
        $for_him = 'for her';
        $categories = Category::where('name', 'LIKE', 'nu')->get();
        $products = $products->paginate(8);
        $page_title = Category::where('name', 'LIKE', 'nu')->where('categoryvi', 'LIKE', $cat)->first();
//        dd($products, $page_title);
        return view('layout.for-him.product-category', compact( 'products', 'cat','for_him','categories', 'page_title'));

    }
}

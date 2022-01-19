<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ForHimController extends Controller
{
    public function index(Request $request)
    {
        $sorter = $request->sorter;
        $products = Product::with('category')->where('type', 1);
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
        $categories = Category::where('name', 'LIKE', 'nam')->get();
        $for_him = 'for him';
//        dd($products);
        return view('layout.for-him.index', compact( 'products','categories', 'for_him'));
    }
    protected function filterCategory(Request $request)
    {
        $products = Product::with('category')->where('type', 1);
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
        $for_him = 'for him';
        $categories = Category::where('name', 'LIKE', 'nam')->get();
        $products = $products->paginate(8);
        $page_title = Category::where('name', 'LIKE', 'nam')->where('categoryvi', 'LIKE', $cat)->first();
//        dd($products, $page_title);
        return view('layout.for-him.product-category', compact( 'products', 'cat','for_him','categories', 'page_title'));

    }
}

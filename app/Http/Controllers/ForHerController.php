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
        $categories = Category::where('cat_name', 'LIKE', 'nữ')->get();
        $slug = FOR_HER;
        $page_title = "Simple - For Her";
        $id = 0;
//        dd($products);
        return view('layout.product.index', compact( 'products','categories', 'slug', 'page_title', 'id'));
    }
    protected function filterCategory(Request $request)
    {
        $products = Product::with('category')->where('type', 0);
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
        $title = FOR_HER;
        $categories = Category::where('cat_name', 'LIKE', 'nữ')->get();
        $products = $products->paginate(8);
        $page_title = Category::where('cat_name', 'LIKE', 'nữ')->where('categoryvi', 'LIKE', $cat)->first();
        $slug = $page_title->category;
        $id = 0;
//        dd($products, $page_title);
        return view('layout.product.product-category', compact( 'products', 'cat','slug','categories', 'page_title', 'title', 'id'));

    }
}

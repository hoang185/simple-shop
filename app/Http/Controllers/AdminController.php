<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Support\Facades\URL;

class AdminController extends Controller
{
    public function special(Request $request) {
        $last_path = request()->segment(1);
//        dd(request()->segment(1));
        $sorter = $request->sorter;
        $products = Product::with('category');
        if( $last_path == URL_NEW_ARRIVAL) {
            $products = $products->where('product_new', 1);
            $page_title = NEW_ARRIVAL;
        }
        if( $last_path == URL_SALE_OFF) {
            $products = $products->where('product_sale', 1);
            $page_title = SALE_OFF;
        }
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
        $slug = $page_title;
//        dd($products);
        return view('layout.special-product.index', compact('products', 'page_title', 'slug'));
    }

    public function productDetail(Request $request)
    {
        $namevi = $request->product;
        $product = Product::where('namevi', $namevi)->first();
        $id = $product->id;
        $attributes = Attribute::join('product_color', 'attributes.product_color_id', '=', 'product_color.id')->where('product_id', $id)->get();
//        dd($product, $attributes);
        return view('layout.product.product-detail', compact('product', 'attributes'));
    }

   //$products = Attribute::with('productColor')->where('product_id', 1)->get();
   //foreach ($products as $key => $product) {
   //var_dump($product->productColor->color);

    public function checkoutCart() {
        return view('layout.cart.cart');
    }

    public function checkoutPay() {
        return view('layout.cart.checkout');
    }

    public function search(Request $request) {
//        $request->validate(['keyword' => 'required']);
        $page_title = SEARCH_RESULT;
        $search = !empty($request->input('keyword')) ? $request->input('keyword') : '';
        $keyword = str_replace(' ', '%', $search);
        $products = Product::where('namevi', 'LIKE', '%'.$keyword.'%')->get();
        $cats = Category::where('categoryvi', 'LIKE', '%'.$keyword.'%')->get();
//        dd($cats);
        foreach($cats as $key => $cat) {
            $cat_id = $cat->id;
            $product_cat = Product::where('cat_id', $cat_id)->get();
            $products = $products->merge($product_cat);
        }
//        dd($cats, $products);
        $slug = $page_title;
        $count = $products->count();
        return view('layout.special-product.index', compact('products', 'page_title', 'slug', 'count', 'search'));
    }

    public function convertLower() {
        try {
            $products = Product::get();
            foreach($products as $key => $product) {
//                dd($product);
                $namevi = str_replace(' ', '-', strtolower($product->name));
                $product->update(['namevi' => $namevi]);
            }
            return 'successfully';
        }
        catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }

    }
}

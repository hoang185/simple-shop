<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sale;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Support\Facades\URL;
use Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use App\Jobs\SendMail;
use App\Mail\SuccessfulOrderNotification;
use Mail;


class AdminController extends Controller
{
    public function showHome()
    {
        $new_hims = Product::where('product_new', 1)->whereHas('category', function ($q) {
            $q->where('cat_name', 'nam');
        })->take(8)->get();
        $new_hers = Product::where('product_new', 1)->whereHas('category', function ($q) {
            $q->where('cat_name', 'nữ');
        })->take(8)->get();
        $weekly_hims = Product::where('product_new', 1)->whereHas('category', function ($q) {
            $q->where('cat_name', 'nam');
        })->take(8)->get();
        $weekly_hers = Product::where('product_new', 1)->whereHas('category', function ($q) {
            $q->where('cat_name', 'nữ');
        })->take(8)->get();
        //        dd($new_hims, $new_hers);
        return view('home', compact('new_hims', 'new_hers', 'weekly_hims', 'weekly_hers'));
    }
    public function special(Request $request)
    {
        $last_path = request()->segment(1);
        //        dd(request()->segment(1));
        $sorter = $request->sorter;
        $products = Product::with('category');
        if ($last_path == URL_NEW_ARRIVAL) {
            $products = $products->where('product_new', 1);
            $page_title = NEW_ARRIVAL;
        }
        if ($last_path == URL_SALE_OFF) {
            $products = $products->where('product_sale', 1);
            $page_title = SALE_OFF;
        }
        if (!empty($sorter) && $sorter == CHAR_A_Z) {
            $products = $products->orderBy('name', 'asc');
        }
        if (!empty($sorter) && $sorter == CHAR_Z_A) {
            $products = $products->orderBy('name', 'desc');
        }
        if (!empty($sorter) && $sorter == ASC) {
            $products = $products->orderBy('price', 'asc');
        }
        if (!empty($sorter) && $sorter == DESC) {
            $products = $products->orderBy('price', 'desc');
        }
        if (!empty($sorter) && $sorter == LATEST_SORT) {
            $products = $products->orderBy('updated_at', 'desc');
        }
        $products = $products->paginate(8);
        $slug = $page_title;
        //        dd($products);
        return view('layout.special-product.index', compact('products', 'page_title', 'slug'));
    }

    public function productDetail(Request $request)
    {
        //        $content = Cart::content();
        //        Cart::update('03f854f9b6e5d4c8d5cb520ec699f711', 10);
        //        dd($content);
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

    public function checkoutCart()
    {
        //        Cart::destroy();
        $item_price = Sale::first();
        $total = str_replace(',', '', Cart::total());
        $total = intval($total);
        $content = Cart::content();
        //        dd($total, $item->ship_price, $content);
        return view('layout.cart.cart', compact('total', 'item_price'));
    }

    public function checkoutPay()
    {
        $item_price = Sale::first();
        $total = str_replace(',', '', Cart::total());
        $total = intval($total);
        return view('layout.cart.checkout', compact('total', 'item_price'));
    }

    public function insertOrder(Request $request)
    {

        $data = $request->all();
        $now = Carbon::now();
        $date = Carbon::parse($now)->format('Y-m-d');
        $mail_check = !empty($request->has('mail-check')) ? 1 : 0;
        $order_code = Carbon::parse($now)->format('dmYHis');
        $order_code .= $data['phone'];
        // dd($order_code);
        $total_bill = str_replace(',', '', Cart::total());

        try {
            $orders = Order::insert([
                'order_code' => $order_code,
                'customer_name' => $data['name'],
                'phone' => $data['phone'],
                'total_bill' => $total_bill,
                'date' => $date,
                'email' => $data['email'],
                'city' => $data['city'],
                'district' => $data['district'],
                'village' => $data['village'],
                'address' => $data['address'],
                'send_mail' => $mail_check,
                'detail' => $data['detail'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
        try {
            $order = Order::where('order_code', $order_code)->first();
            $order_id = $order->id;
            $content = Cart::content();
            foreach ($content as $key => $item) {
                $order_detail = OrderDetail::insert([
                    'order_id' => $order_id,
                    'product_name' => $item->name,
                    'quantity' => $item->qty,
                ]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $item_price = Sale::first();
        $total = str_replace(',', '', Cart::total());
        $total = intval($total);
        $item_price['total'] = $total;
        $item_price['name'] = $data['name'];
//        dd($item_price->total);
        if($orders && $order_detail) {
            Mail::to($data['email'])->send(new SuccessfulOrderNotification($content ,$item_price));
        }

        Cart::destroy();
        // dd($order_code);

        return redirect()->route('home')->with('success', 'Bạn đã thanh toán đơn hàng thành công');

    }
    public function test() {
        return view('mail.order');
    }

    public function search(Request $request)
    {
        //        $request->validate(['keyword' => 'required']);
        $page_title = SEARCH_RESULT;
        $search = !empty($request->input('keyword')) ? $request->input('keyword') : '';
        $keyword = str_replace(' ', '%', $search);
        $products = Product::where('namevi', 'LIKE', '%' . $keyword . '%')->get();
        $cats = Category::where('categoryvi', 'LIKE', '%' . $keyword . '%')->get();
        //        dd($cats);
        foreach ($cats as $key => $cat) {
            $cat_id = $cat->id;
            $product_cat = Product::where('cat_id', $cat_id)->get();
            $products = $products->merge($product_cat);
        }
        //        dd($cats, $products);
        $slug = $page_title;
        $count = $products->count();
        return view('layout.special-product.index', compact('products', 'page_title', 'slug', 'count', 'search'));
    }

    public function showBlog(Request $request)
    {
        $article = $request->article;
        switch ($article) {
            case ITEM_VAI_LINEN:
                return view('layout.blog.first-blog');
                break;
            case BAO_QUAN_AO_TRANG:
                return view('layout.blog.second-blog');
                break;
            case TANG_TUOI_THO:
                return view('layout.blog.third-blog');
                break;
            case PHOI_MAU_OUTFIT:
                return view('layout.blog.fourth-blog');
                break;
        }
    }

    public function convertLower()
    {
        try {
            $products = Product::get();
            foreach ($products as $key => $product) {
                //                dd($product);
                $namevi = str_replace(' ', '-', strtolower($product->name));
                $product->update(['namevi' => $namevi]);
            }
            return 'successfully';
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }


}

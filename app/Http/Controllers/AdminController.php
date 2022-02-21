<?php

namespace App\Http\Controllers;

use App\Mail\SaleoffNotification;
use App\Mail\SuccessfulPaymentNotification;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Sale;
use App\Models\ProductColor;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use App\Jobs\SendMail;
use App\Mail\SuccessfulOrderNotification;
use Mail;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Hash;



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

        $total_bill = str_replace(',', '', Cart::total());


        $item_price = Sale::first();
        $total = str_replace(',', '', Cart::total());
        $total = intval($total);
        $item_price['total'] = $total;
        $item_price['name'] = $data['name'];
        if( $data['payment-method'] == 2) {
            session([
                'order_code'    => $order_code,
                'customer_name' => $data['name'],
                'phone'         => $data['phone'],
                'total_bill'    => $total_bill,
                'date'          => $date,
                'customer_email' => $data['email'],
                'city'          => $data['city'],
                'district'      => $data['district'],
                'village'       => $data['village'],
                'address'       => $data['address'],
                'send_mail'     => $mail_check,
                'detail'        => $data['detail'],
            ]);
            //dd($data);
            // Khóa bí mật - được cấp bởi OnePAY
            $SECURE_SECRET = SECURE_HASH;
            // *****************************Lấy giá trị url cổng thanh toán*****************************
            $vpcURL = "https://mtf.onepay.vn/onecomm-pay/vpc.op" . "?";

            // bỏ giá trị url và nút submit ra khỏi mảng dữ liệu
            //        unset($_POST["virtualPaymentClientURL"]);
            //        unset($_POST["SubButL"]);

            $vpc_Merchant     = "ONEPAY";
            $vpc_AccessCode   = "D67342C2";
            $vpc_MerchTxnRef  = time();
            $vpc_OrderInfo    = "JSECURETEST01";
            $vpc_Amount       = $data['price-total'] * 100;
            $vpc_ReturnURL    = route('payment.onepay');
            $vpc_Version      = "2";
            $vpc_Command      = "pay";
            $vpc_Locale       = "vn";
            $vpc_Currency     = "VND";

            $data = array(
                "vpc_Merchant"    => $vpc_Merchant,
                "vpc_AccessCode"  => $vpc_AccessCode,
                "vpc_MerchTxnRef" => $vpc_MerchTxnRef,
                "vpc_OrderInfo"   => $vpc_OrderInfo,
                "vpc_Amount"      => $vpc_Amount,
                "vpc_ReturnURL"   => $vpc_ReturnURL,
                "vpc_Version"     => $vpc_Version,
                "vpc_Command"     => $vpc_Command,
                "vpc_Locale"      => $vpc_Locale,
                "vpc_Currency"    => $vpc_Currency,
            );
            //$stringHashData = $SECURE_SECRET; *****************************Khởi tạo chuỗi dữ liệu mã hóa trống*****************************
            $stringHashData = "";
            // sắp xếp dữ liệu theo thứ tự a-z trước khi nối lại
            // arrange array data a-z before make a hash
            ksort($data);

            // set a parameter to show the first pair in the URL
            // đặt tham số đếm = 0
            $appendAmp = 0;

            foreach ($data as $key => $value) {

                // create the md5 input and URL leaving out any fields that have no value
                // tạo chuỗi đầu dữ liệu những tham số có dữ liệu
                if (strlen($value) > 0) {
                    // this ensures the first paramter of the URL is preceded by the '?' char
                    if ($appendAmp == 0) {
                        $vpcURL .= urlencode($key) . '=' . urlencode($value);
                        $appendAmp = 1;
                    } else {
                        $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                    }
                    //$stringHashData .= $value; *****************************sử dụng cả tên và giá trị tham số để mã hóa*****************************
                    if ((strlen($value) > 0) && ((substr($key, 0, 4) == "vpc_") || (substr($key, 0, 5) == "user_"))) {
                        $stringHashData .= $key . "=" . $value . "&";
                    }
                }
            }
            //*****************************xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa*****************************
            $stringHashData = rtrim($stringHashData, "&");
            // Create the secure hash and append it to the Virtual Payment Client Data if
            // the merchant secret has been provided.
            // thêm giá trị chuỗi mã hóa dữ liệu được tạo ra ở trên vào cuối url
            if (strlen($SECURE_SECRET) > 0) {
                //$vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($stringHashData));
                // *****************************Thay hàm mã hóa dữ liệu*****************************
                $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*', $SECURE_SECRET)));
            }

            return redirect()->to($vpcURL);
        } else {
            try {
                $orders = Order::insert([
                    'order_code'    => $order_code,
                    'customer_name' => $data['name'],
                    'phone'         => $data['phone'],
                    'total_bill'    => $total_bill,
                    'date'          => $date,
                    'email'         => $data['email'],
                    'city'          => $data['city'],
                    'district'      => $data['district'],
                    'village'       => $data['village'],
                    'address'       => $data['address'],
                    'send_mail'     => $mail_check,
                    'detail'        => $data['detail'],
                    'payment_method'        => COD,
                    'payment_status'        =>  0,
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
            try {
                if ($orders && $order_detail) {
                    Mail::to($data['email'])->send(new SuccessfulOrderNotification($content, $item_price));
                }

                Cart::destroy();
            } catch (\Exception $e) {
                return $e->getMessage();
            }

            return redirect()->route('home')->with('success', 'Bạn đã đặt hàng thành công');
        }

    }

    public function createTransaction(Request $request) {
        $data = $request->all();
//        dd($data);
        $SECURE_SECRET = SECURE_HASH;//93E963BC17BF022F2A03B685784D0CFA

        $vpc_Txn_Secure_Hash = $data["vpc_SecureHash"];
//        unset ( $data["vpc_SecureHash"] );

// set a flag to indicate if hash has been validated
        $errorExists = false;

        if (strlen ( $SECURE_SECRET ) > 0 && $data["vpc_TxnResponseCode"] != "7" && $data["vpc_TxnResponseCode"] != "No Value Returned") {
            ksort($_REQUEST);
            //$stringHashData = $SECURE_SECRET;
            //*****************************khởi tạo chuỗi mã hóa rỗng*****************************
            $stringHashData = "";

            // sort all the incoming vpc response fields and leave out any with no value
            foreach ( $data as $key => $value ) {
//        if ($key != "vpc_SecureHash" or strlen($value) > 0) {
//            $stringHashData .= $value;
//        }
//      *****************************chỉ lấy các tham số bắt đầu bằng "vpc_" hoặc "user_" và khác trống và không phải chuỗi hash code trả về*****************************
                if ($key != "vpc_SecureHash" && (strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
                    $stringHashData .= $key . "=" . $value . "&";
                }
            }
//  *****************************Xóa dấu & thừa cuối chuỗi dữ liệu*****************************
            $stringHashData = rtrim($stringHashData, "&");


//    if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper ( md5 ( $stringHashData ) )) {
//    *****************************Thay hàm tạo chuỗi mã hóa*****************************
            if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)))) {
                // Secure Hash validation succeeded, add a data field to be displayed
                // later.
                $hashValidated = "CORRECT";
            } else {
                // Secure Hash validation failed, add a data field to be displayed
                // later.
                $hashValidated = "INVALID HASH";
            }
        } else {
            // Secure Hash was not validated, add a data field to be displayed later.
            $hashValidated = "INVALID HASH";
        }

// Define Variables
// ----------------
// Extract the available receipt fields from the VPC Response
// If not present then let the value be equal to 'No Value Returned'
// Standard Receipt Data
        $amount = null2unknown( $data["vpc_Amount"] );
        $locale = null2unknown( $data["vpc_Locale"] );
//$batchNo = null2unknown ( $data["vpc_BatchNo"] );
        $command = null2unknown( $data["vpc_Command"] );
//$message = null2unknown ( $data["vpc_Message"] );
        $version = null2unknown( $data["vpc_Version"] );
//$cardType = null2unknown ( $data["vpc_Card"] );
        $orderInfo = null2unknown( $data["vpc_OrderInfo"] );
//$receiptNo = null2unknown ( $data["vpc_ReceiptNo"] );
        $merchantID = null2unknown( $data["vpc_Merchant"] );
//$authorizeID = null2unknown ( $data["vpc_AuthorizeId"] );
        $merchTxnRef = null2unknown( $data["vpc_MerchTxnRef"] );
        $transactionNo = null2unknown( $data["vpc_TransactionNo"] );
//$acqResponseCode = null2unknown ( $data["vpc_AcqResponseCode"] );
        $txnResponseCode = null2unknown( $data["vpc_TxnResponseCode"] );

// This is the display title for 'Receipt' page
//$title = $data["Title"];


// This method uses the QSI Response code retrieved from the Digital
// Receipt and returns an appropriate description for the QSI Response Code
//
// @param $responseCode String containing the QSI Response Code
//
// @return String containing the appropriate description
//
//////////////////////// CONFIRM /////////////////////
        if($hashValidated=="CORRECT"){
            echo "responsecode=1&desc=confirm-success";
        }
        else echo "responsecode=0&desc=confirm-fail";

        $transStatus = "";
        if($hashValidated=="CORRECT" && $txnResponseCode=="0"){
            try {
                $orders = Order::insert([
                    'order_code'    => session('order_code'),
                    'customer_name' => session('customer_name'),
                    'phone'         => session('phone'),
                    'total_bill'    => session('total_bill'),
                    'date'          => session('date'),
                    'email'         => session('customer_email'),
                    'city'          => session('city'),
                    'district'      => session('district'),
                    'village'       => session('village'),
                    'address'       => session('address'),
                    'send_mail'     => session('send_mail'),
                    'detail'        => session('detail'),
                    'payment_method'        => ONEPAY,
                    'payment_status'        =>  1,
                ]);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
            try {
                $order_code = session('order_code');
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
            try {
                $item_price = Sale::first();
                $total = str_replace(',', '', Cart::total());
                $total = intval($total);
                $item_price['total'] = $total;
                $item_price['name'] = session('customer_name');
                if ($orders && $order_detail) {
                    Mail::to(session('customer_email'))->send(new SuccessfulPaymentNotification($content, $item_price));
                }

                Cart::destroy();
            } catch (\Exception $e) {
                return $e->getMessage();
            }
            $transStatus = "Giao dịch thành công";
            return redirect()->route('home')->with('success', 'Bạn đã thanh toán đơn hàng thành công');
        }elseif ($txnResponseCode!="0"){
            $transStatus = "Giao dịch thất bại";
            return redirect()->route('home')->with('error', $transStatus);
        }elseif ($hashValidated=="INVALID HASH"){
            $transStatus = "Giao dịch Pendding";
            return redirect()->route('home')->with('error', $transStatus);
        }
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

    public function sendMail(Request $request) {

        $request->validate([
            'username'    => 'required',
            'password' => 'required|min:5',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
        $admins = admin::get();
        $check = 0;
        foreach($admins as $key => $admin) {
            if( $username == $admin->username && Hash::check($password, $admin->password)) {
                $check = 1;
            }
        }
        if( $check == 1) {
            $users = User::where('send_mail', 1)->get();
            $item = EmailTemplate::where('enable', 1)->first();
            if (!empty($item->enable)) {
                foreach ($users as $key => $user) {
                    Mail::to($user->email)->send(new SaleoffNotification());
                }
                return 'send mail successfully';
            } else {
                return 'email template is not enabled to 1 or other error';
            }
        }
        else{
            return redirect()->route('admin.login')->with('error', 'Tài khoản không hợp lệ!');
        }



    }


}

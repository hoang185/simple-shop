<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;
Use Alert;

class CartController extends Controller
{
    public function addCart(Request $request) {
        $id = $request->id;
        $color =$request->color;
        $size = $request->size;
        $qty = $request->qty;
        $color_id = $request->color_id;

        $product = Product::with('attribute')->where('id', $id)->first();
        $attribute = $product->attribute()->where('product_id', $id)->where('product_color_id', $color_id)->first();
        $data = [
            'id' => $id,
            'name' => $product['name'],
            'price' => $product['price'],
            'weight' => 12,
            'qty' => $qty,
            'image' => $product['image'],
            'size' => $size,
            'color' => $color,
            'options' => ['image' => $attribute->color_thumb, 'size' => $size, 'color' => $color]
        ];
        //Cart::remove('96b00aff09ab2ea50a1466fa04b9a182');

        Cart::add($data);
        $content = Cart::content();
        $end_content = end($content);
        $product_cart = end($end_content);
        $cart_qty = Cart::content()->count();
        $html = view('layout.partial.product-cart', compact('product_cart' ))->render();
        return response()->json(['html' => $html, 'success' => true, 'cart_qty' => $cart_qty]);
    }
    public function deleteCart(Request $request) {
        if( !empty($request->del_id)) {
            Cart::remove($request->del_id);
        }
        return response()->json(['success' => true]);
    }
    public function updateCart(Request $request) {
        if( !empty($request->update_id)) {
            Cart::update($request->update_id, $request->update_qty);
        }
        return response()->json(['success' => true, 'success_update' => 'Bạn đã cập nhật giỏ hàng thành công']);
    }
}

<?php
use App\Models\Category;
use App\Models\Product;

if(!function_exists('get_category_id')) {
    function get_category_id($category) {
        $length = Category::count();
        for ($i=0; $i<$length; $i++) {

        }
    }
}

if(!function_exists('null2unknown')) {
    function null2unknown($data) {
        if ($data == "") {
            return "No Value Returned";
        } else {
            return $data;
        }
    }
}

<?php 

function translate($key, $lang=null){
    if($lang == null){
        $lang = App::getLocale();
    }
    return $key;
}

//Shows Base Price with discount
if (!function_exists('home_discounted_base_price')) {
    function home_discounted_base_price($product)
    {
        $price = $product->unit_price;

        $discount_applicable = false;

        if ($product->discount_startdate == null) {
            $discount_applicable = false;
        } elseif (strtotime(date('Y-m-d')) >= $product->discount_startdate && strtotime(date('Y-m-d')) <= $product->discount_enddate)
         {
            $discount_applicable = true;
        }

        // if ($discount_applicable) {
            if ($product->discount_type == 'Percent') {
                $price -= ($price * $product->discount_rate) / 100;
            } elseif ($product->discount_type == 'Flat') {
                $price -= $product->discount_rate;
            }
        // }

        // foreach ($product->taxes as $product_tax) {
        //     if ($product_tax->tax_type == 'Percent') {
        //         $tax += ($price * $product_tax->tax) / 100;
        //     } elseif ($product_tax->tax_type == 'Flat') {
        //         $tax += $product_tax->tax;
        //     }
        // }
        // $price += $tax;


        return $price;
    }
}


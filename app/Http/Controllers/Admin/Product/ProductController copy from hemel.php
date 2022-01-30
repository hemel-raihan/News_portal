<?php

namespace App\Http\Controllers\Admin\Product;

use Carbon\Carbon;
use App\Models\Product\Tax;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Sidebar;
use App\Models\Product\Brand;
use App\Models\Product\Color;
use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product\Productstock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use App\Models\Product\Attributevalue;
use App\Models\Product\Productcategory;
use Laracon21\Combinations\Combinations;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.product.posts.self');
        //$posts = Auth::guard('admin')->user()->posts()->latest()->get();
        $auth = Auth::guard('admin')->user();
        $posts = Product::latest()->get();
        return view('backend.admin.product.post.index',compact('posts','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.product.posts.create');
        $categories = Productcategory::where('parent_id', '=', 0)->get();
        $subcat = Productcategory::all();
        $sidebars = Sidebar::all();
        $brands = Brand::all();
        return view('backend.admin.product.post.form',compact('categories','subcat','sidebars','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.product.posts.create');
            $this->validate($request,[
                'title' => 'required|unique:products',
                'image' => 'max:1024',
                'gallaryimage.*' => 'max:1024',
                'files' => 'mimes:pdf',
                'categories' => 'required',
                'leftsidebar_id' => 'required',
                'rightsidebar_id' => 'required',
            ]);


        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $postphotoPath = public_path('uploads/productphoto');
            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($postphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = null;
        }


         //get form Gallary image
         $gallaryimage = $request->file('gallaryimage');
         $images=array();
         $destination = public_path('uploads/productgallary_image');

         if(isset($gallaryimage))
         {
             foreach($gallaryimage as $gimage)
             {
                $gallaryimagename = $slug.'-'.'-'.uniqid().'.'.$gimage->getClientOriginalExtension();
                 $gimg                     =       Image::make($gimage->path());
                $gimg->resize(900, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination.'/'.$gallaryimagename);
                $images[]=$gallaryimagename;
             }

         }
         else
         {
            $images[] = null;
         }

        //get form file
        $file = $request->file('files');

        if(isset($file))
        {
            $currentDate = Carbon::now()->toDateString();
            $filename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/productfiles');

            // //check image folder existance
            // if(!Storage::disk('public')->exists('postfile'))
            // {
            //     Storage::disk('public')->makeDirectory('postfile');
            // }
            $file->move($destinationPath,$filename);

            // //resize image
            // $postfile = Image::make($file)->save($filename);
            // Storage::disk('public')->put('categoryphoto/'.$filename,$postfile);

        }
        else
        {
            $filename = null;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        if(!$request->cash_on_delivery)
        {
            $cash_on_delivery = 0;
        }
        else
        {
            $cash_on_delivery = 1;
        }

        if(!$request->todays_deal)
        {
            $todays_deal = 0;
        }
        else
        {
            $todays_deal = 1;
        }

        if($request->Free_Shipping)
        {
            $shipping = null;
        }
        else
        {
            $shipping = $request->Free_Shipping;
        }

        if($request->Flat_Rate)
        {
            $shipping = $request->shipping;
        }

        if(!Auth::guard('admin')->user()->role_id == 1)
        {
            $is_approved = false;
        }
        else
        {
            $is_approved = true;
        }

        // if(!$request->youtube_link)
        // {
        //     $youtube = null;
        // }
        // else
        // {
        //     $youtube = $request->youtube_link;
        // }

        // if(!$request->image)
        // {
        //     $featureimg = null;
        // }
        // else
        // {
        //     $featureimg = $imagename;
        // }


        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors = json_encode($request->colors);
        }
        else {
            $colors = array();
            $colors = json_encode($colors);
        }

        $choice_options = array();

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_'.$no;

                $item['attribute_id'] = $no;

                $data = array();
                // foreach (json_decode($request[$str][0]) as $key => $eachValue) {
                foreach ($request[$str] as $key => $eachValue) {
                    // array_push($data, $eachValue->value);
                    array_push($data, $eachValue);
                }

                $item['values'] = $data;
                array_push($choice_options, $item);
            }
        }

        if (!empty($request->choice_no)) {
            $attributes = json_encode($request->choice_no);
        }
        else {
            $attributes = json_encode(array());
        }

        $choice_options = json_encode($choice_options, JSON_UNESCAPED_UNICODE);

        if($request->discount_rate)
        {
            $discount = $request->discount_rate;
        }
        elseif($request->flash_discount_rate)
        {
            $discount = $request->flash_discount_rate;
        }
        else
        {
            $discount = null;
        }

        if($request->discount_type)
        {
            $discount_type = $request->discount_type;
        }
        elseif($request->flash_discount_type)
        {
            $discount_type = $request->flash_discount_type;
        }
        else
        {
            $discount_type = null;
        }

        //combinations start
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $data = array();
                foreach ($request[$name] as $key => $eachValue) {
                    array_push($data, $eachValue);
                }
                array_push($options, $data);
            }
        }


        $combinations = Combinations::makeCombinations($options);
        if(count($combinations[0]) > 0){
            $variant_product = 1;
        }
        else
        {
            $variant_product = null;
        }


        $product = Product::create([
            'title' => $request->title,
            'slug' => $slug,
            'admin_id' => Auth::id(),
            'brand_id' => $request->brand_id,
            'unit' => $request->unit,
            'purchase_qty' => $request->purchase_qty,
            'low_stock_qty' => $request->low_stock_qty,
            'unit_price' => $request->unit_price,
            'variant_product' => $variant_product,
            'attributes' => $attributes,
            'choice_options' => $choice_options,
            'colors' => $colors,
            'discount_startdate' => $request->discount_startdate,
            'discount_enddate' => $request->discount_enddate,
            'discount_rate' => $discount,
            'discount_type' => $discount_type,
            'quantity' => $request->quantity,
            'sku' => $request->sku,
            'image' => $imagename,
            //'youtube_link' => $youtube,
            'gallaryimage'=>  implode("|",$images),
            'files' => $filename,
            'desc' => $request->desc,
            'shipping' => $shipping,
            'cash_on_delivery' => $cash_on_delivery,
            'todays_deal' => $todays_deal,
            'estimate_shipping_time' => $request->estimate_shipping_time,
            'tax_type' => $request->tax_type,
            'tax' => $request->tax,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'status' => $status,
            'is_approved' => $is_approved,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
        ]);



        //$productt = new Product;
        //Generates the combinations of customer choice options
        $combinations = Combinations::makeCombinations($options);
        if(count($combinations[0]) > 0){
            //$variant_product = 1;
            foreach ($combinations as $key => $combination){
                $str = '';
                foreach ($combination as $key => $item){
                    if($key > 0 ){
                        $str .= '-'.str_replace(' ', '', $item);
                    }
                    else{
                        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
                            $color_name = Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        }
                        else{
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }
                $product_stock = Productstock::where('product_id', $product->id)->where('variant', $str)->first();
                if($product_stock == null){
                    $product_stock = new Productstock;
                    $product_stock->product_id = $product->id;
                }

                $product_stock->variant = $str;
                $product_stock->price = $request['price_'.str_replace('.', '_', $str)];
                $product_stock->sku = $request['sku_'.str_replace('.', '_', $str)];
                $product_stock->qty = $request['qty_'.str_replace('.', '_', $str)];
                $product_stock->image = $request['img_'.str_replace('.', '_', $str)];
                $product_stock->save();
            }
        }
        else{
            $product_stock              = new ProductStock;
            $product_stock->product_id  = $product->id;
            $product_stock->variant     = '';
            $product_stock->price       = $request->unit_price;
            $product_stock->sku         = $request->sku;
            $product_stock->qty         = $request->current_stock;
            $product_stock->save();
        }
        //combinations end

        //for many to many
        $product->productcategories()->attach($request->categories);
        $product->flashdeals()->attach($request->flash_deal_id);

        if($request->tax_id) {

                //$product->taxes()->attach($request->tax_id);
                $taxes = Tax::where('status', 1)->get();
                 foreach ($taxes as  $tax) {
                    // $product_tax = DB::table('product_tax')
                    // ->where('tax', $request['tax_'.$tax->id])
                    // ->where('tax_type', $request['tax_type_'.$tax->id])
                    // ->insert();

                    DB::table('product_tax')->insert(
                        ['product_id' => $product->id, 'tax_id' => $tax->id, 'tax' => $request['tax_'.$tax->id], 'tax_type' => $request['tax_type_'.$tax->id]]
                    );
            }
        }


        notify()->success("Product Successfully created","Added");
        return redirect()->route('admin.products.index');
    }


    public function status($id)
    {
        Gate::authorize('app.product.posts.status');
        $post = Product::find($id);
        if($post->status == true)
        {
            $post->status = false;
            $post->save();

            notify()->success('Successfully Deactiveated Post');
        }
        elseif($post->status == false)
        {
            $post->status = true;
            $post->save();

            notify()->success('Removed the Activeated Approval');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    public function add_more_choice_option(Request $request) {
        $all_attribute_values = Attributevalue::with('attribute')->where('attribute_id', $request->attribute_id)->get();

        $html = '';

        foreach ($all_attribute_values as $key=> $row) {
            //$html .= '<option value="' . $row->value . '">' . $row->value . '</option>';

            $html .= '<li class="transfer-double-group-list-li transfer-double-group-list-li-1636878492">
            <div class="checkbox-group">
                <input type="checkbox" name="choice_options_'.$row->attribute->id.'[]" value="'.$row->value.'" class="attribute_choice checkbox-normal group-select-all-1636878492" id="group_'.$key.'_1636878492_'.$row->attribute->id.'" /><label for="group_'.$key.'_1636878492_'.$row->attribute->id.'" class="group-name-1636878492_'.$row->attribute->id.'">'.$row->value.'</label>
            </div>
        </li>';
        }

        echo json_encode($html);
    }

    public function sku_combination(Request $request)
    {
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->input('colors'));
        }
        else {
            $colors_active = 0;
        }

        $unit_price = $request->unit_price;
        $product_name = $request->title;

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $data = array();
                // foreach (json_decode($request[$name][0]) as $key => $item) {
                foreach ($request[$name] as $key => $item) {
                    // array_push($data, $item->value);
                    array_push($data, $item);
                }
                array_push($options, $data);
            }
        }

        $combinations = Combinations::makeCombinations($options);
        return view('backend.admin.product.sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
    }

    public function sku_combination_edit(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }
        else {
            $colors_active = 0;
        }

        $product_name = $request->title;
        $price = $request->unit_price;

        if($request->has('choice_noo')){
            foreach ($request->choice_noo as $key => $no) {
                $name = 'choice_options_'.$no;
                $data = array();
                // foreach (json_decode($request[$name][0]) as $key => $item) {
                foreach ($request[$name] as $key => $item) {
                    // array_push($data, $item->value);
                    array_push($data, $item);
                }
                array_push($options, $data);
            }
        }

        $combinations = Combinations::makeCombinations($options);
        return view('backend.admin.product.sku_combinations_edit', compact('combinations', 'price', 'colors_active', 'product_name', 'product'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        Gate::authorize('app.product.posts.edit');
        $categories = Productcategory::where('parent_id', '=', 0)->get();
        $subcat = Productcategory::all();
        $editsidebars = Sidebar::all();
        $editbrands = Brand::all();
        return view('backend.admin.product.post.form',compact('product','categories','subcat','editsidebars','editbrands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        Gate::authorize('app.product.posts.edit');
        $this->validate($request,[
            'title' => 'required',
            'image' => 'max:1024',
            'gallaryimage.*' => 'max:1024',
            'files' => 'mimes:pdf',
            'categories' => 'required',
            'leftsidebar_id' => 'required',
            'rightsidebar_id' => 'required',
        ]);

        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $postphotoPath = public_path('uploads/productphoto');

            $postphoto_path = public_path('uploads/productphoto/'.$product->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

           $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($postphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $product->image;
        }

        //get form Gallary image
        $gallaryimage = $request->file('gallaryimage');
        $images=array();
        $destination = public_path('uploads/productgallary_image');
        $updateimages = explode("|", $product->gallaryimage);


        if(isset($gallaryimage))
        {
            foreach($updateimages as $updateimage){

                $gallary_path = public_path('uploads/productgallary_image/'.$updateimage);

                if (file_exists($gallary_path)) {

                    @unlink($gallary_path);

                }
            }

            foreach($gallaryimage as $gimage)
            {

               $gallaryimagename = $slug.'-'.'-'.uniqid().'.'.$gimage->getClientOriginalExtension();
               $gimg                     =       Image::make($gimage->path());
                $gimg->resize(900, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination.'/'.$gallaryimagename);
               $images[]=$gallaryimagename;
            }

        }
        else
        {
            $images[]=$product->gallaryimage;
        }

        //get form file
        $file = $request->file('files');

        if(isset($file))
        {
            $currentDate = Carbon::now()->toDateString();
            $filename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/productfiles');


            $file_path = public_path('uploads/productfiles/'.$product->files);  // Value is not URL but directory file path
            if (file_exists($file_path)) {

                @unlink($file_path);

            }
            $file->move($destinationPath,$filename);

            // //resize image
            // $postfile = Image::make($file)->save($filename);
            // Storage::disk('public')->put('categoryphoto/'.$filename,$postfile);

        }
        else
        {
            $filename = $product->files;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        if(!$request->cash_on_delivery)
        {
            $cash_on_delivery = 0;
        }
        else
        {
            $cash_on_delivery = 1;
        }

        if(!$request->todays_deal)
        {
            $todays_deal = 0;
        }
        else
        {
            $todays_deal = 1;
        }

        if($request->Free_Shipping)
        {
            $shipping = null;
        }
        else
        {
            $shipping = $request->Free_Shipping;
        }

        if($request->Flat_Rate)
        {
            $shipping = $request->shipping;
        }

        if(!Auth::guard('admin')->user()->role_id == 1)
        {
            $is_approved = false;
        }
        else
        {
            $is_approved = true;
        }

        // if(!$request->youtube_link)
        // {
        //     $youtube = null;
        // }
        // else
        // {
        //     $youtube = $request->youtube_link;
        // }

        // if(!$request->image)
        // {
        //     $featureimg = null;
        // }
        // else
        // {
        //     $featureimg = $imagename;
        // }

        if($request->discount_rate)
        {
            $discount = $request->discount_rate;
        }
        elseif($request->flash_discount_rate)
        {
            $discount = $request->flash_discount_rate;
        }
        else
        {
            $discount = null;
        }
        if($request->discount_type)
        {
            $discount_type = $request->discount_type;
        }
        if($request->flash_discount_type)
        {
            $discount_type = $request->flash_discount_type;
        }

        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors = json_encode($request->colors);
        }
        else {
            $colors = array();
            $colors = json_encode($colors);
        }

        $choice_options = array();

        if($request->has('choice_noo')){
            foreach ($request->choice_noo as $key => $no) {
                $str = 'choice_options_'.$no;

                $item['attribute_id'] = $no;

                $data = array();
                foreach ($request[$str] as $key => $eachValue) {
                    array_push($data, $eachValue);
                }

                $item['values'] = $data;
                array_push($choice_options, $item);
            }
        }

        foreach ($product->stocks as $key => $stock) {
            $stock->delete();
        }

        if (!empty($request->choice_no)) {
            $attributes = json_encode($request->choice_no);
        }
        else {
            $attributes = json_encode(array());
        }

        $product->choice_options = json_encode($choice_options, JSON_UNESCAPED_UNICODE);


        //combinations start
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if($request->has('choice_noo')){
            foreach ($request->choice_noo as $key => $no) {
                $name = 'choice_options_'.$no;
                $data = array();
                foreach ($request[$name] as $key => $item) {
                    array_push($data, $item);
                }
                array_push($options, $data);
            }
        }


        $combinations = Combinations::makeCombinations($options);
        if(count($combinations[0]) > 0){
            $variant_product = 1;
        }
        else
        {
            $variant_product = null;
        }


        $product->update([
            // 'title' => $request->title,
            // 'slug' => $slug,
            // 'admin_id' => Auth::id(),
            // 'brand_id' => $request->brand_id,
            // 'unit' => $request->unit,
            // 'purchase_qty' => $request->purchase_qty,
            // 'low_stock_qty' => $request->low_stock_qty,
            // 'unit_price' => $request->unit_price,
            // 'discount_startdate' => $request->discount_startdate,
            // 'discount_enddate' => $request->discount_enddate,
            // 'discount_rate' => $discount,
            // 'discount_type' => $discount_type,
            // 'quantity' => $request->quantity,
            // 'sku' => $request->sku,
            // 'image' => $imagename,
            // //'youtube_link' => $youtube,
            // 'gallaryimage'=>  implode("|",$images),
            // 'files' => $filename,
            // 'desc' => $request->desc,
            // 'shipping' => $request->shipping,
            // 'cash_on_delivery' => $cash_on_delivery,
            // 'todays_deal' => $todays_deal,
            // 'estimate_shipping_time' => $request->estimate_shipping_time,
            // 'tax_type' => $request->tax_type,
            // 'tax' => $request->tax,
            // 'leftsidebar_id' => $request->leftsidebar_id,
            // 'rightsidebar_id' => $request->rightsidebar_id,
            // 'status' => $status,
            // 'is_approved' => $is_approved,
            // 'meta_title' => $request->meta_title,
            // 'meta_desc' => $request->meta_desc,

            'title' => $request->title,
            'slug' => $slug,
            'admin_id' => Auth::id(),
            'brand_id' => $request->brand_id,
            'unit' => $request->unit,
            'purchase_qty' => $request->purchase_qty,
            'low_stock_qty' => $request->low_stock_qty,
            'unit_price' => $request->unit_price,
            'variant_product' => $variant_product,
            'attributes' => $attributes,
            'choice_options' => $choice_options,
            'colors' => $colors,
            'discount_startdate' => $request->discount_startdate,
            'discount_enddate' => $request->discount_enddate,
            'discount_rate' => $discount,
            'discount_type' => $discount_type,
            'quantity' => $request->quantity,
            'sku' => $request->sku,
            'image' => $imagename,
            //'youtube_link' => $youtube,
            'gallaryimage'=>  implode("|",$images),
            'files' => $filename,
            'desc' => $request->desc,
            'shipping' => $shipping,
            'cash_on_delivery' => $cash_on_delivery,
            'todays_deal' => $todays_deal,
            'estimate_shipping_time' => $request->estimate_shipping_time,
            'tax_type' => $request->tax_type,
            'tax' => $request->tax,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'status' => $status,
            'is_approved' => $is_approved,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,

        ]);


        $combinations = Combinations::makeCombinations($options);
        if(count($combinations[0]) > 0){
            $product->variant_product = 1;
            foreach ($combinations as $key => $combination){
                $str = '';
                foreach ($combination as $key => $item){
                    if($key > 0 ){
                        $str .= '-'.str_replace(' ', '', $item);
                    }
                    else{
                        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
                            $color_name = Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        }
                        else{
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }

                $product_stock = Productstock::where('product_id', $product->id)->where('variant', $str)->first();
                if($product_stock == null){
                    $product_stock = new Productstock;
                    $product_stock->product_id = $product->id;
                }
                if(isset($request['price_'.str_replace('.', '_', $str)])) {

                    $product_stock->variant = $str;
                    $product_stock->price = $request['price_'.str_replace('.', '_', $str)];
                    $product_stock->sku = $request['sku_'.str_replace('.', '_', $str)];
                    $product_stock->qty = $request['qty_'.str_replace('.', '_', $str)];
                    $product_stock->image = $request['img_'.str_replace('.', '_', $str)];

                    $product_stock->save();
                }
            }
        }
        else{
            $product_stock              = new Productstock;
            $product_stock->product_id  = $product->id;
            $product_stock->variant     = '';
            $product_stock->price       = $request->unit_price;
            $product_stock->sku         = $request->sku;
            $product_stock->qty         = $request->current_stock;
            $product_stock->save();
        }

        //for many to many
        $product->productcategories()->sync($request->categories);


        notify()->success("Product Successfully Updated","Update");
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Gate::authorize('app.product.posts.destroy');

        $postphoto_path = public_path('uploads/productphoto/'.$product->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

        $gallaryimages = explode("|", $product->gallaryimage);

        foreach($gallaryimages as $gimage){

            $gallaryimage_path = public_path('uploads/productgallary_image/'.$gimage);

            if (file_exists($gallaryimage_path)) {

                @unlink($gallaryimage_path);

            }

        }

        $postfile_path = public_path('uploads/productfiles/'.$product->files);  // Value is not URL but directory file path
            if (file_exists($postfile_path)) {

                @unlink($postfile_path);

            }

        $product->productcategories()->detach();

        $product->delete();
        notify()->success('Product Deleted Successfully','Delete');
        return back();
    }
}

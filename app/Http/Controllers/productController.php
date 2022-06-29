<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sub_category;
use Illuminate\Support\Facades\DB;
use App\Models\category;
use App\Models\product;
use App\Models\gallery;
use App\Models\attribute;

class productController extends Controller
{


    #########################
    #### FUNCTION-NO::00 ####
    #########################
    # Time, Date &  Day setup;

    function timeDateDay(Request $request){
        # Date and day set up start.
        date_default_timezone_set('Asia/Dhaka');
        $date = date("Y-m-d");
        $time = time();

        $timestamp = strtotime($date);
        $day = date('D', $timestamp);

        $request->session()->put('DATE_TODAY',$date);
        $request->session()->put('TIME_TODAY',$time);
        $request->session()->put('DAY_TODAY',$day);
        # Date and day set up end.
    }

    # End of function timeDateDay.                              <-------#
                                                                        #
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
    # Note: Hello, future me,
    # 
    # 
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('actionType','insert');
        
        $category = category::all()->sortByDesc("id");
        $subCategory = sub_category::all()->sortByDesc("id");
        return view('home',['category'=>$category], ['subCategory'=>$subCategory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        \App::call('App\Http\Controllers\productController@timeDateDay');

        $time = $request->session()->get('TIME_TODAY');

        $request->validate([
            'category_id'=> 'required',
            'sub_category_id'=> 'required',
            'name'=> 'required',
            'product_prize'=> 'required',
            'product_image'=> 'image|mimes:jpg,jpeg,png|max:4048',
        ]);

        # add pic.
        $img = $request->file('product_image');
        $ext = $img->extension();
        $file_name = hexdec(uniqid()).$time.'.'.$ext;
        $img->move(public_path('/media/product'), $file_name); // to public

        $product = new product;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->name = $request->name;
        $product->product_prize = $request->product_prize;
        $product->product_image = $file_name;
        $product->save();

        $getting_id = DB::table('products')
            ->where('product_image',$file_name)
            ->first();

        $product_id = $getting_id->id;

        # multi image
        $image = $request->file('multiple_image');

        foreach($image as $mul_img){

            $ext = $mul_img->extension();
            $file_name = hexdec(uniqid()).$time.'.'.$ext;
            $mul_img->move(public_path('/media/gallery'), $file_name); // to public

            $gallery = new gallery;
            $gallery->product_id = $product_id;
            $gallery->image = $file_name;
            $gallery->save();

        }

        # multi attribute
        $sku = $request->sku;
        $size = $request->size;
        $quantity = $request->quantity;
        $price = $request->price;

        for($i=0; $i < count($sku); $i++){

            $attribute = new attribute;
            $attribute->product_id = $product_id;
            $attribute->sku = $sku[$i];
            $attribute->size = $size[$i];
            $attribute->quantity = $quantity[$i];
            $attribute->price = $price[$i];
            $attribute->save();

        }

        $request->session()->put('msgHook','green');
        return redirect(route('indexPro'))->with('msg', 'Added successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \App::call('App\Http\Controllers\productController@timeDateDay');

        $time = $request->session()->get('TIME_TODAY');

        $request->validate([
            'category_id'=> 'required',
            'sub_category_id'=> 'required',
            'name'=> 'required',
            'product_prize'=> 'required',
            'product_image'=> 'image|mimes:jpg,jpeg,png|max:4048',
        ]);

        if($request->hasfile('product_image')){

            # Check if old image exists.
            $check = product::find($id);

            if($check->product_image!=null){

                $old_file_name = $check->product_image;
                $file_path = public_path('/media/product/'.$old_file_name);
                unlink($file_path);

            }

            # add pic.
            $img = $request->file('product_image');
            $ext = $img->extension();
            $file_name = hexdec(uniqid()).$time.'.'.$ext;
            $img->move(public_path('/media/product'), $file_name); // to public

            $product = product::find($id);
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->name = $request->name;
            $product->product_prize = $request->product_prize;
            $product->product_image = $file_name;
            $product->save();

        }else{

            $product = product::find($id);
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->name = $request->name;
            $product->product_prize = $request->product_prize;
            $product->save();

        }


        if($request->hasfile('multiple_image')){

            $image = $request->file('multiple_image');

            foreach($image as $mul_img){

                $ext = $mul_img->extension();
                $file_name = hexdec(uniqid()).$time.'.'.$ext;
                $mul_img->move(public_path('/media/gallery'), $file_name); // to public

                $gallery = new gallery;
                $gallery->product_id = $id;
                $gallery->image = $file_name;
                $gallery->save();

            }

        }

            # multi attribute
            $sku = $request->sku;
            $size = $request->size;
            $quantity = $request->quantity;
            $price = $request->price;

        if($request->has('sku')){

            for($i=0; $i < count($sku); $i++){

                $attribute = new attribute;
                $attribute->product_id = $id;
                $attribute->sku = $sku[$i];
                $attribute->size = $size[$i];
                $attribute->quantity = $quantity[$i];
                $attribute->price = $price[$i];
                $attribute->save();

            }

        }

        $request->session()->put('msgHook','green');
        return redirect(route('indexPro'))->with('msg', 'Edited successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        //

    }
}

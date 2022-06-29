<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\sub_category;
use App\Models\category;
use App\Models\product;
use App\Models\gallery;
use App\Models\attribute;

class ProductListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gallery = gallery::all()->sortByDesc("id");
        $attribute = attribute::all()->sortByDesc("id");
        $request->session()->put('actionType','insert');

        $list['data'] = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
            ->select('products.*', 'categories.category','sub_categories.sub_category')
            ->orderBy('products.id','desc')
            ->get();

        return view('productList')->with($list)->with(['gallery'=>$gallery])->with(['attribute'=>$attribute]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit(Request $request, $id)
    {

        $request->session()->put('actionType','edit');

        # selected
        $product = product::find($id);
        $request->session()->put('selectedSubCategoryID',$product->sub_category_id);
        $request->session()->put('selectedCategoryID',$product->category_id);

        $selectedSubCategory = sub_category::find($product->sub_category_id);
        $request->session()->put('selectedSubCategory',$selectedSubCategory->sub_category);

        # all category
        $category = category::all()->sortByDesc("id");
        $sub_category = sub_category::all()->sortByDesc("id");
        $attribute = attribute::where('product_id', $id)->get();

        return view('home')->with(['product'=>$product])->with(['category'=>$category])->with(['sub_category'=>$sub_category])->with(['attribute'=>$attribute]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        # Check if old image exists.
        $check = gallery::where('product_id', $id)->get();

        foreach($check as $mul_img){

            if($mul_img->image!=null){

                $old_file_name = $mul_img->image;
                $file_path = public_path('/media/gallery/'.$old_file_name);
                unlink($file_path);

            }

        }

        $product = product::find($id);

        if($product->product_image!=null){

            $old_file_name = $product->product_image;
            $file_path = public_path('/media/product/'.$old_file_name);
            unlink($file_path);

        }

        gallery::where('product_id', $id)->delete();
        attribute::where('product_id', $id)->delete();
        product::destroy($id);

        $request->session()->put('msgHook','green');
        return redirect(route('indexProList'))->with('msg', 'Product deleted');
    }
}

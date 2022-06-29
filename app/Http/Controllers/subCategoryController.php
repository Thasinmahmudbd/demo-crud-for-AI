<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\sub_category;
use App\Models\category;
use App\Models\product;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('actionType','insert');

        $list['data'] = DB::table('sub_categories')
            ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->select('sub_categories.*', 'categories.category')
            ->orderBy('sub_categories.id','desc')
            ->get();

        $category = category::all()->sortByDesc("id");
        return view('subCategory',$list,['category'=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'sub_category'=> 'required|unique:sub_categories,sub_category',
            'category_id'=> 'required'
        ],
        [
            'sub_category.required' => 'Please fill up this form',
            'sub_category.unique' => 'Similar sub category exists',
            'category_id.required' => 'Please choose a sub category',
        ]);
        
        $sub_category = new sub_category;
        $sub_category->sub_category = $request->sub_category;
        $sub_category->category_id = $request->category_id;
        $sub_category->save();

        $request->session()->put('msgHook','green');
        return redirect(route('indexSub'))->with('msg', 'Added successfully');
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
        $sub_category = sub_category::find($id);
        $request->session()->put('selectedSubCategory',$sub_category->sub_category);
        $request->session()->put('selectedSubCategoryID',$sub_category->id);

        # all category
        $categoryAll = category::all()->sortByDesc("id");

        $list['data'] = DB::table('sub_categories')
            ->join('categories', 'sub_categories.Category_ID', '=', 'categories.id')
            ->select('sub_categories.*', 'categories.category')
            ->orderBy('sub_categories.id','desc')
            ->get();

        return view('subCategory',$list,['category'=>$categoryAll]);
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
        $request->validate([
            'sub_category'=> "required|unique:sub_categories,sub_category, $id"
        ],
        [
            'sub_category.required' => 'Please fill up this form',
            'sub_category.unique' => 'Similar sub category exists',
        ]);

        $sub_category = sub_category::find($id);
        $sub_category->sub_category = $request->sub_category;
        $sub_category->category_id = $request->category_id;
        $sub_category->save();

        $request->session()->put('msgHook','green');
        return redirect(route('indexSub'))->with('msg', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $checkProduct = product::where('sub_category_id', $id)->first();

        if($checkProduct!=null){
            $request->session()->put('msgHook','red');
            return redirect(route('indexSub'))->with('msg', 'There are products under this sub category.');
        }else{
            sub_category::destroy($id);

            $request->session()->put('msgHook','green');
            return redirect(route('indexSub'))->with('msg', 'Deleted successfully.');
        }

    }
}

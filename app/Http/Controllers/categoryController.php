<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\sub_category;
use App\Models\category;
use App\Models\product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('actionType','insert');
        
        $category = category::all()->sortByDesc("id");
        return view('category',['data'=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'category'=> 'required|unique:categories'
        ],
        [
            'category.required' => 'Please fill up this form',
            'category.unique' => 'Similar category exists',
        ]);
        
        $category = new category;
        $category->category = $request->category;
        $category->save();

        $request->session()->put('msgHook','green');
        return redirect(route('index'))->with('msg', 'Added successfully');
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
        $category = category::find($id);

        # all
        $categoryAll = category::all()->sortByDesc("id");
        return view('category',['selected'=>$category],['data'=>$categoryAll]);
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
            'category'=> "required|unique:categories,category, $id"
        ],
        [
            'category.required' => 'Please fill up this form',
            'category.unique' => 'Similar category exists',
        ]);

        $category = category::find($id);
        $category->category = $request->category;
        $category->save();

        $request->session()->put('msgHook','green');
        return redirect(route('index'))->with('msg', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $checkProduct = product::where('category_id', $id)->first();
        $checkSub = sub_category::where('category_id', $id)->first();

        if($checkProduct!=null){
            $request->session()->put('msgHook','red');
            return redirect(route('index'))->with('msg', 'There are products under this category.');
        }if($checkSub!=null){
            $request->session()->put('msgHook','red');
            return redirect(route('index'))->with('msg', 'There are sub categories under this category.');
        }else{
            category::destroy($id);

            $request->session()->put('msgHook','green');
            return redirect(route('index'))->with('msg', 'Deleted successfully.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class crud extends Controller
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




    #########################
    #### FUNCTION-NO::01 ####
    #########################
    # Read categories;

    function show_category(Request $request){

        $result['data'] = DB::table('categories')
            ->orderBy('C_ID', 'desc')
            ->get();

        return view('category', $result);

    }

    # End of function show_category.                            <-------#
                                                                        #
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
    # Note: Hello, future me,
    # 
    # 
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #




    #########################
    #### FUNCTION-NO::02 ####
    #########################
    # Insert categories;
    # Data will be inserted into ---- categories table.

    function insert_categories(Request $request){

        # Data collection from form.
        $category = $request->input('category');

        $entry=array(
            'Category'=>$category
        );

        # Check if data exists.
        $check = DB::table('categories')
            ->where('Category', $category)
            ->first();

        if($check==null){

            # Create new entry.
            DB::table('categories')
            ->insert($entry);

            $request->session()->put('msgHook','green');
            $request->session()->flash('msg','New Category Added');

        }else{

            $request->session()->put('msgHook','red');
            $request->session()->flash('msg','Category Already Exists');

        }

        #Redirecting to function no::01 C:thisController.
        return redirect('/show/all/categories');

    }

    # End of function insert_video.                             <-------#
                                                                        #
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
    # Note: Hello, future me,
    # 
    # 
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #




    #########################
    #### FUNCTION-NO::03 ####
    #########################
    # Update categories;
    # Data will be updated from ---- categories table.

    function edit_categories(Request $request, $id){

        # Data collection from form.
        $category = $request->input('category');

        $entry=array(
            'Category'=>$category
        );

        # Check if data exists.
        $check = DB::table('categories')
            ->where('Category', $category)
            ->first();

        if($check==null){

            # Update category.
            DB::table('categories')
                ->where('C_ID', $id)
                ->update($entry);

            $request->session()->put('msgHook','yellow');
            $request->session()->flash('msg','Category Updated');

        }else{

            $request->session()->put('msgHook','red');
            $request->session()->flash('msg','A Similar Category Exists');

        }

        #Redirecting to function no::01 C:thisController.
        return redirect('/show/all/categories');

    }

    # End of function update_categories.                        <-------#
                                                                        #
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
    # Note: Hello, future me,
    # 
    # 
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
    
    
    
    
    #########################
    #### FUNCTION-NO::04 ####
    #########################
    # Delete category;
    # Data will be deleted from ---- category table.

    function delete_categories(Request $request, $id){


        # Check if item exists.
        $check = DB::table('items')
            ->where('Category_ID', $id)
            ->first();

        if($check==null){

            # delete category.
            DB::table('categories')
                ->where('C_ID', $id)
                ->delete();

            $request->session()->put('msgHook','red');
            $request->session()->flash('msg','Category Deleted');

        }else{

            $request->session()->put('msgHook','yellow');
            $request->session()->flash('msg','There are Items under this category delete them first');

        }

        #Redirecting to function no::01 C:thisController.
        return redirect('/show/all/categories');

    }

    # End of function delete_categories.                        <-------#
                                                                        #
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
    # Note: Hello, future me,
    # 
    # 
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #





    #########################
    #### FUNCTION-NO::05 ####
    #########################
    # Read items;

    function show_items(Request $request){

        $list['item'] = DB::table('items')
            ->join('categories', 'items.Category_ID', '=', 'categories.C_ID')
            ->select('items.*', 'categories.*')
            ->orderBy('items.ID','desc')
            ->get();

        $category['category'] = DB::table('categories')
            ->orderBy('C_ID', 'desc')
            ->get();

        return view('home', $list, $category);

    }

    # End of function show_items.                               <-------#
                                                                        #
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
    # Note: Hello, future me,
    # 
    # 
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #




    #########################
    #### FUNCTION-NO::06 ####
    #########################
    # Insert items;
    # Data will be inserted into ---- items table.

    function insert_items(Request $request){

        \App::call('App\Http\Controllers\crud@timeDateDay');

        # Data collection from form.
        $Slider_Name = $request->input('sliderName');
        $time = $request->session()->get('TIME_TODAY');

        # image validate
        $request->validate([
            'sliderImage'=>'image|mimes:jpg,jpeg,png|dimensions:min_width=200,min_height=200|max:4048'
        ]);

        $entry=array(
            'Category_ID'=>$request->input('category'),
            'Slider_Name'=>$request->input('sliderName'),
            'Status'=>$request->input('status')
        );

        if($request->hasfile('sliderImage')){

            # add pic.
            $img = $request->file('sliderImage');
            $ext = $img->extension();
            $file_name = $Slider_Name.'-'.$time.'.'.$ext;
            $img->move(public_path('/media/items'), $file_name); // to public

            $entry['Slider_Image']=$file_name;

        }

        # Create new entry.
        DB::table('items')
            ->insert($entry);

        $request->session()->put('msgHook','green');
        $request->session()->flash('msg','New Item Added');

        #Redirecting to function no::05 C:thisController.
        return redirect('/');

    }

    # End of function insert_items.                             <-------#
                                                                        #
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
    # Note: Hello, future me,
    # 
    # 
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #




    #########################
    #### FUNCTION-NO::07 ####
    #########################
    # Update items;
    # Data will be updated into ---- items table.

    function edit_items(Request $request, $id){

        \App::call('App\Http\Controllers\crud@timeDateDay');

        # Data collection from form.
        $Slider_Name = $request->input('sliderName');
        $time = $request->session()->get('TIME_TODAY');

        # image validate
        $request->validate([
            'sliderImage'=>'image|mimes:jpg,jpeg,png|dimensions:min_width=200,min_height=200|max:4048'
        ]);

        $entry=array(
            'Category_ID'=>$request->input('category'),
            'Slider_Name'=>$request->input('sliderName'),
            'Status'=>$request->input('status')
        );

        if($request->hasfile('sliderImage')){

            # Check if old image exists.
            $check = DB::table('items')
                ->where('ID', $id)
                ->first();

            if($check->Slider_Image!=null){

                $old_file_name = $check->Slider_Image;
                $file_path = public_path('/media/items/'.$old_file_name);
                unlink($file_path);

            }

            # add pic.
            $img = $request->file('sliderImage');
            $ext = $img->extension();
            $file_name = $Slider_Name.'-'.$time.'.'.$ext;
            $img->move(public_path('/media/items'), $file_name); // to public

            $entry['Slider_Image']=$file_name;

        }

        # Create new entry.
        DB::table('items')
            ->where('ID', $id)
            ->update($entry);

        $request->session()->put('msgHook','yellow');
        $request->session()->flash('msg','Item Edited');

        #Redirecting to function no::05 C:thisController.
        return redirect('/');

    }

    # End of function edit_items.                             <-------#
                                                                        #
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
    # Note: Hello, future me,
    # 
    # 
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #




    #########################
    #### FUNCTION-NO::08 ####
    #########################
    # Delete items;
    # Data will be deleted from ---- items table.

    function delete_items(Request $request, $id){

        # Check if old image exists.
        $check = DB::table('items')
            ->where('ID', $id)
            ->first();

        if($check->Slider_Image!=null){

            $old_file_name = $check->Slider_Image;
            $file_path = public_path('/media/items/'.$old_file_name);
            unlink($file_path);

        }

        # Create new entry.
        DB::table('items')
            ->where('ID', $id)
            ->delete();

        $request->session()->put('msgHook','red');
        $request->session()->flash('msg','Item Deleted');

        #Redirecting to function no::05 C:thisController.
        return redirect('/');

    }

    # End of function edit_items.                             <-------#
                                                                        #
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
    # Note: Hello, future me,
    # 
    # 
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
}
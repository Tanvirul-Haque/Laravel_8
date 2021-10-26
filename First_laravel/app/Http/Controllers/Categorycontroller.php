<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use Auth;
use Illuminate\Support\Carbon;

class Categorycontroller extends Controller
{
    public function AllCat(){
        return view('admin.category.index');
    }

    public function AddCat(Request $request){
        $validated = $request->validate([
            'Category_name' => 'required|unique:categories|max:255',
        
        ],
    [
        'category_name.required' => 'Please input category Name',
        'category_name.max' => 'Category less Then 255chars',
    ]);


    category::insert([
        'category_name' => $request->Category_name,
        'user_id' => Auth::user()->id,
        'created_at' => Carbon::now()
    ]);
    

/*
   $category = new Category;
   $category->category_name = $request->Category_name;
   $category->user_id = Auth::user()->id;
   $category->save();
*/
   return Redirect()->back()->with('success','Category Inserted Successfully');
   
    }
}

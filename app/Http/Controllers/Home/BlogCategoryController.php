<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;


class BlogCategoryController extends Controller
{
    public function AllBlogCategory(){

        $blogcategory = BlogCategory::latest()->get();
        return view('admin.blog_category.blog_category_all',compact('blogcategory'));

    }// End all blog category method

    public function AddBlogCategory(){

        return view('admin.blog_category.blog_category_add');
    }// End add blog category method

    public function StoreBlogCategory(Request $request){
        
        BlogCategory::insert([
                'blog_category' => $request->blog_category,
               

            ]); 
            $notification = array(
            'message' => 'Blog Category Inserted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.category')->with($notification);

    }//End store blog category method

    public function EditBlogCategory($id){
            
        $blogcategory = BlogCategory::findOrFail($id);
        return view('admin.blog_category.blog_category_edit',compact('blogcategory'));

    }//End Edit blog category method

    public function UpdateBlogCategory(Request $request, $id){
        BlogCategory::findOrFail($id)->update([
            'blog_category' => $request->blog_category,
           

        ]); 
        $notification = array(
        'message' => 'Blog Category updated Successfully', 
        'alert-type' => 'success'
    );

    return redirect()->route('all.blog.category')->with($notification);
    
}// End Update Blog category method 

    public function DeleteBlogCategory($id){

      
        BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Category Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End delete Blog category method 
}

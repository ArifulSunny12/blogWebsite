<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\post;

class publishPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function postpublish(Request $request){
        $user_id=$request->input("user_id");
        $title=$request->input("title");
        $content=$request->input("post");
        //$content_image=$request->input("status_image");
        if($request->has('post_image')){
            $content_image=$request->post_image;
            $content_image_name=Str::random(4)."_".time().".".$content_image->getclientOriginalExtension();
            $path='postimage';
            $content_image->move($path,$content_image_name);
            $content_image_link= "http://localhost:8000/postimage/".$content_image_name;
        }
        else{
            $content_image_link=null;
            if($request->has('post')){

            }
            else{
                return redirect('profile');
            }
        }
        $post_result= post::insert([
            "user_id"=>$user_id ,  
            "title"=>$title,
            "content"=>$content, 
            "image_path"=>$content_image_link
       ]);
       if($post_result==true){
        return redirect('profile');
    }
    else{
        return 'Record faild! try again';
    }
        
    }
}

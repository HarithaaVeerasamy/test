<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Blog;
class BlogController extends Controller
{
    public function index(Request $request)
    {
        $data = Blog::paginate(5);
        $search = "";
        return view('blog.index',['data' =>$data,'search'=>$search]);
    }
    public function add(Request $request)
    {
        return view('blog.form');
    }
    public function create(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return view('blog.form',['errors'=>$errors]);
        } 
        $input = [
            'title' => $request->title,
            'description' => $request->description
        ];
        $create = Blog::insertGetId($input);
        if($create){
            $request->session()->flash('alert-success', "Blog Added Successfully!!");
            return redirect()->route("blog");
        }else{
            $request->session()->flash('alert-danger', 'Error while Adding!');
            return redirect()->route("blog");
        } 
    }
    public function search(Request $request)
    {
        $search = $request->search_name;
        $data = Blog::WhereRaw("MATCH(title,description) AGAINST('$search')")
        ->OrWhereRaw("MATCH(title) AGAINST('$search')")
        ->OrWhereRaw("MATCH(description) AGAINST('$search')")
        ->paginate(5);
        return view('blog.index',['data' =>$data,'search'=>$search]);
    }
}

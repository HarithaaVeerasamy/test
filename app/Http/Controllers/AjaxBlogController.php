<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
class AjaxBlogController extends Controller
{
    public function index(Request $request)
    {
        $data = Blog::paginate(5);
        $search = "";
        return view('ajaxblog.index',['data' =>$data,'search'=>$search]);
    }
    public function search(Request $request)
    {
        $search = $request->search;
        if(!empty($search)){
            $data = Blog::WhereRaw("MATCH(title,description) AGAINST('$search')")
                    ->OrWhereRaw("MATCH(title) AGAINST('$search')")
                    ->OrWhereRaw("MATCH(description) AGAINST('$search')")
                    ->paginate(5);
        }else{
            $data = Blog::paginate(5);
        }
        

        $result = "";
        foreach ($data as $datas) {
            $result .= "<div class='row col-md-12 blog'>";
            $result .= "<div class='col-md-2'>".$datas->title."</div>";
            $result .= "<div class='col-md-10'>".$datas->description."</div></div>";              
        }
        // $result .="<div class='pull-right'>".$data->render()."</div>";
        return $result;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data = Product::paginate(5);
        return view('product.index',['data' => $data]);
    }
    public function add(Request $request)
    {
        $data = "";
        return view('product.form',['data'=>$data]);
    }
    public function create(Request $request)
    {
        
        // $input = [
        //     'product_name' => $request->product_name,
        //     'product_brand' => $request->product_brand,
        //     'product_price' => $request->product_price,
        //     'product_image' => $request->file('product_image')
        // ];
        $rules = [
            'product_name' => 'required | max:225',
            'product_brand' => 'required | max:225',
            'product_price' => 'required | regex:/^\d*(\.\d{2})?$/',
            'product_image' => 'image|mimes:png,gif,jpeg,svg'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return view('product.form',['errors'=>$errors]);
        } 
        $path = "";
        if(!empty($request->file('product_image'))){
            $image           = $request->file('product_image');
            $path            = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $path);
        } 
        $input = [
            'product_name' => $request->product_name,
            'product_brand' => $request->product_brand,
            'price' => $request->product_price,
            'status' => 2
         ];
         if(!empty($path)){
            $input['image'] = 'images/'.$path; 
         }
         if(empty($request->id)){
            $create = Product::insertGetId($input);
            $msg = "Product Added Successfully!";
         }else{
            $create = Product::where('id',$request->id)->update($input);
            $msg = "Product Updated Successfully";
         }
        if(!empty($create)){
            $request->session()->flash('alert-success', $msg);
            return redirect()->route("display");
        }else{
            $request->session()->flash('alert-danger', 'Error while Adding!');
            return redirect()->route("display");
        }          
    }
    public function edit($id)
    {
        $data = Product::where('id',$id)->get()->toArray();
        return view('product.form',['data'=>$data]);
    }
    public function delete($id, Request $request)
    {
        $delete = Product::where('id',$id)->delete();
        if(!empty($delete)){
            $request->session()->flash('alert-success', 'Product Deleted Successfully!');
            return redirect()->route("display");
        }else{
            $request->session()->flash('alert-danger', 'Error while Deleting!');
            return redirect()->route("display");
        } 
    }
}

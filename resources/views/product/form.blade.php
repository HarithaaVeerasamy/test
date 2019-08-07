@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Product</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                          @if(Session::has('alert-' . $msg))

                          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                          @endif
                        @endforeach
                      </div>
                     @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                      </div><br />
                    @endif
                    @php
                        if(empty($data)){
                            $product_name = "";
                            $product_brand = "";
                            $price = "";
                            $id = "";
                        }else{
                            foreach ($data as $datas) {
                                 $product_name = $datas['product_name'];
                                 $product_brand = $datas['product_brand'];
                                 $price = $datas['price'];
                                 $id = $datas['id'];
                            }  
                        }
                        
                    @endphp
                    <form action="/create" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row col-md-12">
                            <div class="col-md-3"><label>Product Name</label></div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name" value="{{$product_name}}">
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-3"><label>Product Brand</label></div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="product_brand" id="product_brand" placeholder="Brand Name" value="{{$product_brand}}">
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-3"><label>Product Price</label></div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="product_price" id="product_price" placeholder="0.00" value="{{$price}}">
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-3">
                                <label>Product Image</label><br/>
                                <span> {{($id !="")?"(Leave empty for previous Image)":""}}</span>
                            </div>
                            <div class="col-md-9">
                                <input type="file"  name="product_image" id="product_image">
                                <input type="hidden" name="id" value="{{$id}}">
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <a href="/addproduct" class="btn btn-danger">Cancel</a> &nbsp;
                                <input type="submit" name="Submit" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
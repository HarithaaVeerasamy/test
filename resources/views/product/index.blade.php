@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/addproduct" class="btn btn-primary" style="margin-bottom:10px; ">Add Product</a>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Product</div>

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
                    <table class="table table-hover">
                        <thead>
                            <th>S No</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @php $i =1; @endphp 
                            @foreach($data as $datas)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$datas->product_name}}</td>
                                <td>{{$datas->product_brand}}</td>
                                <td>{{$datas->price}}</td>
                                <td>
                                    <img src="{{URL::to('/').'/'.$datas->image}}" class="image">
                                </td>
                                <td>
                                    <a href="/edit/{{$datas->id}}" class="btn btn-secondary"> Edit</a> &nbsp;&nbsp;
                                    <a href="/delete/{{$datas->id}}" class="btn btn-danger"> Delete</a>
                                </td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right"> 
                        {!! $data->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
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

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
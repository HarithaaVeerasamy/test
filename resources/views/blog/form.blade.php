@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Blog</div>

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
                  
                    <form action="/createblog" method="post">
                        @csrf
                        <div class="row col-md-12">
                            <div class="col-md-3"><label>Title</label></div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="title" id="title" placeholder="Blog Title" >
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-3"><label>Description</label></div>
                            <div class="col-md-9">
                                <textarea name="description" placeholder="Enter Description Here.." class="form-control"></textarea>
                            </div>
                        </div>
                       
                        
                        <div class="row col-md-12">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <a href="/createblog" class="btn btn-danger">Cancel</a> &nbsp;
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
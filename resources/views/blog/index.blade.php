@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/addblog" class="btn btn-primary" style="margin-bottom:10px; ">Add Blog</a>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Blog</div>

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
                    <form method="post" action="/search">
                        @csrf
                        <div class="col-md-12 row">
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="search_name" placeholder="Search Here..." value="{{$search}}">
                            </div>
                            <div class="col-md-2">
                                <input type="submit" name="Search" value="Search" class="btn btn-secondary">
                            </div>
                            <div class="col-md-2">
                                <a href="/blog" class="btn btn-default" style="background-color:#bdcac8;">Cancel</a>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    @foreach($data as $datas)
                        <div class="row col-md-12 blog">
                            <div class="col-md-2">{{$datas->title}}</div>
                            <div class="col-md-10">{{$datas->description}}</div>
                        </div>
                    @endforeach
                    <div class="pull-right">
                        {{ $data->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
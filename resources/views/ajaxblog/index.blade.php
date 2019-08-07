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
                  
                        <div class="col-md-12 row">
                            <input type="text" class="form-control" name="search_name" placeholder="Search Here..."  id="search_name">
                        </div>
                    </form>
                    <hr/>
                    <div id="content_body">
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
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
   
        $('#search_name').keyup(function(){
            var value = $('#search_name').val();
            $.ajax({
                url: '/searchajax',
                type: 'POST',
                data : {'search' :value,"_token": "{{ csrf_token() }}"},
                success:function(data){
                    $('#content_body').html(data);
                }
            });
        })
    });
</script>
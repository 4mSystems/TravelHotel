@extends('admin_temp')
@section('content')
    <br>
    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"><a href="{{url('notif')}}">{{trans('admin.nav_notif')}}</a>
                </li>
                <li class="breadcrumb-item"> {{trans('admin.add_new_notif')}}
                </li>

            </ol>
        </div>
    </div>
    <div class="card-body">
        <div class="app-content content container-fluid">
            <div class="content-wrapper">
            @include('layouts.errors')

@include('layouts.messages')

                <div class="content-body"><!-- stats -->
                    <div class="row">

                        <div class="card">

                            <div class="card-header" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                <h3 class="card-title">{{trans('admin.add_notif')}} </h3>
                            </div>

                    
                        <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-block">
                                    {{ Form::open( ['url' => ['notif'],'method'=>'post', 'files'=>'true'] ) }}
                                    {{ csrf_field() }}


                                    <div class="form-group">
                                        <strong>{{trans('admin.content')}}</strong>
                                        {{ Form::textArea('content',old('name'),["class"=>"form-control" ,"required"]) }}
                                    </div>



                                    {{ Form::submit( trans('admin.public_Add') ,['class'=>'btn btn-success btn-min-width mr-1 mb-1','style'=>'margin:10px']) }}
                                    {{ Form::close() }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



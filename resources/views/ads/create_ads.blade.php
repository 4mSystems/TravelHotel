@extends('admin_temp')
@section('content')
    <br>
    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"><a href="{{url('ads')}}">{{trans('admin.nav_ads')}}</a>
                </li>
                <li class="breadcrumb-item"> {{trans('admin.add_new_ads')}}
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
                                <h3 class="card-title">{{trans('admin.add_new_ads')}} </h3>
                            </div>

               
                        <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-block">
                                    {{ Form::open( ['url' => ['ads'],'method'=>'post', 'files'=>'true'] ) }}
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <strong>{{trans('admin.name')}}</strong>
                                        {{ Form::text('name',old('name'),["class"=>"form-control" ,"required"]) }}
                                    </div>

                                    <div class="form-group">
                                        <strong>{{trans('admin.phone')}}</strong>
                                        {{ Form::text('phone',old('phone'),["class"=>"form-control" ,"required" ]) }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{trans('admin.address')}}</strong>
                                        {{ Form::text('address',old('address'),["class"=>"form-control" ,"required" ]) }}
                                    </div>

                                    <div class="form-group">
                                        <strong>{{trans('admin.description')}}</strong>
                                        {{ Form::textArea('description',old('description'),["class"=>"form-control" ,"required"]) }}
                                    </div>

                                    <div class="form-group">
                                        <strong>{{trans('admin.start_at')}}</strong>
                                        {{ Form::text('start_at',old('start_at'),["class"=>"form-control" ,"required"]) }}
                                    </div>
                                    <div class="form-group">
                                    <strong>{{trans('admin.end_at')}}</strong>
                                    {{ Form::text('end_at',old('end_at'),["class"=>"form-control" ,"required"]) }}
                                    </div>

                                <div class="form-group">
                                {{ Form::select('category_id',App\Category::pluck('name','id'),null
                                ,["class"=>"form-control dept_id" ,'placeholder'=>trans('admin.choose_Category') ]) }}
                            </div>
                            <div class="form-group">
                            <strong>{{trans('admin.image')}}</strong>
                            {{ Form::file('image',array('accept'=>'image/*','class'=>'form-control' )) }}
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



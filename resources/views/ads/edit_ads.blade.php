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
                <li class="breadcrumb-item"> {{trans('admin.update_ads')}}
                </li>
            </ol>
        </div>
    </div>


    <div class="app-content content container-fluid">
        <div class="content-wrapper">

        @include('layouts.errors')

@include('layouts.messages')

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{trans('admin.update_ads')}} </h3>
                </div>

            <!-- /.card-header -->
                <div class="card-body">
                    <div class="card-block">
                        {!! Form::model($ad_data, ['route' => ['ads.update',$ad_data->id] , 'method'=>'put' ,'files'=> true]) !!}
                        {{ csrf_field() }}


                        <div class="form-group">
                            <strong>{{trans('admin.name')}}</strong>
                            {{ Form::text('name',$ad_data->name,["class"=>"form-control" ]) }}
                        </div>

                        <div class="form-group">
                            <strong>{{trans('admin.phone')}}</strong>
                            {{ Form::text('phone',$ad_data->phone,["class"=>"form-control"]) }}
                        </div>


                        <div class="form-group">
                            <strong>{{trans('admin.address')}}</strong>
                            {{ Form::text('address',$ad_data->address,["class"=>"form-control"  ]) }}
                        </div>

                        <div class="form-group">
                            <strong>{{trans('admin.description')}}</strong>
                            {{ Form::textArea('description',$ad_data->description,["class"=>"form-control"  ]) }}
                        </div>

                        <div class="form-group">
                        <strong>{{trans('admin.start_at')}}</strong>
                        {{ Form::text('start_at',$ad_data->start_at,["class"=>"form-control" ,"required"]) }}
                    </div>
                    <div class="form-group">
                    <strong>{{trans('admin.end_at')}}</strong>
                    {{ Form::text('end_at',$ad_data->end_at,["class"=>"form-control" ,"required"]) }}
                    </div>

                <div class="form-group">
                {{ Form::select('category_id',App\Category::pluck('name','id'),$ad_data->category_id
                ,["class"=>"form-control dept_id"]) }}
            </div>
            <div class="form-group">
            <strong>{{trans('admin.image')}}</strong>
            <br>
            <div class="col-md-2"
                                                 style="display: inline-block;">
                                                <img src="{{asset($ad_data->image) }}" width="160" height="160">
                                            </div>
            {{ Form::file('image',array('accept'=>'image/*','class'=>'form-control' )) }}
        </div>

                      
                        {{ Form::submit( trans('admin.public_Edit') ,['class'=>'btn btn-success btn-min-width mr-1 mb-1','style'=>'margin:10px']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


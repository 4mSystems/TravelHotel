@extends('admin_temp')

@section('content')
    <br>

    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
            </li>
                <li class="breadcrumb-item"> {{trans('admin.nav_ad_cost')}}
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
                    <h3 class="card-title">{{trans('admin.update_superadmin')}} </h3>
                </div>
           
            <!-- /.card-header -->
                <div class="card-body">
                    <div class="card-block">
                        {!! Form::model($user_data, ['url' => ['ad_cost/update/'.$user_data->id] , 'method'=>'post' ,'files'=> true]) !!}
                        {{ csrf_field() }}


                        <div class="form-group">
                            <strong>{{trans('admin.nav_ad_cost')}}</strong>
                            {{ Form::number('ad_cost',$user_data->ad_cost,["class"=>"form-control" ]) }}
                        </div>

                      
                        {{ Form::submit( trans('admin.public_Edit') ,['class'=>'btn btn-success btn-min-width mr-1 mb-1','style'=>'margin:10px']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


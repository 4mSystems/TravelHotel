@extends('admin_temp')

@section('content')
    <br>

    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('provider')}}">{{trans('admin.nav_Provider')}}</a>
            </li>
                <li class="breadcrumb-item"> {{trans('admin.update_provider')}}
                </li>
            </ol>
        </div>
    </div>
    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{trans('admin.update_provider')}} </h3>
                </div>
            @include('layouts.errors')

            @include('layouts.messages')
            <!-- /.card-header -->
                <div class="card-body">
                    <div class="card-block">
                        {!! Form::model($user_data, ['route' => ['provider.update',$user_data->id] , 'method'=>'put' ,'files'=> true]) !!}
                        {{ csrf_field() }}


                        <div class="form-group">
                            <strong>{{trans('admin.name')}}</strong>
                            {{ Form::text('name',$user_data->name,["class"=>"form-control" ]) }}
                        </div>

                        <div class="form-group">
                            <strong>{{trans('admin.phone')}}</strong>
                            {{ Form::text('phone',$user_data->phone,["class"=>"form-control"]) }}
                        </div>


                        <div class="form-group">
                            <strong>{{trans('admin.email')}}</strong>
                            {{ Form::email('email',$user_data->email,["class"=>"form-control"  ]) }}
                        </div>

                     

                        <div class="form-group">
                                        <strong>{{trans('admin.password')}}</strong><br>
                                        <input type="password" name="password" class="form-control"
                                               >
                                    </div>

                        <div class="form-group">
                            <strong>{{trans('admin.company_name')}}</strong>
                            {{ Form::text('company_name',$user_data->company_name,["class"=>"form-control"  ]) }}
                        </div>
                        <div class="form-group">
                        <strong>{{trans('admin.payment_method')}}</strong>

                        {!! Form::select('payment_method', ['cash'=>'cash','visa'=>'visa'], $user_data->payment_method, ['class'=>'form-control',null]) !!}

                        </div>
                        <div class="form-group">
                            <strong>{{trans('admin.card_number')}}</strong>
                            {{ Form::text('card_number',$user_data->card_number,["class"=>"form-control"  ]) }}
                        </div>

                      
                        {{ Form::submit( trans('admin.public_Edit') ,['class'=>'btn btn-success btn-min-width mr-1 mb-1','style'=>'margin:10px']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


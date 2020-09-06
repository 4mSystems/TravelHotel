@extends('admin_temp')
@section('content')
    <br>
    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"><a href="{{url('super_Admin')}}">{{trans('admin.nav_add_Super_Admin')}}</a>
                </li>
                <li class="breadcrumb-item"> {{trans('admin.add_new_super_admin')}}
                </li>

            </ol>
        </div>
    </div>
    <div class="card-body">
        <div class="app-content content container-fluid">
            <div class="content-wrapper">
                <div class="content-body"><!-- stats -->
                    <div class="row">

                        <div class="card">

                            <div class="card-header" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                <h3 class="card-title">{{trans('admin.add_new_super_admin')}} </h3>
                            </div>

                        @include('layouts.errors')

                        @include('layouts.messages')

                        <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-block">
                                    {{ Form::open( ['url' => ['super_Admin'],'method'=>'post', 'files'=>'true'] ) }}
                                    {{ csrf_field() }}


                                    <div class="form-group">
                                        <strong>{{trans('admin.name')}}</strong>
                                        {{ Form::text('name',old('name'),["class"=>"form-control" ,"required"]) }}
                                    </div>

                                    <div class="form-group">
                                        <strong>{{trans('admin.email')}}</strong>
                                        {{ Form::email('email',old('email'),["class"=>"form-control" ,"required" ]) }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{trans('admin.password')}}</strong><br>
                                        <input type="password" name="password" class="form-control"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <strong>{{trans('admin.phone')}}</strong>
                                        {{ Form::text('phone',old('phone'),["class"=>"form-control" ,"required",'max'=>'9999999999999'   ]) }}
                                    </div>

                                    <div class="form-group">
                                        <strong>{{trans('admin.company_name')}}</strong>
                                        {{ Form::text('company_name',old('company_name'),["class"=>"form-control"]) }}
                                    </div>

                                    <div class="form-group">
                                        <strong>{{trans('admin.payment_method')}}</strong><br>

                                        <select id="payment_method" name="payment_method" required
                                                class="form-control">
                                            <option value="cash">{{trans('admin.cash')}}</option>
                                            <option value="visa">{{trans('admin.visa')}}</option>
                                        </select>
                                        <span class="text-danger" id="type_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <strong>{{trans('admin.card_number')}}</strong>
                                        {{ Form::number('card_number',old('card_number'),["class"=>"form-control"]) }}
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



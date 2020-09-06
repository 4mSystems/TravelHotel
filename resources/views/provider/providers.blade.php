
@extends('admin_temp')


@section('content')
    {{--Main Menu--}}


    <br>
    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"> {{trans('admin.nav_Provider')}}
                </li>

            </ol>
        </div>
    </div>
  
    <div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>

        <div class="content-body">
  <h1>{{trans('admin.nav_Provider')}} </h1>

            <!-- stats -->
            <div class="row">

                <div class="card">
                    <div class="card-header">
                        <a href="{{url('provider/create')}} "
                           class="btn btn-info btn-bg">{{trans('admin.add_new_Provider')}} </a>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card-body">

                        <div class="card-body collapse in">

                            @include('layouts.errors')

                            @include('layouts.messages')

                         
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-lg-center">{{trans('admin.Public_HashNum')}}</th>
                                        <th class="text-lg-center">{{trans('admin.name')}}</th>
                                        <th class="text-lg-center">{{trans('admin.email')}}</th>
                                        <th class="text-lg-center">{{trans('admin.phone')}}</th>
                                        <th class="text-lg-center">{{trans('admin.company_name')}}</th>
                                        <th class="text-lg-center"></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <th scope="row" class="text-lg-center">{{$user->id}}</th>
                                            <td class="text-lg-center">{{$user->name}}</td>
                                            <td class="text-lg-center">{{$user->email}}</td>
                                            <td class="text-lg-center">{{$user->phone}}</td>
                                            <td class="text-lg-center">{{$user->company_name}}</td>

                                            <td class="text-lg-center"><a class='btn btn-raised btn-success btn-sml'
                                                                          href=" {{url('provider/'.$user->id.'/edit')}}"><i
                                                        class="icon-edit"></i></a>

                                                <form method="get" id='delete-form-{{ $user->id }}'
                                                      action="{{url('provider/'.$user->id.'/delete')}}"
                                                      style='display: none;'>
                                                {{csrf_field()}}
                                                <!-- {{method_field('delete')}} -->
                                                </form>
                                                <button onclick="if(confirm('{{trans('admin.deleteConfirmation')}}'))
                                                    {
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{ $user->id }}').submit();
                                                    }else {
                                                    event.preventDefault();
                                                    }

                                                    "
                                                        class='btn btn-raised btn-danger btn-sml' href=" "><i
                                                        class="icon-android-delete" aria-hidden='true'>
                                                    </i>


                                                </button>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                           
                        </div>
                    </div>


@endsection

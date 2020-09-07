


@extends('admin_temp')
@section('styles')

<link rel="stylesheet" href="{{ asset('/assets/css/bootstrap-social.css') }}">
		<link rel="stylesheet" href="{{ asset('/assets/css/ladda.min.css') }}">
		<link rel="stylesheet" href="{{ asset('/assets/css/ladda-themeless.min.css') }}">

        @endsection


@section('content')
    {{--Main Menu--}}


    <br>
    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"> {{trans('admin.nav_ads')}}
                </li>

            </ol>
        </div>
    </div>
 
    <div class="app-content content container-fluid">
    <div class="content-wrapper">

    @include('layouts.errors')

@include('layouts.messages')
        <div class="content-header row">
        </div>

        <div class="content-body">
  <h1>{{trans('admin.nav_ads')}} </h1>


            <!-- stats -->
            <div class="row">

                <div class="card">
                    <div class="card-header">
                        <a href="{{url('ads/create')}} "
                           class="btn btn-info btn-bg">{{trans('admin.add_new_ads')}} </a>
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

                        
                         
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-lg-center">{{trans('admin.Public_HashNum')}}</th>
                                        <th class="text-lg-center">{{trans('admin.name')}}</th>
                                        <th class="text-lg-center">{{trans('admin.start_at')}}</th>
                                        <th class="text-lg-center">{{trans('admin.end_at')}}</th>
                                        <th class="text-lg-center">{{trans('admin.image')}}</th>
                                        <th class="text-lg-center"></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $accepted='accepted';
                                @endphp
                                    @foreach($ads as $ad)
                                        <tr>
                                            <th scope="row" class="text-lg-center">{{$ad->id}}</th>
                                            <td class="text-lg-center">{{$ad->name}}</td>
                                            <td class="text-lg-center">{{$ad->start_at}}</td>
                                            <td class="text-lg-center">{{$ad->end_at}}</td>
                                            <td class="text-lg-center"> 
                                            <img src="{{ url($ad->image) }}"
                                     style="width:90px;height:90px;"/>
                                     </td>

                                            <td class="text-lg-center">
                                            <a class='btn btn-raised btn-success btn-sml'
                                                                          href=" {{url('ads/'.$ad->id.'/images')}}"><i
                                                        ></i>Add Images</a>
                                            <a class='btn btn-raised btn-success btn-sml'
                                                                          href=" {{url('ads/'.$ad->id.'/edit')}}"><i
                                                        class="icon-edit"></i></a>

                                                <form method="get" id='delete-form-{{ $ad->id }}'
                                                      action="{{url('ads/'.$ad->id.'/delete')}}"
                                                      style='display: none;'>
                                                {{csrf_field()}}
                                                <!-- {{method_field('delete')}} -->
                                                </form>
                                                <button onclick="if(confirm('{{trans('admin.deleteConfirmation')}}'))
                                                    {
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{ $ad->id }}').submit();
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

@section('scripts')

<script src="{{ asset('/assets/js/spin.min.js') }}"></script>
		<script src="{{ asset('/assets/js/ladda.min.js') }}"></script>
		<script src="{{ asset('/assets/js/ui-buttons.js') }}"></script>

        @endsection

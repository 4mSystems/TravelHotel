


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
                <li class="breadcrumb-item"> {{trans('admin.nav_ads_admin')}}
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
  <h1>{{trans('admin.nav_ads_admin')}} </h1>


            <!-- stats -->
            <div class="row">

                <div class="card">
                <div class="card-header">
                <div class="btn-group mr-1 mb-1">
                    <button type="button" class="btn btn-outline-secondary btn-min-width dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">{{trans('admin.'.session('reser_status'))}}
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item"
                           href="{{url('ads_admin')}}">{{trans('admin.all')}}</a>
                           <a class="dropdown-item"
                            href="{{url('ads_admins/pending')}}">{{trans('admin.pending')}}</a>
                        <a class="dropdown-item"
                           href="{{url('ads_admins/accepted')}}">{{trans('admin.accepted')}}</a>
                        <a class="dropdown-item"
                           href="{{url('ads_admins/rejected')}}">{{trans('admin.rejected')}}</a>
                        
                    </div>
                </div>
                <a class="heading-elements-toggle">
                    <i class="icon-ellipsis font-medium-3"></i></a>
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
                                        <th class="text-lg-center">{{trans('admin.provider')}}</th>
                                        <th class="text-lg-center">{{trans('admin.Activation')}}</th>
                                        <th class="text-lg-center">{{trans('admin.description')}}</th>
                                        <th class="text-lg-center">{{trans('admin.price')}}</th>
                                        <th class="text-lg-center">{{trans('admin.status_ad')}}</th>
                                        <th class="text-lg-center">{{trans('admin.image')}}</th>
                                        <th class="text-lg-center">{{trans('admin.actions')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $accepted='accepted';
                                @endphp
                                    @foreach($ads as $ad)
                                        <tr>
                                            <th scope="row" class="text-lg-center">{{$ad->id}}</th>
                                            <th scope="row" class="text-lg-center">
                                            {{$ad->getUser->name}}
                                            </th>
                                            <th scope="row" class="text-lg-center">
                                            <a class='btn btn-raised btn-red btn-sml'
                                                    href=" {{url('BlockProvider/'.$ad->provider_id)}}"><i
                                                    ></i>Block</a>
                                            </th>
                                            <td class="text-lg-center">{{$ad->description}}</td>
                                            <td class="text-lg-center">{{$ad->price}}</td>
                                            <td class="text-lg-center">
                                            
                                        @if($ad->status != 'pending')
                                        <h4 class='Black'> {{$ad->status}} </h4>       
                                        @else
                                     
                                        <a class='btn btn-raised btn-red btn-sml'
                                                    href=" {{url('change_status_Reject/'.$ad->id.'/status')}}"><i
                                                    ></i>reject</a>
                                            <a class='btn btn-raised btn-green btn-sml'
                                                    href=" {{url('change_status_Accept/'.$ad->id.'/status')}}"><i
                                                    ></i>accept</a> 
                                        @endif
                                            </td>
                                            <td class="text-lg-center"> 
                                            <img src="{{ url($ad->image) }}"
                                     style="width:90px;height:90px;"/>
                                     </td>

                                            <td class="text-lg-center">
                                            <a class='btn btn-raised btn-success btn-sml'
                                                                          href=" {{url('ads/'.$ad->id.'/images')}}"><i
                                                        ></i>{{trans('admin.images')}}</a>
                                            <!-- <a class='btn btn-raised btn-success btn-sml'
                                                                          href=" {{url('ads/'.$ad->id.'/edit')}}"><i
                                                        class="icon-edit"></i></a> -->
                                                        @if($ad->status == 'finished')
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
                                                @endif
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

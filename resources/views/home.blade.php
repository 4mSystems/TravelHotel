
@extends('admin_temp')


@section('content')
    {{--Main Menu--}}

    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body"><!-- stats -->

                <h1>Home page</h1>
                {{--                Write your content here ...--}}

                @if(Auth::user()->type == "super admin")
                        <div class="col-xl-3 col-lg-6 col-xs-12">
                            <a>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-block">
                                            <div class="media">
                                                <div class="media-body text-xs-left">
                                                    <h3 class="teal">{{ count($data['ads'])}}</h3>
                                                    <span>{{trans('admin.home_all_ads')}}</span>
                                                </div>
                                                <div class="media-right media-middle">
                                                    <i class="icon-users teal font-large-2 float-xs-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-xs-12">
                            <a href="{{url('subscribers')}}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-block">
                                            <div class="media">
                                                <div class="media-body text-xs-left">
                                                    <h3 class="pink">{{ count($data['ads_pending'])}}</h3>
                                                    <span>{{trans('admin.home_ads_pending')}}</span>
                                                </div>
                                                <div class="media-right media-middle">
                                                    <i class="icon-briefcase4 pink font-large-2 float-xs-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-xs-12">
                            <a href="{{url('salons')}}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-block">
                                            <div class="media">
                                                <div class="media-body text-xs-left">
                                                    <h3 class="deep-orange">{{ count($data['ads_accepted'])}}</h3>
                                                    <span>{{trans('admin.home_ads_accepted')}}</span>
                                                </div>
                                                <div class="media-right media-middle">
                                                    <i class="icon-weather24 deep-orange font-large-2 float-xs-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-xs-12">
                            <a href="{{url('sponsered')}}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-block">
                                            <div class="media">
                                                <div class="media-body text-xs-left">
                                                    <h3 class="cyan">{{ count($data['ads_rejected'])}}</h3>
                                                    <span>{{trans('admin.home_ads_rejected')}}</span>
                                                </div>
                                                <div class="media-right media-middle">
                                                    <i class="icon-cash cyan font-large-2 float-xs-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif





            </div>
        </div>
    </div>

@endsection

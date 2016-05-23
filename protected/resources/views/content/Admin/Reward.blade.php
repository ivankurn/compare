@extends('layouts.content.app')

@section('page-level-styles')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
@endsection

@section('page-level-plugins-atas')
 <!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ asset('assets/Metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/Metronic/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/Metronic/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/Metronic/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/Metronic/global/plugins/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" /> 
<link href="{{ asset('assets/Metronic/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/Metronic/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/Metronic/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-level-plugins-bawah')
<script src="{{ asset('assets/Metronic/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/clockface/js/clockface.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
@endsection

@section('page-level-scripts')
<script src="{{ URL::asset('assets/Metronic/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/Metronic/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>

<script>

</script>

@endsection

@section('body')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <strong>Success!</strong>  {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        <strong>Warning!</strong> Something wrong. {{ session('error') }} </div>
    @endif

    <div class="row">
        <div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-tags"></i> 
                                <span class="caption-subject font-green bold uppercase">Reward MAXX-COFFEE</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <ul class="nav nav-pills">
                           <!--  <li class="active">
                                <a href="#tab_2_1" data-toggle="tab"> Pending Delivery </a>
                            </li> -->

                            <a class="btn green" href="{{ url('admin/reward/add') }}" target="_blank"><i class="fa fa-plus-circle"></i> Create New Reward</a>    
                        </ul>
                        <div class="tab-content ">
                            <div class="tab-pane fade active in" id="tab_2_1">
                                @if(empty($reward))
                                <div class="portlet light bordered" style="text-align: center; height: 700px;">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>
                                            <span class="caption-subject font-green bold uppercase">Reward MAXX-COFFEE</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body" style="padding-top: 300px;">
                                        No data for Reward MAXX-COFFEE
                                    </div>
                                </div>
                                @else
                                
                                
                                <div class="todo-tasklist">
                                    <div class="scroller" style="height: 525px;" data-always-visible="1" data-rail-visible1="1">
                                        @foreach($reward as $u)
                                            <div class="portlet-body">
                                                <div class="profile">
                                                    <div class="tabbable-line tabbable-full-width">
                                                        <ul class="nav nav-tabs">
                                                            
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="tab_1_1">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <ul class="list-unstyled profile-nav">
                                                                            <li>
                                                                            @if($u['gambar'])
                                                                                <img src="{{URL::to('assets/Maxx/pages/img/rewards/')}}/{{ $u['gambar']}}" class="pull-left" width="200px">
                                                                            @else
                                                                                <img src="{{URL::to('assets/Vourest/pages/img/default-menu.jpg')}}" class="pull-left" width="200px">
                                                                            @endif

                                                                            </li>
                                                                            
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <div class="row">
                                                                            <div class="col-md-7 profile-info">
                                                                                <br>
                                                                                
                                                                                <h3 class="font-green sbold" style="margin-top: 5px;margin-bottom: 20px;"> <i class="fa fa-gift"></i> {{ $u['reward'] }} </h3>
                                                                                
                                                                                <h5 class="font-green sbold" style="margin-top: 5px;margin-bottom: 20px;"> <i class="fa fa-navicon"></i> {{ $u['deskripsi'] }}  </h5>

                                                                            </div>
                                                                           
                                                                            <div class="col-md-5">
                                                                                <div class="portlet sale-summary">
                                                                                    
                                                                                    <div class="portlet-title">
                                                                                        
                                                                                        <div class="mt-element-ribbon light">
                                                                                            <div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-round ribbon-border-dash-hor ribbon-color-info uppercase">
                                                                                                <div class="ribbon-sub ribbon-clip ribbon-right"></div> {{ $u['nama_reward'] }} </div>
                                                                                        </div>
                                                                                    
                                                                                    </div>
                                                                                    <div class="portlet-body">
                                                                                        <ul class="list-unstyled">
                                                                                            <li>
                                                                                                <form action="{{ url('admin/reward/edit') }}" method="POST"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <input type="hidden" name="id_reward" value="{{ $u['id_reward'] }}"> <button class="btn btn-sm yellow" type="submit"> Edit Reward</button></form>
                                                                                            </li> 
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <center>
                                                                        
                                                                </center>
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                                @endif
                                
                            </div>


                        </div>
                    </div>
                </div>
        </div>

        
    </div>
    </div>
<!-- END CONTENT -->
@endsection
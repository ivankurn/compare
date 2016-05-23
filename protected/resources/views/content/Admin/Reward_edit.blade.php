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
    function validate() {
        $("#file_error").html("");
        $(".demoInputBox").css("border-color","#F0F0F0");
        var file_size = $('#file')[0].files[0].size;
        if(file_size>2097152) {
            $("#file_error").html("File size is greater than 2MB");
            $(".demoInputBox").css("border-color","#FF0000");
            return false;
        } 
        return true;
    }
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
                @foreach($reward as $syuuu)
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>
                            <span class="caption-subject bold uppercase">Add Reward {{ $syuuu['nama_reward'] }}</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="{{ url('admin/reward/edit/post') }}" class="form-horizontal" method="POST" enctype="multipart/form-data" onSubmit="return validate();">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Name</label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Reward name" name="nama_reward" value="{{ $syuuu['nama_reward'] }}" required> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Deskripsi</label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7">
                                        <div class="input-group">
                                            <textarea  class="form-control" placeholder="Description" name="deskripsi" cols="80" rows="5" required>{{ $syuuu['deskripsi'] }}</textarea> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Reward</label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Reward" name="reward" value="{{ $syuuu['reward'] }}" required> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Gambar</label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7 fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="{{ url('assets/Maxx/pages/img/rewards/') }}/{{ $syuuu['gambar'] }}" alt="" /> </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="gambar" id="file" class="demoInputBox" required> </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                <br>
                                                <span id="file_error"></span>

                                            </div>
                                    </div>
                                </div>
                                
                               
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-4">
                                        <button type="submit" class="btn green">Submit</button>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id_reward" value="{{ $syuuu['id_reward'] }}">
                                        <button type="button" class="btn default">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
                @endforeach
        </div>

        
    </div>
    </div>
<!-- END CONTENT -->
@endsection
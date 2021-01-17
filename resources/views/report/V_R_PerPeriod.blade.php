@extends('layout')

@section('menu')
    @include('V_Menu')
@endsection 

@section('title','Report Absensi Per Period')

@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
			<div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                      <h5 class="m-0">Shift</h5>
                    </div>
                    <div class="card-body">
                      <div class='row'>
                    </div>
                    <div class="form-group col-md-6" >
                        <label>Date From</label>
                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                              <input type="text" name="date_absen"  id="reservationdate-from" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                              <div class="input-group-append" data-target="#reservationdate-from" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                      
                        <label>Date To</label>
                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                              <input type="text" name="date_absen"  id="reservationdate-to" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                              <div class="input-group-append" data-target="#reservationdate-from" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                      </div>
                      <button class="btn btn-primary" type="submit">Download</button>
                    </div>
                </div>
			</div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection
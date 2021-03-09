@extends('layout')

@section('menu')
    @include('V_Menu')
@endsection 

@section('title','Data Shift')

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
              <div class="col-lg-2">
                <a href="#" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#Modal-add-shift"><i class='fas fa-plus-circle'></i> Input Manual Absen</a>
              </div>   
              <div class="col-lg-2">
                <a href="#" class="btn btn-block btn-success btn-sm" data-toggle="modal" data-target="#Modal-download-shift"><i class='fas fa-download'></i> Download Shift</a>
              </div>  
              <div class="col-lg-2">
                <a href="#" class="btn btn-block btn-info btn-sm" data-toggle="modal" data-target="#Modal-import-shift"><i class='fas fa-upload'></i> Import Shift</a>
              </div> 
            </div>
            <br>
            <div class="table-responsive">
              <table id="DataTable-App" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="background-color:#66A1D2;" width="5%">No</th>
                    <th style="background-color:#66A1D2;" width="5%">Nik</th>
                    <th style="background-color:#66A1D2;" width="20%">Nama Karyawan</th>
                    <th style="background-color:#66A1D2;" width="10%">Shift</th>
                    <th style="background-color:#66A1D2;" width="10%">Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
		                $no=1;
		                foreach ($data_shift as $dshift) {
                  ?>
                  <tr>
                    <td>{{ $no++}}</td>
                    <td>{{ $dshift->nik }}</td>
                    <td>{{ $dshift->karyawanName}}</td>
                    <td>{{ $dshift->shiftName }}</td>
                    <td>{{ $dshift->tanggal }}</td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
	    </div>
    </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<!-- Modal Add shift -->
<div class="modal fade" id="Modal-add-shift">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah shift</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('process_add_shift') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="in_karyawan_id">Karyawan</label>
            <select name="in_karyawan_id" class="form-control" placeholder="App" required>
              <option value="">Pilih Karyawan</option>
              <?php
                foreach ($data_karyawan as $dkaryawan) {
              ?>
                <option value="{{ $dkaryawan->karyawan_id }}">{{ $dkaryawan->nama }}</option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="in_shifthour_id">Jam Kerja</label>
            <select name="in_shifthour_id" class="form-control" placeholder="App" required>
              <option value="">Pilih Jam Kerja</option>
              <?php
                foreach ($data_shiftHour as $dshiftHour) {
              ?>
                <option value="{{ $dshiftHour->shifthours_id }}">{{ $dshiftHour->nama }}</option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Tanggal</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                  <input type="text" name="reservationdate-add"  id="reservationdate-add" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                  <div class="input-group-append" data-target="#reservationdate-add" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Save</button>
      </div>
          </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- Modal Add shift -->

<!-- Modal Download shift -->
<div class="modal fade" id="Modal-download-shift">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah karyawan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('download_shift') }}" method="POST">
          @csrf
          <div class="form-group">
            <label>Date From:</label>
              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                  <input type="text" name="reservationdate-from"  id="reservationdate-from" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                  <div class="input-group-append" data-target="#reservationdate-from" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
          </div>
          <div class="form-group">
            <label>Date To:</label>
              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                  <input type="text" name="reservationdate-to" id="reservationdate-to" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                  <div class="input-group-append" data-target="#reservationdate-to" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Download</button>
      </div>
          </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- Modal Download shift -->

<!-- Modal import shift -->
<div class="modal fade" id="Modal-import-shift">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah karyawan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('uploud_shift') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="exampleInputFile">Import File Excel</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="file_upload" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div>
        </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit">Uploud</button>
          </div>
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- Modal import shift -->

@endsection
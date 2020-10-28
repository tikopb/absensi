@extends('layout')

@section('menu')
    @include('V_Menu')
@endsection 

@section('title','Data Absensi')

@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
			<div class="col-lg-12">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="m-0">Absensi</h5>
          </div>
          <div class="card-body">
            <div class='row'>
              <div class="col-lg-2">
                <a href="#" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#Modal-add-Absen"><i class='fas fa-plus-circle'></i> Input Manual</a>
              </div>    
            </div>
            <br>
            <div class="table-responsive">
              <table id="DataTable-App" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="background-color:#66A1D2;" width="5%">No</th>
                    <th style="background-color:#66A1D2;" width="10%">Tanggal</th>
                    <th style="background-color:#66A1D2;" width="30%">Nama</th>
                    <th style="background-color:#66A1D2;" width="5%">In</th>
                    <th style="background-color:#66A1D2;" width="5%">Out</th>
                    <th style="background-color:#66A1D2;" width="15%">Description</th>
                    <th style="background-color:#66A1D2;" width="20%">Option</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
		                $no=1;
		                foreach ($data_Absen as $dAbsen) {
                  ?>
                  <tr>
                    <td>{{ $no++}}</td>
                    <td>{{ $dAbsen->tanggal}}</td>
                    <td>{{ $dAbsen->karyawanName}}</td>
                    <td>{{ $dAbsen->in}}</td>
                    <td>{{ $dAbsen->out}}</td>
                    <td>{{ $dAbsen->description}}</td>
                    <td>
                        <!-- modal action  start -->
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#Modal-edit-product-category">
                                <i class="fas fa-pencil-alt">
                                </i>
                                    Edit
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-product-category">
                                <i class="fas fa-trash">
                                </i>
                                    Delete
                            </button>
                        <!-- //modal action end -->
                    </td>
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

<!-- Modal Add Karyawan -->
<div class="modal fade" id="Modal-add-Absen">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah karyawan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('process_add_karyawan') }}" method="POST">
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
            <label>Tanggal</label>
              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                  <input type="text" name="testname"  id="reservationdate-from" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                  <div class="input-group-append" data-target="#reservationdate-from" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
          </div>
          <div class="form-group">
            <label for="in_app_name">Description</label>
            <input type="text" name="in_kr_barcode" class="form-control" id="in_absen_description" placeholder="Description" required>
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
<!-- Modal Add Karyawan -->

@endsection
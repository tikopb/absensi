@extends('layout')

@section('menu')
    @include('V_Menu')
@endsection 

@section('title','Data Jam Kerja')

@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
			<div class="col-lg-12">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="m-0">Jam Kerja</h5>
          </div>
          <div class="card-body">
            <div class='row'>
              <div class="col-lg-2">
                <a href="#" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#Modal-add-shiftHour"><i class='fas fa-plus-circle'></i> Input Karyawan</a>
              </div>    
            </div>
            <br>
            <div class="table-responsive">
              <table id="DataTable-App" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="background-color:#66A1D2;" width="5%">No</th>
                    <th style="background-color:#66A1D2;" width="5%">value</th>
                    <th style="background-color:#66A1D2;" width="20%">Nama</th>
                    <th style="background-color:#66A1D2;" width="10%">In</th>
                    <th style="background-color:#66A1D2;" width="10%">Out</th>
                    <th style="background-color:#66A1D2;" width="15%">Option</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
		                $no=1;
		                foreach ($data_shiftHour as $dshiftHour) {
                  ?>
                  <tr>
                    <td>{{ $no++}}</td>
                    <td>{{ $dshiftHour->value }}</td>
                    <td>{{ $dshiftHour->nama }}</td>
                    <td>{{ $dshiftHour->in }}</td>
                    <td>{{ $dshiftHour->out }}</td>
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
<div class="modal fade" id="Modal-add-shiftHour">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah karyawan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('process_add_shiftHour') }}" method="POST">
          @csrf
            <div class="form-group">
              <label for="in_app_code">Value</label>
              <input tyKaryawan
            <div class="form-group">
              <label for="in_app_name">Nama</label>
              <input type="text" name="in_sh_nama" class="form-control" id="in_app_name" placeholder="Nama" required>
            </div>
            <div class="form-group">
              <label for="in_app_name">In</label>
              <input type="time" name="in_sh_in" class="form-control" id="in_app_name" placeholder="In" required>
            </div>
            <div class="form-group">
              <label for="in_app_name">Out</label>
              <input type="time" name="in_sh_out" class="form-control" id="in_app_name" placeholder="Out" required>
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
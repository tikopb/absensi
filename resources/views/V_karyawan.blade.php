@extends('layout')

@section('menu')
    @include('V_Menu')
@endsection 

@section('title','Data Karyawan')

@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
			<div class="col-lg-12">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="m-0">Karyawan</h5>
          </div>
          <div class="card-body">
            <div class='row'>
              <div class="col-lg-2">
                <a href="#" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#Modal-add-karyawan"><i class='fas fa-plus-circle'></i> Input Karyawan</a>
              </div>    
            </div>
            <br>
            <div class="table-responsive">
              <table id="DataTable-App" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="background-color:#66A1D2;" width="5%">No</th>
                    <th style="background-color:#66A1D2;" width="25%">Nik</th>
                    <th style="background-color:#66A1D2;" width="25%">Nama</th>
                    <th style="background-color:#66A1D2;" width="30%">Barcode</th>
                    <th style="background-color:#66A1D2;" width="15%">Option</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
		                $no=1;
		                foreach ($data_karyawan as $dkaryawan) {
                  ?>
                  <tr>
                    <td>{{ $no++}}</td>
                    <td>{{ $dkaryawan->nik }}</td>
                    <td>{{ $dkaryawan->nama }}</td>
                    <td>{{ $dkaryawan->barcode }}</td>
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

<!-- Modal Add App -->
<div class="modal fade" id="Modal-add-karyawan">
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
              <label for="in_app_code">NIK</label>
              <input type="text" name="in_kr_nik" class="form-control" id="in_app_code" placeholder="NIK" required>
            </div>
            <div class="form-group">
              <label for="in_app_name">Nama Karyawan</label>
              <input type="text" name="in_kr_nama" class="form-control" id="in_app_name" placeholder="Nama Karyawan" required>
            </div>
            <div class="form-group">
              <label for="in_app_name">Kode Barcode</label>
              <input type="text" name="in_kr_barcode" class="form-control" id="in_app_name" placeholder="Kode Barcode" required>
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
<!-- Modal Add App -->

@endsection
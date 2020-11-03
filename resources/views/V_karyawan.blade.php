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
              <table id="DataTable-Karyawan" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="background-color:#66A1D2;" width="5%">No</th>
                    <th style="background-color:#66A1D2;" width="10%">Nik</th>
                    <th style="background-color:#66A1D2;" width="30%">Nama</th>
                    <th style="background-color:#66A1D2;" width="10%">Barcode</th>
                    <th style="background-color:#66A1D2;" width="15%">Option</th>
                  </tr>
                </thead>
                <tbody>
                  
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
              <label for="in_app_barcode">Kode Barcode</label>
              <input type="text" name="in_kr_barcode" class="form-control" id="in_app_barcode" placeholder="Kode Barcode" required>
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

@section('script')
  <script>
    $(document).ready(function(){
       $('#DataTable-App').on('click','.Modal-edit-karyawan',function(){
          var id=$(this).data('id');
          console.log(id);

          $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
            });
          $.ajax({
            type: 'get',
            url: "{{ route('GetKaryawan') }}",
            data: {invoice:invoice,po:po,plan:plan},
            success: function(response){
            $('#rm_order').val(response.remark_order);
            $('#rm_exim').val(response.remark_exim);
            $('#rm_cont').val(response.remark_cont);
            },
            error: function(response) {
            console.log(response)
            return false;
            }
          });
      }); 

      $.extend( $.fn.dataTable.defaults, {
        stateSave: true,
        autoWidth: false,
        autoLength: false,
        processing: true,
        serverSide: true,
        searching:false,
        dom: '<"datatable-header"fBl><t><"datatable-footer"ip>',
        language: {
        search: '<span>Filter:</span> _INPUT_',
        searchPlaceholder: 'Type to filter...',
        lengthMenu: '<span>Show:</span> _MENU_',
        paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        }
        });

        var _token = $("input[name='_token']").val();
        var table = $('#DataTable-Karyawan').DataTable({
        ajax: {
        url: "{{Route('GetKaryawan')}}",
        type: 'get',
        data: function (d) {
            return $.extend({},d,{
            
            "_token": _token
            });
          }
        },

        fnCreatedRow: function (row, data, index) {
        var info = table.page.info();
        var value = index+1+info.start;
        $('td', row).eq(0).html(value);

        },
        columnDefs: [
        {
        className: 'dt-center'
        }
        ],
        columns: [
        {data: null, sortable: false, orderable: false, searchable: false},
          {data: 'nik', name: 'nik'},
          {data: 'nama', name: 'nama'},
          {data: 'barcode', name: 'barcode'},
          {data: 'option', name: 'option'},
          ],
        });
        
    table.on('preDraw',function(){
      Pace.start();
    })
    .on('draw.dt',function(){
      $('#DataTable-Karyawan').unblock();
      Pace.stop();
    });

    $(window).on('load',function(){
      table.draw();
    });
    
  });
  </script>
@endsection
@extends('master-layout.app')
@section('title','Role')


@section('content')


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div class="page-header flex-wrap">
                <div class="header-left">
                    
                </div>
                <div class="header-right d-flex flex-wrap mt-md-2 mt-lg-0">
                  @can('plan-create')
                    <a type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text" href="{{url("/plans/create")}}" role="button">
                        <i class="mdi mdi-plus-circle"></i> Add Role </a>
                  @endcan
                </div>
            </div>
        </div>
      <div class="card-body">
        
      
        <div class="table-responsive">
            <div class="table-responsive">
                <table id="tablelistplan" class="table table-bordered">
                  <thead>
                    <tr class="text-center" style="white-space: nowrap;">

                      <th>Role Name</th>

                      <th>Action</th>
                    </tr>
                  </thead>
                 
                </table>
              </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')

<script>

var oTable = $('#tablelistplan').DataTable({
          serverSide: true,
          searching: true,
          ordering: true,
          colReorder: true,
          aaSorting: [[0, 'desc']],
          "className":'details-control',
          ajax: {
            method:"get",
              url: '{!! route('role.get-data') !!}',
              data:  function( d ){
                return $.extend({}, d, {
                    "_token"                         : "{{ csrf_token() }}",
                    "no_bilyet"                      : $("#nobilyet").val(),
                    "tanggal_pembayaran_bunga"       : $("#tanggal_pembayaran_bunga").val(),
                    "tanggal_jatuh_tempo"            : $("#tanggal_jatuh_tempo").val(),
                    "jenis"                          : $("#tipedeposito").val(),
                });
              },
          },
          columns: [
          {data: 'name', name: 'name', orderable:false},
        
          {data: 'id', name: 'id'},
      ],
    });

    function approvePlan(id){
    // e.preventDefault(); 

          Swal.fire({
            title: 'Are you sure?',
            text: "This Plan Will Be Approve!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            width:400,
          }).then((result) => {

            ajax({
                  url: `{{url("plans/approve/")}}/`+id,
                  // postData : ,
                  processData: false,
                  contentType: false,
                  success: function (ret) {
                    oTable.draw()
                  },
              });
            
          })
    }
  



</script>
    
@endsection
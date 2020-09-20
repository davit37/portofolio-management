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




</script>
    
@endsection
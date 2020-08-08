@extends('admin.layouts.master')

@section('title')
Categories
@endsection

@section('content')

@section('styles')
<style>
    #example1_filter, #example1_paginate{float: right}
    .table td, .table th {
      padding: .75rem .75rem 0 .75rem !important;
    }
</style>
@endsection
@php $site_url = 'http://127.0.0.1:8000/'; @endphp
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div>       
       
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
                          

            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="width: 100%">Categories List
                    <a href="{{ url('admin/category-create') }}" class="btn btn-primary float-right">
                    <i class="fa fa-plus"></i>Add Category
                    </a>
                </h3>
              </div>
                 @if(Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Sorry</strong> {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Great</strong> {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S. No.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Parent</th>
                    <th>Section</th>
                    <th>URL(slug)</th>
                    <th>Status</th>
                    <th>Action</th>                    
                  </tr>
                  </thead>
                  <tbody id="add_tr_ajax">
                    @if(count($categories))
                        @foreach($categories as $category)
                            <tr id="row_{{ $loop->iteration }}">
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $category->name }}</td>
                              @if($category->image != '')
                              <td><img src="{{ $site_url.env('IMG_ADMIN_PATH').$category->image }}" style="width: 30px; height: 30px;"/></td>
                              @else
                              <td></td>
                              @endif
                              @if(count((array)$category->parent))                              
                              <td>{{ $category->parent->name }}</td>
                              @else
                              <td>Root</td>
                              @endif                             
                              <td>{{ $category->section->name }}</td>
                              <td>{{ $category->slug }}</td>
                              @if($category->status)
                              <td>Active</td>
                              @else
                              <td>Inactive</td>
                              @endif
                              <td> <a href="{{ url('admin/category-delete', $category->id) }}" class="btn btn-danger text-bold"><i class="fa fa-trash"></i>Delete</a> | <a href="{{ url('admin/category-edit', $category->id) }}"  class="btn btn-warning text-bold"> Edit  <i class="fa fa-wrench" aria-hidden="true"></i></a></td>
                            </tr>
                        @endforeach
                  @endif
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S. No.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Parent</th>
                    <th>Section</th>
                    <th>URL(slug)</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

   
  @endsection

    @section('scripts')
    <!-- DataTables -->
    <script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            
            // $('#example2').DataTable({
            // "paging": true,
            // "lengthChange": false,
            // "searching": false,
            // "ordering": true,
            // "info": true,
            // "autoWidth": false,
            // "responsive": true,
            // });
        });
</script>
    @endsection

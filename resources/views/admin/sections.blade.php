@extends('admin.layouts.master')

@section('title')
Sections
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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sections</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Sections</li>
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
                <h3 class="card-title" style="width: 100%">Section(s) List
                    <button type="button" class="btn btn-primary text-bold float-right" data-toggle="modal" data-target="#modal-default">
                    <i class="fa fa-plus"></i>Add Section
                    </button>
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
                    <th>Status</th>
                    <th>Action</th>                    
                  </tr>
                  </thead>
                  <tbody id="add_tr_ajax">
                    @if(count($sections))
                        @foreach($sections as $section)
                            <tr id="row_{{ $loop->iteration }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $section->name }}</td>
                                @if($section->status)
                                <td>Active</td>
                                @else
                                <td>Inactive</td>
                                @endif
                                <td> <a href="{{ url('admin/section-delete', $section->id) }}" class="btn btn-danger text-bold"><i class="fa fa-trash"></i>Delete</a> | <a href="javascript:void(0)" data-id="{{ $section->id }}" data-name="{{ $section->name }}" data-description="{{ $section->description }}" data-status="{{ $section->status }}" data-url="{{ url('admin/section-update', $section->id) }}" data-loop_id="{{ $loop->iteration }}" class="btn btn-warning text-bold" data-toggle="modal" data-target="#edit-modal-default"> Edit  <i class="fa fa-wrench" aria-hidden="true"></i></a></td>
                            </tr>
                        @endforeach
                  @endif
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S. No.</th>
                    <th>Name</th>
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

    <div class="modal fade bd-example-modal-lg" id="modal-default">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Section</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <form id="section_add_form" autocomplete="off">
                <div id="handle_errors"></div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label">Description:</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Status:</label><br/>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                                <input type="radio" name="status" value="1" id="option1" autocomplete="off" checked> Active
                            </label>
                            <label class="btn btn-secondary">
                                <input type="radio" name="status" value="0" id="option2" autocomplete="off"> Inactive
                            </label>                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Section</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <!-- edit modal section -->
      <div class="modal fade bd-example-modal-lg" id="edit-modal-default">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Section</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <form id="section_edit_form" autocomplete="off">
                <div id="edit_handle_errors"></div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="eid" id="eid" />
                    <input type="hidden" name="loop_id" id="loop_id" />
                    <div class="form-group">
                        <label for="ename" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" name="ename" id="ename">
                    </div>
                    <div class="form-group">
                        <label for="edescription" class="col-form-label">Description:</label>
                        <textarea class="form-control" name="edescription" id="edescription"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Status:</label><br/>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-secondary active" id="estatus_label1">
                                <input type="radio" name="estatus" value="1" id="option1" autocomplete="off" checked> Active
                            </label>
                            <label class="btn btn-secondary" id="estatus_label2">
                                <input type="radio" name="estatus" value="0" id="option2" autocomplete="off"> Inactive
                            </label>                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Section</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


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
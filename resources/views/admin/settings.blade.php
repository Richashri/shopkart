@extends('admin.layouts.master')

@section('title')
Settings
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Password</h3>
              </div>

                @if(Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Wrong</strong> {{ Session::get('error_message') }}
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

                @if($errors->has('current_password') || $errors->has('new_password'))                
                    <div class="alert alert-danger">                
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach                
                    </div>
                @endif
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{ url('/admin/update-admin-pwd') }}" autocomplete="off" id="update_pwd_From">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Email</label>
                    <input type="email" class="form-control" id="admin_email" readonly="" value="{{ $admin->email }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Current Password</label>
                    <input type="password" class="form-control" name="current_password" autocomplete="off" id="current_password" placeholder="Current Password">
                    <span id="chk_pwd_msg"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword2">New Password</label>
                    <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword3">Confirm New Password</label>
                    <input type="password" class="form-control" name="new_password_confirmation" id="confirm_password" placeholder="Confirm New Password">
                  </div>
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

           

          </div>
          <!--/.col (left) -->
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">General Settings</h3>
              </div>

              @if(Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Wrong</strong> {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if(Session::has('success_message_s'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Great</strong> {{ Session::get('success_message_s') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                
                @if($errors->has('admin_name') || $errors->has('image')) 
                    <div class="alert alert-danger">                
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach                
                    </div>
                @endif
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{ url('/admin/admin-other-settings') }}" enctype="multipart/form-data" autocomplete="off" id="admin_settings">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="admin_name">Admin Name</label>
                    <input type="text" class="form-control" name="admin_name" id="admin_name" value="{{ $admin->name }}">
                  </div>
                  
                  <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" class="form-control" name="mobile" id="mobile" value="{{ $admin->mobile }}">
                  </div> 
                  
                  <div class="form-group">
                    <label for="image">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>
                 
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-warning">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

           

          </div>
          <!--/.col (right) -->
      
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
   
  </div>
@endsection
@section('scripts')
<!-- bs-custom-file-input -->
<script src="{{ url('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>

  $(document).ready(function () {
    bsCustomFileInput.init()
  })

</script>
@endsection

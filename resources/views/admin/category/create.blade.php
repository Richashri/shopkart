@extends('admin.layouts.master')

@section('title')
Add Category
@endsection

@section('content')

@section('styles')
<style>
    
</style>
@endsection
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
              <li class="breadcrumb-item active">Add Category</li>
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
                <h3 class="card-title" style="width: 100%">Add Category</h3>
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
                @if ($errors->any())
                    <div class="alert alert-danger">                
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach                
                    </div>
                @endif
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('admin/category-add') }}" method="post" id="category_add_form" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-md-6">
                        
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                            </div>
                        
                            <div class="form-group">
                                <label for="slug">Category URL(Slug) <span style="font-size: 12px; color: red;">Note: contains hypen(-) in place of space with in letters</span></label>
                                <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}" placeholder="category-name-xyz">
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="number" min="0" class="form-control" name="discount" id="discount" value="{{ old('discount') }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Category description</label>
                                <textarea class="form-control" rows="5" name="description" id="description">{{ old('description') }}</textarea>
                            </div> 
                        
                            <div class="form-group">
                                <label for="image">Category Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accecpt="image/png, image/jpeg" name="image" id="customFile">
                                    <label class="custom-file-label" for="customFile"></label>
                                </div>
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
                    <!-- {{ $categories }} {{ $categories }} -->
                    <div class="col-md-6">
                            <div class="form-group">
                                <label>Section</label>
                                <select name="section" id="section" class="form-control select2" style="width: 100%;">
                                    <option value="">--SELECT--</option>
                                  @if(count($sections))
                                    @foreach($sections as $section)
                                    <option value="{{ $section->id }}" {{ old('section') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                    @endforeach
                                  @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Parent Category</label>
                                <select name="parent" id="parent" class="form-control select2" style="width: 100%;">
                                    <option value="0">MAIN CATEGORY</option>
                                  @if(count($categories))
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('parent') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                  @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" rows="5" name="meta_description" id="meta_description">{{ old('meta_description') }}</textarea>
                            </div> 
                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <textarea class="form-control" rows="5" name="meta_keywords" id="meta_keywords">{{ old('meta_keywords') }}</textarea>
                            </div> 
                            
                    </div>                  
                   
                    </div>
                    <div class="row text-center">
                      <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="add_category" value="ADD CATEGORY" id="add_category" />
                        </div> 
                      </div>
                    </div>
                </form>
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
<!-- bs-custom-file-input -->
<script src="{{ url('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>

  $(document).ready(function () {
    bsCustomFileInput.init()
  })

</script>

@endsection

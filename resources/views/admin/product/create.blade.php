@extends('admin.layouts.master')

@section('title')
Add product
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
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Add Product</li>
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
                <h3 class="card-title" style="width: 100%">Add Product</h3>
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
                        <div class="col-md-3">
                        
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="name">code</label>
                                <input type="text" class="form-control" name="code" id="code" value="{{ old('code') }}">
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
                                <label>Brand</label>
                                <select name="brand" id="brand" class="form-control select2" style="width: 100%;">
                                    <option value="">--SELECT--</option>
                                
                                  </select>
                            </div>
                           
                             <div class="form-group">
                                <label for="discription">Discription</label>
                                <input type="text" class="form-control" name="discription" id="discription" value="{{ old('discription') }}">
                            </div>
                        <div class="form-group">
                                <label for="slug">Product URL(Slug) <span style="font-size: 12px; color: red;">Note: contains hypen(-) in place of space with in letters</span></label>
                                <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}" placeholder="product-name-xyz">
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
                    <div class="col-md-3"> <div class="form-group">
                                <label for="image">Product Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accecpt="image/png, image/jpeg" name="image" id="customFile">
                                    <label class="custom-file-label" for="customFile"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="otherimage">Other Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accecpt="image/png, image/jpeg" name="otherimage" id="customFile">
                                    <label class="custom-file-label" for="customFile"></label>
                                </div>
                            </div>
                        <div class="form-group">
                                <label for="video">video</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accecpt="mp4" name="video" id="customFile">
                                    <label class="custom-file-label" for="customFile"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="weight">weight</label>
                                <input type="number" min="0" class="form-control" name="weight" id="weight" value="{{ old('weight') }}">
                            </div>
                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="text" class="form-control" name="color" id="color" value="{{ old('color') }}">
                            </div>
                          

                            <div class="form-group">
                                <label for="fit">Fit</label>
                                <input type="text" class="form-control" name="fit" id="fit" value="{{ old('fit') }}">
                            </div>
                        <div class="form-group">
                                <label for="mrp">mrp</label>
                                <input type="number" min="0" class="form-control" name="mrp" id="mrp" value="{{ old('mrp') }}">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" min="0" class="form-control" name="price" id="price" value="{{ old('price') }}">
                            </div>
                          </div>
                            <div class="col-md-3">
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="number" min="0" class="form-control" name="discount" id="discount" value="{{ old('discount') }}">
                            </div>
                       <div class="form-group">
                                <label for="order">Order</label>
                                <textarea class="form-control" rows="5" name="order" id="order">{{ old('order') }}</textarea>
                            </div> 
                           <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" rows="5" name="meta_description" id="meta_description">{{ old('meta_description') }}</textarea>
                            </div> 
                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <textarea class="form-control" rows="5" name="meta_keywords" id="meta_keywords">{{ old('meta_keywords') }}</textarea>
                            </div> 
                             <div class="form-group">
                                <label for="meta_title">Meta Keywords</label>
                                <textarea class="form-control" rows="5" name="meta_title" id="meta_title">{{ old('meta_title') }}</textarea>
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

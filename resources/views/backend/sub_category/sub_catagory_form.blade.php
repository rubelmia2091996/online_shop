
@extends('backend.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sub Category form </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action=" {{url('post-subcategory')}} ">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="subcatagory_name">Subcategory Name</label>
                    <input type="text" class="form-control @error('subcatagory_name') is-invalid @enderror" value="{{ old('subcatagory_name') }}" name="subcatagory_name" id="subcatagory_name" placeholder="Enter name">
                    @error('subcatagory_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" name="slug" id="slug" placeholder="Enter slug">
                    @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="catagory">Select Category</label>
                    <select name="catagory" id="catagory" class="form-control">
                      <option value="">Select one</option>
                      @foreach ( $category as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->catagory_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->       
            </div>
          </div>
        </div>
    </section>
  </div>
<!-- /.content -->
@endsection
@section('script.js')
<script>
      $('#subcatagory_name').keyup(function() {
      $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
    });


  </script>
@endsection


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
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action=" {{url('post-color')}} ">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="color_name">Color Name</label>
                    <input type="text" class="form-control @error('color_name') is-invalid @enderror" value="{{ old('color_name') }}" name="color_name" id="color_name" placeholder="Enter catagory name">
                    @error('color_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" name="slug" id="slug" placeholder="Enter slug">
                    @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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
      $('#color_name').keyup(function() {
      $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
    });
  </script>
@endsection
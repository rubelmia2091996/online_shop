
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
                <h3 class="card-title">Update Subcategory</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action=" {{url('updated-subcategory')}} ">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" name="cat_id" value="{{ $subcat->id }}">
                    <label for="subcategory_name">Catagory Name</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="subcategory_name" id="subcategory_name" value="{{ $subcat->subcategory_name }}">
                    @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{ $subcat->slug }}" name="slug" id="slug" placeholder="Enter slug">
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
                  <button type="submit" class="btn btn-primary">Update</button>
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
$('#subcategory_name').keyup(function() {
      $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
    });
</script>
@endsection
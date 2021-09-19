
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
              <form method="POST" action=" {{url('updated-catagory')}} ">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" name="cat_id" value="{{ $cat->id }}">
                    <label for="name">Catagory Name</label>
                    <input type="name" class="form-control" name="catagory_name" id="name" value="{{ $cat->catagory_name }}">
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
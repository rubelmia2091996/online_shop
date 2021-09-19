
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
                <h3 class="card-title">Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action=" {{url('post-products')}} " enctype="multipart/form-data" >
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="tittle">Product Name</label>
                    <input type="text" class="form-control @error('tittle') is-invalid @enderror" value="{{ old('tittle') }}" name="tittle" id="tittle" placeholder="Enter Product Name">
                    @error('tittle')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" name="slug" id="slug" placeholder="Enter slug">
                    @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="category_id">Select Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                      <option value="">Select one</option>
                      @foreach ( $category as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->catagory_name }}</option>
                      @endforeach
                    </select>
                    <label for="subcategory_id">Select SuCategory</label>
                    <select name="subcategory_id" id="subcategory_id" class="form-control">
                    </select>
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail" id="thumbnail">
                    @error('thumbnail')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for="image_name">Gallary Image</label>
                    <input type="file" class="form-control @error('image_name') is-invalid @enderror" name="image_name[]" id="image_name" multiple>
                    @error('image_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    
                    <label for="description">description</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="summary">summary</label>
                    <textarea name="summary" id="summary" class="form-control @error('summary') is-invalid @enderror"></textarea>
                    @error('summary')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->
                  <div id="attributefield" class="ml-4 dynamic-field">
                    <div class="row">
                      <div class="col-md-3">
                        <label for="colors_id">Color</label>
                        <select name="colors_id[]" id="colors_id" class="form-control">
                          <option value="0">Select one</option>
                          @foreach ( $colors as $color)
                            <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-3">
                        <label for="sizes_id">Size</label>
                        <select name="sizes_id[]" id="sizes_id" class="form-control">
                          <option value="0">Select one</option>
                          @foreach ( $sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-2">
                        <label for="quantity">Quantity</label>
                        <input id="quantity" type="text" class="form-control" name="quantity[]">
                      </div>
                      <div class="col-md-2">
                        <label for="price">Price</label>
                        <input id="price" type="text" class="form-control" name="regular_price[]">
                      </div>
                      <div class="col-md-2">
                        <label for="saleprice">Sale Price</label>
                        <input id="saleprice" type="text" class="form-control" name="sale_price[]">
                      </div>
                    </div> 
                    <hr>
                  </div>
                
                  <div>
                    <button type="button" id="add-button" class="ml-4 btn btn-secondary float-left text-uppercase shadow-sm"><i class="fas fa-plus fa-fw"></i> Add</button>
                    <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i class="fas fa-minus fa-fw"></i> Remove</button>
                  </div>
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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
      $('#tittle').keyup(function() {
      $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
    });


    $('#category_id').change(function() {
            $category_id = $(this).val();
            if ($category_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('get-sub-catagory') }}/" + $category_id,
                    success: function(res) {
                        if (res) {
                            $("#subcategory_id").empty();
                            $("#subcategory_id").append('<option>Select One</option>');
                            $.each(res, function(key, value) {
                                $("#subcategory_id").append('<option value="' + value.id + '" >' +
                                    value.subcategory_name + '</option>');
                            });

                        } else {
                            $("#subcategory_id").empty();
                        }
                    }
                });
            }
        });




  $(document).ready(function() {
  var buttonAdd = $("#add-button");
  var buttonRemove = $("#remove-button");
  var className = ".dynamic-field";
  var count = 0;
  var field = "";
  var maxFields = 5;

  function totalFields() {
    return $(className).length;
  }

  function addNewField() {
    count = totalFields() + 1;
    field = $("#attributefield").clone();
    field.attr("id", "dynamic-field-" + count);
    field.children("label").text("Field " + count);
    field.find("input").val("");
    $(className + ":last").after($(field));
  }

  function removeLastField() {
    if (totalFields() > 1) {
      $(className + ":last").remove();
    }
  }

  function enableButtonRemove() {
    if (totalFields() === 2) {
      buttonRemove.removeAttr("disabled");
      buttonRemove.addClass("shadow-sm");
    }
  }

  function disableButtonRemove() {
    if (totalFields() === 1) {
      buttonRemove.attr("disabled", "disabled");
      buttonRemove.removeClass("shadow-sm");
    }
  }

  function disableButtonAdd() {
    if (totalFields() === maxFields) {
      buttonAdd.attr("disabled", "disabled");
      buttonAdd.removeClass("shadow-sm");
    }
  }

  function enableButtonAdd() {
    if (totalFields() === (maxFields - 1)) {
      buttonAdd.removeAttr("disabled");
      buttonAdd.addClass("shadow-sm");
    }
  }

  buttonAdd.click(function() {
    addNewField();
    enableButtonRemove();
    disableButtonAdd();
  });

  buttonRemove.click(function() {
    removeLastField();
    disableButtonRemove();
    enableButtonAdd();
  });
});




  </script>
@endsection

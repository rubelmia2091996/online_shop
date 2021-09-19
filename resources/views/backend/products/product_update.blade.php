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
                            <h3 class="card-title">Product Update</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action=" {{ url('updated-product') }} " enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <label for="tittle">Product Name</label>
                                    <input type="text" class="form-control @error('tittle') is-invalid @enderror"
                                        value="{{ $product->tittle }}" name="tittle" id="tittle"
                                        placeholder="Enter Product Name">
                                    @error('tittle')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ $product->slug }}" name="slug" id="slug" placeholder="Enter slug">
                                    @error('slug')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="category_id">Select Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach( $category as $cat)
                                            <option @if ($product->category_id == $cat->id) selected @endif
                                                value="{{ $cat->id }}">{{ $cat->catagory_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="subcategory_id">Select SubCategory</label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control">
                                        @foreach( $subCategory as $scat)
                                            <option @if ($product->subCategory_id == $scat->id) selected @endif
                                                value="{{ $scat->id }}">{{ $scat->subcategory_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="thumbnail">Thumbnail</label>
                                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail" id="thumbnail" onchange="document.getElementById('image_id').src = window.URL.createObjectURL(this.files[0])">
                                    @error('thumbnail')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <label for="image_id" class="pt-5 mb-5">Preview Thumbnail</label>
                                    <img width="100px" id="image_id" src="{{ asset('thumbnail/'.$product->thumbnail) }}" alt="{{ $product->tittle }}"> <br>
                                    {{-- gallary image --}}
                                    <label for="image_id" class="pt-5 mb-5">Preview Gallary</label> <br>
                                    @foreach ($gallaries as $gallary)
                                    <div class="row mt-3 mb-3">
                                        <div class="col-md-10">
                                            <label for="image_name">Change This Gallary Image</label>
                                            <input type="file" class="form-control" name="product_image[]" id="image_name">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="gallaryid[]" value="{{$gallary->id}}">
                                            <img width="100px" class="gallaryimage" src="{{ asset('gallery/'.$gallary->image_name) }}" alt="{{ $gallary->image_name }}"> 
                                            <a href="{{route('delete_single_image',$gallary->id)}}" id="delete_gallary_image"><i class="fas fa-trash-alt"></i> </a>                          
                                        </div>
                                    </div>
                                    @endforeach
                                     <br> 
                                    <label for="image_name">Upload More Gallary Image</label>
                                    <input type="file" class="form-control @error('image_name') is-invalid @enderror" name="add_new_product_image[]" id="image_name" multiple>
                                    
                                    @error('image_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror



                                    <label for="description">Description</label>
                                    <textarea name="description" id="description"
                                        class="form-control @error('description') is-invalid @enderror">{{ $product->description }}</textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="summary">summary</label>
                                    <textarea name="summary" id="summary"
                                        class="form-control @error('summary') is-invalid @enderror">{{ $product->summary }}</textarea>
                                    @error('summary')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- attribute update --}}
                            
                            @if ($attributes->count()>0)
                            @foreach($attributes as $attribute)
                            <div id="" class="ml-4">
                                <div class="row">
                                    <input type="hidden" class="attribute_id" name="attribute_id[]" id="attribute_id" value="{{$attribute->id}}">
                                    <div class="col-md-2">
                                        <label for="colors_id">Color</label>
                                        <select name="colors_id[]" id="colors_id" class="form-control">
                                            @foreach( $colors as $color)
                                                <option @if ($attribute->color_id==$color->id) selected @endif value="{{ $color->id }}">{{ $color->color_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="sizes_id">Size</label>
                                        <select name="sizes_id[]" id="sizes_id" class="form-control">
                                            @foreach( $sizes as $size)
                                                <option @if ($attribute->size_id==$size->id) selected @endif value="{{ $size->id }}">{{ $size->size_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="quantity">Quantity</label>
                                        <input id="quantity" type="text" class="form-control" name="quantity[]"
                                            value="{{ $attribute->quantity }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="price">Price</label>
                                        <input id="price" type="text" class="form-control" name="price[]"
                                            value="{{ $attribute->regular_price }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="saleprice">Sale Price</label>
                                        <input id="saleprice" type="text" class="form-control" name="sale_price[]" value="{{ $attribute->sale_price }}">
                                    </div>
                                    <div class="col-md-1" style="margin-top:35px;">
                                        <a  href="{{route('deleteattribute',$attribute->id)}}" id="delete"><i class="fas fa-minus-circle"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif 

                            <div class="row">
                                <div class="col-md-6 ml-4 mt-4 mb-4">
                                    <h4>Add New Varient Of This Product</h4>
                                </div>
                            </div>
                            <div id="attributefield" class="ml-4 dynamic-field">
                                
                                <div class="row">
                                    <input type="hidden" class="attribute_id" name="attribute_id[]" id="attribute_id">
                                    <div class="col-md-2">
                                        <label for="colors_id">Color</label>
                                        <select name="colors_id[]" id="colors_id" class="form-control">
                                            @foreach( $colors as $color)
                                                <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="sizes_id">Size</label>
                                        <select name="sizes_id[]" id="sizes_id" class="form-control">
                                            @foreach( $sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="quantity">Quantity</label>
                                        <input id="quantity" type="text" class="form-control" name="quantity[]">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="price">Price</label>
                                        <input id="price" type="text" class="form-control" name="price[]">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="saleprice">Sale Price</label>
                                        <input id="saleprice" type="text" class="form-control" name="sale_price[]">
                                    </div>
                                </div>
                            </div>
                                
                            <div>
                                <button type="button" id="add-button"class="ml-4 btn btn-secondary float-left text-uppercase shadow-sm"><i class="fas fa-plus fa-fw"></i> Add</button>
                                <button type="button" id="remove-button"class="btn btn-secondary float-left text-uppercase ml-1" ><i class="fas fa-minus fa-fw"></i> Remove</button>
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
    $('#tittle').keyup(function () {
        $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g, "-"));
    });


    $('#category_id').change(function () {
        $category_id = $(this).val();
        if ($category_id) {
            $.ajax({
                type: "GET",
                url: "{{ url('get-sub-catagory') }}/" + $category_id,
                success: function (res) {
                    if (res) {
                        $("#subcategory_id").empty();
                        $("#subcategory_id").append('<option>Select One</option>');
                        $.each(res, function (key, value) {
                            $("#subcategory_id").append('<option value="' + value.id +'" >' + value.subcategory_name + '</option>');
                        });

                    } else {
                        $("#subcategory_id").empty();
                    }
                }
            });
        }
    });




    $(document).ready(function () {
        var buttonAdd = $("#add-button");
        var buttonRemove = $("#remove-button");
        var className = ".dynamic-field";
        var count = 0;
        var field = "";
        var maxFields = 20;

        function totalFields() {
            return $(className).length;
        }

        function addNewField() {
            count = totalFields() + 1;
            field = $("#attributefield").clone();
            field.attr("id", "dynamic-field-" + count);
            field.children("label").text("Field " + count);
            field.find("input").val("");
            field.find("select").val(1);
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

        buttonAdd.click(function () {
            addNewField();
            enableButtonRemove();
            disableButtonAdd();
        });
                buttonRemove.click(function() {
            //     // remove database field
            //     var attr = $(".attribute_id" + ":last").val();
            //     if (attr) {
            //         $.ajax({
            //             type: "GET",
            //             url: "{{ url('get-attribute_delete') }}/" + attr,
            //             success: function(res) {
            //                 if (res) {
            //                     removeLastField();
            //                     disableButtonRemove();
            //                     enableButtonAdd();
            //                 }
            //             }
            //         });
            //     } 
            //     else {
            //         removeLastField();
            //         disableButtonRemove();
            //         enableButtonAdd();
            //     }
            removeLastField();
            disableButtonRemove();
            enableButtonAdd();
            });
            

    });
</script>
@endsection
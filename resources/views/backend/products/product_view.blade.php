@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">View Product</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('delete-all-Products') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="checkAll"> Select All</th>
                      <th>Name</th>
                      <th>Category Name</th>
                      <th>Sub Category Name</th>
                      <th>thumbnail</th>
                      <th>Color</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($products as $key=>$product)
                      <tr>
                        <td><input type="checkbox" name="delete[]" value="{{ $product->id }}"></td>
                        <td>{{$product->tittle}}</td>
                        <td>{{$product->catagory->catagory_name}}</td>
                        <td>{{$product->subCategory->subcategory_name}}</td>
                        <td><img width="100px" src="{{ asset('thumbnail/'.$product->thumbnail) }}" alt="{{$product->tittle}}"></td>
                        <td>
                          @php
                               $data=$product->attribute->unique('color_id')   
                          @endphp
                            @foreach ( $data as $colors)
                            <ul>
                              {{ $colors->color->color_name }}
                            </ul>
                            @endforeach
                        </td>
                        <td>
                          <a class="btn btn-success" href="{{ url('edit-product') }}/{{ $product->slug }}">Edit</a>
                          <a class="btn btn-danger" href="{{ url('delete-Product') }}/{{ $product->id }}">Delete</a>
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
                <div class="text-center">
                  <input type="submit" value="Delete Marked" class="btn btn-danger" >
                </div>
              </form>
              </div>
              {{ $products->links() }}
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
</div>
@endsection

@section('script.js')
<script>
$("#checkAll").click(function(){
  $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>
@endsection
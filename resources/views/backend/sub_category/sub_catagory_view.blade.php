@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('delete-all-subcategory') }}" method="POST">
                  @csrf
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="checkAll"> Select All</th>
                      <th>Id</th>
                      <th>Sub Category Name</th>
                      <th>Sub Category Slug</th>
                      <th>Catagory Id</th>
                      <th>Created at</th> 
                      <th>Updated at</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($subcat as $key=>$cat)
                      <tr>
                        <td><input type="checkbox" name="delete[]" value="{{ $cat->id }}"></td>
                        <td>{{$subcat->firstItem() + $key}}</td>
                        <td>{{$cat->subcategory_name}}</td>
                        <td>{{$cat->slug}}</td>
                        <td>{{$cat->catagory->catagory_name}}</td>
                        <td>{{$cat->created_at->format('d-M-Y h:i:s a')}}</td>
                        <td>{{$cat->updated_at->diffforHumans()}}</td>
                        <td>
                          <a class="btn btn-success" href="{{ url('update-subcategory') }}/{{ $cat->id }}">Edit</a>
                          <a class="btn btn-danger" href="{{ url('delete-subCategory') }}/{{ $cat->id }}">Delete</a>
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
                <div class="text-center">
                  <input type="submit" value="Delete Marked" class="btn btn-primary" >
                </div>
              </form>
              </div>
              {{ $subcat->links() }}
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
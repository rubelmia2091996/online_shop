
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
                {{-- <form action="{{ url('permanently-delete-all-subcategory') }}" method="POST">
                @csrf --}}
                <form action="{{url('restore-all-subcategory') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th><input type="checkbox" id="checkAll"> Select All</th>
                        <th>Id</th>
                        <th>Catagory Name</th>
                        <th>Slug</th>
                        <th>Catagory Name</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($catagories as $key=>$cat)
                        <tr>
                          <td><input type="checkbox" name="rest[]" value="{{ $cat->id }}"></td>
                        <td>{{$catagories->firstItem() + $key}}</td>
                        <td>{{$cat->subcategory_name}}</td>
                        <td>{{$cat->slug}}</td>
                        <td>{{$cat->catagory->catagory_name}}</td>
                        <td>{{$cat->created_at->format('d-M-Y h:i:s a')}}</td>
                        <td>{{$cat->updated_at->diffforHumans()}}</td>
                        <td>
                            <a class="btn btn-success" href="{{ url('restore-subcategory') }}/{{ $cat->id }}">Restore</a>
                            <a class="btn btn-danger" href="{{ url('permanentdelete-catagory') }}/{{ $cat->id }}">Permanent Delete</a>
                        </td>
                      </tr>
                      <a  class="btn btn-success" href="{{ url('permanently-delete-all-subcategory') }}/{{ $cat->id }}">Permanante Delete</a>
                        @endforeach
                    </tbody>
                  </table>
                  <div class="text-center">
                    <input type="submit"  value="Restore Marked" class="btn btn-primary" >
                  </div>
              </form>
              {{-- <div class="mt-5 text-center">
                <input type="submit" value="Permanently Delete Marked" class="btn btn-danger" >
              </div>
              </form> --}}
              </div>
              {{ $catagories->links() }}
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
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
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="checkAll"> Select All</th>
                      <th>Id</th>
                      <th>Catagory Name</th>
                      <th>Slug</th>
                      <th>Created at</th>
                      <th>Updated at</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($color as $key=>$colors)
                      <tr>
                        <td><input type="checkbox" name="delete[]" value="{{ $colors->id }}"></td>
                        <td>{{$color->firstItem() + $key}}</td>
                        <td>{{$colors->color_name}}</td>
                        <td>{{$colors->slug}}</td>
                        <td>{{$colors->created_at->format('d-M-Y h:i:s a')}}</td>
                        <td>{{$colors->updated_at->diffforHumans()}}</td>
                        <td>
                          <a class="btn btn-success" href="{{ url('update-color') }}/{{ $colors->id }}">Edit</a>
                          <a class="btn btn-danger" href="{{ url('delete-color') }}/{{ $colors->id }}">Delete</a>
                        </td>
                    </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
              {{ $color->links() }}
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

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
                      <th>Id</th>
                      <th>Catagory Name</th>
                      <th>Slug</th>
                      <th>Created at</th>
                      <th>Updated at</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($catagories as $key=>$cat)
                      <tr>
                      <td>{{$catagories->firstItem() + $key}}</td>
                      <td>{{$cat->catagory_name}}</td>
                      <td>{{$cat->Slug}}</td>
                      <!-- <td>{{$cat->created_at}}</td> -->
                      <td>{{$cat->created_at->format('d-M-Y h:i:s a')}}</td>
                      <td>{{$cat->updated_at->diffforHumans()}}</td>
                      <td>
                          <a class="btn btn-success" href="{{ url('restore-catagory') }}/{{ $cat->id }}">Restore</a>
                          <a class="btn btn-danger" href="{{ url('permanent-delete-catagory') }}/{{ $cat->id }}">Permanent Delete</a>
                      </td>
                    </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
              {{ $catagories->links() }}
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
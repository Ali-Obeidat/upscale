<x-admin.admin_master>
    @section('content')
    @if(Session('massage'))
  <div class="alert alert-danger"> 
      {{Session('massage')}}
  </div>
    @elseif (Session('Role_create_massage'))
    <div class="alert alert-success"> 
      {{Session('Role_create_massage')}}
  </div>

    
  @endif
    <div class="container">
        <h2>Create role</h2>
        <form action="{{route('roles.store')}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Name">Name:</label>
                <input type="text" class="form-control form-control @error('name') is-invalid @enderror" id="Name" placeholder="Enter The Name" name="name">
                @error('name')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            @csrf

            <button style="margin-bottom: 10px;" type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Roles</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>

                                <th>Id</th>
                                <th>role name</th>

                                <th>Delete </th>

                            </tr>

                        </thead>
                        <tfoot>
                            <tr>
                                
                                <th>Id</th>
                                <th>role name</th>
                                <th>Delete </th>


                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach($roles as $role)

                            <tr>

                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>




                                <td>
                                        <form method="post" action="{{route('roles.destroy',$role->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-danger" type="submit" name="submit" value="DELETE">
                                        </form>
                                    </td>
                            </tr>

                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endsection


</x-admin.admin_master>
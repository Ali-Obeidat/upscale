<x-admin.admin_master>
    @section('content')
    <h1>Employees</h1>
    @if(Session('massage'))
  <div class="alert alert-danger"> 
      {{Session('massage')}}
  </div>
    @elseif (Session('User_create_massage'))
    <div class="alert alert-success"> 
      {{Session('User_create_massage')}}
  </div>
    @elseif (Session('User_update_massage'))
    <div class="alert alert-success"> 
      {{Session('User_update_massage')}}
  </div>
    
  @endif

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Employees: </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Id</th>
                                <th>Employee Name</th>
                                <th>Company Name</th>
                                <th>Role </th>
                                <th>Registered date</th>
                                <th>Edit</th>
                                <th>Delete </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>Id</th>
                                <th>Employee Name</th>
                                <th>Company Name</th>
                                <th>Roles </th>
                                <th>Registered date</th>
                                <th>Edit</th>
                                <th>Delete </th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($employees as $employee)
                                <tr>
                                    <td>{{$employee->id}}</td>
                                    <td>{{$employee->name}}</td>
                                    <td>{{$employee->company->name}}</td>
                                    <td style="display: flex;">
                                        <ul>
                                            @foreach ($employee->roles as $role)
                                            <li>
                                        {{$role->name}}
                                            </li>
                                         
                                            @endforeach
                                        </ul>
                                        @if(Auth::user()->userHasRole('super admin'))
                                        <a href="{{route('employees.show',$employee->id)}}" style="padding-left: 10px;">
                                            <button class="btn btn-primary">change</button></a>
                                            @endif
                                    </td>
                                    <td>{{$employee->created_at->diffForhumans()}}</td>
                                    <td> <a href="{{route('employees.edit',$employee->id)}}"><button class="btn btn-primary">Edit</button></a>  </td>
                                    <td>
                                        <form method="post" action="{{route('employees.destroy',$employee->id)}}" enctype="multipart/form-data">
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

    @endsection
    @section('script')
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
@endsection

</x-admin.admin_master>
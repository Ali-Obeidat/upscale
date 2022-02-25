<x-admin.admin_master>
@section('content')

  <h2>All Posts</h2>
  @if(Session('massage'))
  <div class="alert alert-danger"> 
      {{Session('massage')}}
  </div>
    @elseif (Session('Company_create_massage'))
    <div class="alert alert-success"> 
      {{Session('Company_create_massage')}}
  </div>
    @elseif (Session('company_updated_massage'))
    <div class="alert alert-success"> 
      {{Session('company_updated_massage')}}
  </div>
    
  @endif
  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th>Id</th>
                      <th>Logo</th>
                      <th>Company Name</th>
                      <th>Email</th>
                      <th>Website</th>
                      <th>Edit</th>
                      <th>Delete </th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Logo</th>
                      <th>Company Name</th>
                      <th>Email</th>
                      <th>Website</th>
                      <th>Edit</th>
                      <th>Delete </th>
                    </tr>
                  </tfoot>
                  <tbody>
                      @foreach ($companies as $company)
                    <tr>
                      <td>{{$company->id}}</td>
                      <td><img width="100" src="{{$company->logo}}" alt=""> </td>
                      <td><a>{{$company->name}}</a></td>
                      <td>{{$company->email}}</td>
                      <td>{{$company->website}}</td>
                     <td> <a href="{{route('companies.edit',$company->id)}}"><button class="btn btn-primary">Edit</button></a>  </td>
                      <td>
                      <form method="post" action="{{route('companies.destroy',$company->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger" type="submit" name="submit" value="DELETE">
                      </form>
                      </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
                {{ $companies->links() }}
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
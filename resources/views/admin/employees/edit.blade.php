<x-admin.admin_master>
@section('content')
<div class="container">
        <h2>Create employee</h2>
        <form action="{{route('employees.update',$Employee->id)}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Name">Name:</label>
                <input type="text" class="form-control" value="{{$Employee->name}}" id="Name" placeholder="Enter The Name" name="name">
            </div>
            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="email" value="{{$Employee->email}}"  class="form-control" id="Email" placeholder="Enter The email" name="email">
            </div>
            <label for="">Companies:</label>
            <select class="form-select form-control" name="company_id" aria-label="Default select example">
                <option value="{{$Employee->company->id}}" selected>{{$Employee->company->name}}</option>
                @foreach ($companies as $company)
                @if($company->id === 1 || $Employee->company->id== $company->id  )
                    @continue
                @endif
                <option value="{{$company->id}}">{{$company->name}}</option>
                
                @endforeach
            </select>
           
            <div class="form-group">
                <label for="Website">password</label>
                <input type="password" class="form-control" id="Website" placeholder="Enter The password" name="password">
            </div>
            @csrf
            @method('PUT')  
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection


</x-admin.admin_master>
<x-admin.admin_master>
    @section('content')
    <div class="container">
        <h2>Create employee @if(Auth::user()->userHasRole('company admin')) for {{$comp[0]->name}} @endif</h2>
        <form action="{{route('employees.store')}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Name">Name:</label>
                <input type="text" class="form-control form-control @error('name') is-invalid @enderror" id="Name" placeholder="Enter The Name" name="name">
                @error('name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
            </div>
            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="email" class="form-control form-control @error('email') is-invalid @enderror"  id="Email" placeholder="Enter The email" name="email">
                @error('email')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
            </div>
            @if(Auth::user()->userHasRole('company admin'))
            <input hidden type="text" name="Type" value="{{$role[0]->id}}">
            @endif
            <label for="">Companies:</label>
            <select class="form-select form-control @error('company_id') is-invalid @enderror" name="company_id" aria-label="Default select example">
            @if(Auth::user()->userHasRole('company admin'))
            <option value="{{$comp[0]->id}}" selected>{{$comp[0]->name}}</option>
            @endif
            
            @if(Auth::user()->userHasRole('super admin'))
            <option value="0" selected>Company</option>
            @foreach ($companies as $company)
            @if($company->id === 1)
            @continue
            @endif
            <option value="{{$company->id}}">{{$company->name}}</option>
            
            @endforeach
            @endif
        </select>
          
            @if(Auth::user()->userHasRole('super admin'))
            <label for="">User Role:</label>
            <select class="form-select form-control @error('company_id') is-invalid @enderror" name="Type" aria-label="Default select example">
                <option value="0" selected>Select user Role</option>
                @foreach ($roles as $role)
                @if($role->id === 1)
                    @continue
                @endif
                <option value="{{$role->id}}">{{$role->name}}</option>
                
                @endforeach
                
            </select>
            @endif
            <div class="form-group">
                <label for="Website">password</label>
                <input type="password" class="form-control form-control @error('password') is-invalid @enderror" id="Website" placeholder="Enter The password" name="password">
                @error('password')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
            </div>
            @csrf

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    @endsection


</x-admin.admin_master>
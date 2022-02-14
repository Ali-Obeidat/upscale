<x-admin.admin_master>
@section('content')
<h1>User Profile for : {{$user->name}}</h1>


<div class="row">

        <div class="col-sm-6">

                <form method="post" action="{{route('user.profile.update',Auth::user())}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                                <img width="100" height="100" class="img-profile rounded-circle" src="{{$user->avatar}}">
                        </div>
                        
                        <div class="form-group">
                                <input type="file" name="avatar">
                        </div>
                        <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text"
                                       name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       value="{{$user->name}}"
                                >
                                @error('name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                        </div>


                        <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text"
                                       name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       value="{{$user->email}}"

                                >

                                @error('email')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                        </div>

                        <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password"
                                       name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       id="password"
                                >

                                <!-- <!-- @error('password') -->
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror -->
                        </div>


                        <div class="form-group">
                                <label for="password-confirmation">Confirm Password</label>
                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       id="password-confirmation"


                                >

                                @error('password_confirmation')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                        </div>



                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>

        </div>

</div>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                        <th>Options</th>
                            <th>Id</th>
                            <th>role name</th>
                            <th>slug</th>
                            <th>Attach</th>
                            <th>Detach</th>
                            
                        </tr>

                   </thead>
                        <tfoot>
                        <tr>
                            <th>Options</th>
                            <th>Id</th>
                            <th>role name</th>
                            <th>slug</th>
                            <th>Attach</th>
                            <th>Detach</th>
                            
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($roles as $role)

                        <tr>
                            <td><input type="checkbox" name="" id=""
                                @foreach($user->roles as $user_role)
                                @if($user_role->name == $role->name)
                                checked
                                @endif

                                @endforeach
                            ></td>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                          
                            <td>{{$role->slug}}</td>
                        <td>
                                <form method="post" action="{{route('user.attach.role',[$role->id,$user->id])}}">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-primary"
                                        @if($user->roles->contains($role))
                                        disabled
                                        @endif
                                        >Attach</button>
                                </form>
                                    
                        </td>
                        
                            <td>
                            <form method="post" action="{{route('user.detach.role',[$role->id,$user->id])}}">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-danger"
                                        @if(!$user->roles->contains($role))
                                        disabled
                                        @endif>Detach</button>
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


</x-admin_master>
<x-admin.admin_master>
    @section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Roles For {{$user->name}}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                        <th>Options</th>
                            <th>Id</th>
                            <th>role name</th>
                           
                            <th>Attach</th>
                            <th>Detach</th>
                            
                        </tr>

                   </thead>
                        <tfoot>
                        <tr>
                            <th>Options</th>
                            <th>Id</th>
                            <th>role name</th>
                           
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
</x-admin.admin_master>
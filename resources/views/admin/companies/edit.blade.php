<x-admin.admin_master>
@section('content')
<div class="container">
  <h2>Edit Company</h2>
  <form action="{{route('companies.update',$Company->id)}}" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter The name" value="{{$Company->name}}" name="name">
    </div>
    <div class="form-group">
      <label for="Email">Email:</label>
      <input type="email" class="form-control" id="Email" value="{{$Company->email}}" placeholder="Enter The email" name="email">
    </div>
    <div class="form-group">
      <label for="Logo">Company Logo:</label>
      <div style="margin-bottom: 10px;">
          <img width="300" src="{{$Company->logo}}" alt="">
      </div>
      <input type="file" class="form-control-file" id="Logo" placeholder="Enter password" name="logo">
    </div>
    <div class="form-group">
      <label for="Website">Website</label>
      <input type="text" class="form-control" value="{{$Company->website}}" id="Website"  placeholder="Enter The Website" name="website">
    </div>
    @csrf
        @method('PUT')      
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
    <a href="{{route('companies.index')}}"><input type="button" value="Close" class="btn btn-danger"></a>
        
  </form>
</div>

@endsection


</x-admin.admin_master>
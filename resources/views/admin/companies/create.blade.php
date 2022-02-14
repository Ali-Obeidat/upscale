<x-admin.admin_master>
@section('content')
<div class="container">
  <h2>Create company</h2>
  <form action="{{route('companies.store')}}" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="Name">Name:</label>
      <input type="text" class="form-control" id="Name" placeholder="Enter The Name" name="name">
    </div>
    <div class="form-group">
      <label for="Email">Email:</label>
      <input type="email" class="form-control" id="Email" placeholder="Enter The email" name="email">
    </div>
    <div class="form-group">
      <label >Logo:</label>
      <input type="file" class="form-control-file"   name="logo">
    </div>
    <div class="form-group">
      <label for="Website">Website</label>
      <input type="text" class="form-control" id="Website" placeholder="Enter The Website" name="website">
    </div>
    @csrf
   
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@endsection


</x-admin.admin_master>
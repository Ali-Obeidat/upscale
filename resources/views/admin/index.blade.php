<x-admin.admin_master>
@section('content')
@if(Auth::user()->userHasRole('Admin'))
<h1>Ali</h1>
@endif
@endsection


</x-admin.admin_master>
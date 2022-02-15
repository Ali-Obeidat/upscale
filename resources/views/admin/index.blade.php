<x-admin.admin_master>
@section('content')
@if(Auth::user()->userHasRole('super admin'))
<h1>Welcome super admin </h1>
@endif
@if(Auth::user()->userHasRole('company admin'))
<h1>Welcome company admin </h1>
@endif
@endsection


</x-admin.admin_master>
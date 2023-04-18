@extends('dashboard/layouts/master')
@section('content')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> --}}

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 70%;
  margin-left: 15%;
  margin-top: 50px;
  color: white;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
/* 
tr:nth-child(even) {
  background-color: #dddddd;
} */
</style>
@if(session('status'))
<div class="alert alert-success mb-1 mt-1" style="color:white">
    {{ session('status') }}
</div>
@endif
<table>
    <tr>
      <th>logo</th>
      <th>Company</th>
      <th>email</th>
      <th>website</th>
      <th>actions</th>

    </tr>
    @foreach ($companies as $company)
    <tr>
      <td><img src="images/logos/{{ $company->logo }}" style="width: 100px;maxheight:100px"></td>
      <td>{{ $company->name }}</td>
      <td>{{ $company->email }}</td>
      <td><a href="{{ $company->website }}" style="color: white">website</a></td>
      <form action="{{ route('companies.destroy',$company->id) }}" method="Post">
        
    <td class=" last"><a class="btn btn-success" href="{{ url('editcompany?id=' . $company['id']) }}"><i class="fa fa-pencil"></i>Edit</a>
    
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger"  onclick="return confirm('Are you sure?');"> <i class="fa fa-trash-o"></i>Delete</button></a>
</td>
  </form>
    </tr>
    @endforeach
    
    
  </table>
  <div class="d-flex justify-content-center" style="background-color: #2c3e50;color:white">
    {!! $companies->links('pagination::bootstrap-4') !!}
</div>
@endsection
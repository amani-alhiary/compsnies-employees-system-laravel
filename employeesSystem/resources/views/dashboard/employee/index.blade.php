@extends('dashboard/layouts/master')
@section('content')



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
          <th>First Name</th>
          <th>Last Name</th>
          <th>email</th>
          <th>phone</th>
          <th>Company Name</th>
          <th>actions</th>

    
        </tr>
        @foreach ($employees as $employee)
        <tr>
          {{-- <td><img src="images/logos/{{ $company->logo }}" style="width: 100px;maxheight:100px"></td> --}}
          <td>{{ $employee->first_name }}</td>
          <td>{{ $employee->last_name }}</td>
          <td>{{ $employee->email }}</td>
          <td>{{ $employee->phone }}</td>
          <td>{{ $employee->name }}</td>


          <form action="{{ route('employees.destroy',$employee->id) }}" method="Post">
            
        <td class=" last"><a class="btn btn-success" href="{{ url('editemployee?id=' . $employee->id) }}"><i class="fa fa-pencil"></i>Edit</a>
        
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"  onclick="return confirm('Are you sure?');"> <i class="fa fa-trash-o"></i>Delete</button></a>
    </td>
      </form>
        </tr>
        @endforeach
        
        
      </table>
      
      <div class="d-flex justify-content-center" style="background-color: #2c3e50;color:white">
        {!! $employees->links('pagination::bootstrap-4') !!}
    </div>

@endsection
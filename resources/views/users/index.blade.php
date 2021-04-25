@extends('layouts.app')
     
@section('content')
<div class="form-group col-md-8" style="left: 175px;">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>User</h2>
            </div>
            
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <table class="table table-bordered">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Birthdate</th>
                <th>Email</th>
                <th width="280px">Action</th>
            </tr>@foreach ($users as $user)
            <tr>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->dob }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                    
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
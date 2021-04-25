@extends('layouts.app')
     
@section('content')
<div class="form-group col-md-8" style="left: 175px;">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('admin.create') }}"> Create New User</a>
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
                    <a class="btn btn-primary" href="{{ route('admin_edit.edit',$user->id) }}">Edit</a>
                    <form action="{{ route('admin.destroy',$user->id) }}" method="POST">@csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
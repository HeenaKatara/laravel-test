@extends('layouts.app')
     
@section('content')
<div class="form-group col-md-8" style="left: 175px;">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Blog</h2>
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
                <th>Id</th>
                <th>Title</th>
                <th>Content</th>
            </tr>@foreach ($blogs as $blog)
            <tr>
                <td>{{ $blog->id }}</td>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->content }}</td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
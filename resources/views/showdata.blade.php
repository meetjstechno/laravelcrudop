@extends('layout')

@section('content')
<br>
<main class="table-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Students List
                            <a href="{{ 'dashboard' }}" style="float: right" class="btn btn-danger float-end">ADD
                                DATA</a>
                            <form class="form-inline my-2 my-lg-0" method="GET" action="search"
                                style="float: right; margin-right:15px;">
                                <input class="form-control mr-sm-2" name="query" type="search"
                                    placeholder="Search Student Data">
                                <button class="btn btn-success" type="submit">Search</button>
                            </form>

                        </h2>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <br>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Student Name</th>
                        <th>Email ID</th>
                        <th>Course</th>
                        <th>Profile Image</th>
                        <th width="180px">Action</th>
                    </tr>
                    @foreach ($data as $row)
                    <tr>
                        <td>{{ $row -> id }}</td>
                        <td>{{ $row -> name }}</td>
                        <td>{{ $row -> email }}</td>
                        <td>{{ $row -> course }}</td>
                        <td><img src="/uploads/students/{{ $row -> profile_image }}" width="100px"></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ route('edit',$row->id) }}">Edit</a>
                            <a class="btn btn-sm btn-danger" href="{{ route('delete',$row->id) }}">delete</a>
                            {{-- <form action="{{ route('delete',$row->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form> --}}
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">{{ $data ->links() }}</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</main>
@endsection
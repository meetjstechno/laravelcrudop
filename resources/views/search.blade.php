@extends('layout')

@section('content')
<main class="table-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
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
                </table>

            </div>
        </div>
    </div>
</main>
@endsection
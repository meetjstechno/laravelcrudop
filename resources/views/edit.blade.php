@extends('layout')

@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">

            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Edit Student
                        <a href="{{ route('showdata') }}" style="float: right" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="edit" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value={{$data->id}} class="form-control">

                        <div class="form-group mb-3">
                            <label for="">Student Name</label>
                            <input type="text" name="name" value="{{$data->name}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Student Email</label>
                            <input type="text" name="email" value="{{$data->email}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label>Course:</label>
                            <select name="course" id="course" value="{{$data->course}}"
                                class=" form-control col-sm-12 @error('course') is-invalid @enderror" required>
                                <option value="Computer">Computer</option>
                                <option value="Mechanical">Mechanical</option>
                                <option value="Civil">Civil</option>
                                <option value=" Electrical">Electrical</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Student Profile Image</label>
                            <input type="file" name="profile_image" class="form-control">
                            <img src="{{ asset('uploads/students/'.$data->profile_image) }}" width="70px" height="70px"
                                alt="Image">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update Student</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
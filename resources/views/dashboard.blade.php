@extends('layout2')

@section('content')
<main class="table-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <b>Add Student Data</b>
                        <a href="{{ route('showdata') }}" class="btn btn-primary" style="float: right;">SHOW DATA</a>

                    </div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('status') }}
                        </div>
                        @elseif(session('failed'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('failed') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ url('post-dashboard') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Student Name:</label>
                                <input type="text" name="name" id="name"
                                    class=" form-control col-sm-12 @error('name') is-invalid @enderror"
                                    placeholder="Student Name" value="{{ old('name') }}" required />
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" id="email_id"
                                    class="form-control col-sm-12 @error('email') is-invalid @enderror"
                                    placeholder="Email Id" value="{{ old('email') }}" required />
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Course:</label>
                                <select name="course" id="course"
                                    class=" form-control col-sm-12 @error('course') is-invalid @enderror" required>
                                    <option value="Computer">Computer</option>
                                    <option value="Mechanical">Mechanical</option>
                                    <option value="Civil">Civil</option>
                                    <option value=" Electrical">Electrical</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Profile Image:</label>
                                <input type="file" name="profile_image" id="profile_image"
                                    class="form-control col-sm-12" required>
                                @error('profile_image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="col-sm-3 btn btn-primary"
                                style="margin-left: 450px;">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
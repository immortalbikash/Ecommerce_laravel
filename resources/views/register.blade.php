@extends('layout_user')
@section('content')
@include('header_user');
<div class="album py-5" style="height:120vh">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="card border-success" style="max-width: 65rem;padding: 2%;">

            <div class="row mb-3">
                <div class="col">
                    <h2> Registration </h2>
                </div>
                <div class="col">
                    <a href="{{ route('loginlogin') }}" class="float-end btn btn-outline-dark" style="margin-top: -5%;">Login</a>
                </div>
            </div>
            {{-- validation error message --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <hr>
            <div class="card-body">
                {{-- enctype is decleared to upload image other wise image wont upload --}}
                <form method="POST" action="{{ route('store_user') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname" name="first_name" placeholder="Bikash"
                                required="">
                        </div>
                        <div class="col">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="last_name" placeholder="Katwal"
                                required="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="name@example.com" required="">
                        </div>
                        <div class="col">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact" name="contact"
                                placeholder="1234567890" required="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="password" required="">
                        </div>
                        <div class="col">
                            <label for="gender" class="form-label">Gender</label><br>
                            <input type="radio" id="gender" name="gender" value="Male" checked>Male
                            <input type="radio" id="gender" name="gender" value="Female">Female
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" rows="3" name="address"
                                    placeholder="address" required=""></textarea>
                        </div>
                        <div class="col">
                            <label for="inputCountry" class="form-label">Country</label>
                            <select class="form-select" id="inputCountry" name="country" aria-label="Default select example"
                                    required="">
                                <option selected disabled>Select</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="profile" class="form-label">Profile</label><br>
                            <input type="file" class="form-control-file" name="profile" id="profile">
                        </div>
                    </div>
                    <br>
                    <div class="mb-3">
                        <input type="submit" name="regist" id="regist" value="Register" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('admin.layout')
@section('content')
<div class="container h-100" style="margin: 7% 0% 7% 15%;">
    <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit User</li>
        </ol>
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header"><h5>Profile Picture</h5></div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded-circle mb-2"
                             src="{{ url('profiles') . '/' .$id->profile }}" alt="profile pic" style="width: 250px; height: 250px;">
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <form method="POST" action="{{ route('admin_image_update', ['id'=>$id->id]) }}" enctype="multipart/form-data">
                            @csrf
                        <!-- Profile picture upload button-->
                            <input type="file" class="form-control" id="profile" name="profile" placeholder="profile">
                            <input type="submit" name="update" id="update" value="Update Profile Image"
                            class="btn btn-outline-primary mt-2">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header"><h5>Account Details</h5></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin-update-user', ['id' => $id->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                           placeholder="Bikash"
                                           required="" value="{{ $id->first_name }}">
                                </div>
                                <div class="col">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                           required="" value="{{ $id->last_name }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="name@example.com" required="" value="{{ $id->email }}">
                                </div>
                                <div class="col">
                                    <label for="contact" class="form-label">Contact Number</label>
                                    <input type="tel" class="form-control" id="contact" name="contact"
                                           placeholder="1234567890" required="" value="{{ $id->contact }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="gender" class="form-label">Gender</label><br>
                                    <input type="radio" id="gender" name="gender" value="Male" @if($id->gender == 'Male') checked @endif>&nbsp;&nbsp;Male&nbsp;&nbsp;
                                    <input type="radio" id="gender" name="gender" value="Female" @if($id->gender == 'Female') checked @endif>&nbsp;&nbsp;Female
                                </div>
                                <div class="col">
                                    <label for="role" class="form-label">Role</label><br>
                                    <input type="radio" id="role" name="role" value="1" @if($id->role_id == 1) checked @endif >&nbsp;&nbsp;Admin&nbsp;&nbsp;
                                    <input type="radio" id="role" name="role" value="0" @if($id->role_id == 0) checked @endif>&nbsp;&nbsp;User
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" rows="3" name="address"
                                              placeholder="address" required="">{{ $id->address }}</textarea>
                                </div>
                                <div class="col">
                                    <label for="country" class="form-label">Country</label>
                                    <select class="form-select" id="country"
                                            aria-label="Default select example"
                                            required="" name="country">
                                        <option selected disabled>Select</option>
                                        @foreach($countries as $country)
                                            <option name="country" id="country" value="{{ $country->id }}" @if($id->country == $country->id) selected @endif>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <input type="submit" name="update" id="update" value="Update Profile"
                                       class="btn btn-outline-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

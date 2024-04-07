@extends('layout_user')
@section('content')
<div class="container h-100" style="margin: 7% 0% 7% 15%;">
    <div class="container-xl px-4 mt-4">
        @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <!-- Account page navigation-->
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header"><h5>Profile Picture</h5></div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded-circle mb-2"
                             src="{{ url('profiles') . '/' .$user->profile }}" alt="profile pic" style="width: 250px; height: 250px;">
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <form method="POST" action="{{ route('user_image_update') }}" enctype="multipart/form-data">
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
                        <form method="POST" action="{{ route('user_profile_update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                           placeholder="Bikash"
                                           required="" value="{{ $user->first_name }}">
                                </div>
                                <div class="col">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                           placeholder="Katwal"
                                           required="" value="{{ $user->last_name }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="name@example.com" required="" value="{{ $user->email }}">
                                </div>
                                <div class="col">
                                    <label for="contact" class="form-label">Contact Number</label>
                                    <input type="tel" class="form-control" id="contact" name="contact"
                                           placeholder="1234567890" required="" value="{{ $user->contact }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="gender" class="form-label">Gender</label><br>
                                    <input type="radio" id="gender" name="gender" value="Male" @if($user->gender=='Male') checked @endif>&nbsp;&nbsp;Male&nbsp;&nbsp;
                                    <input type="radio" id="gender" name="gender" value="Female" @if($user->gender=='Female') checked @endif>&nbsp;&nbsp;Female
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" rows="3" name="address"
                                              placeholder="address" required="">{{ $user->address }}</textarea>
                                </div>
                                <div class="col">
                                    <label for="country" class="form-label">Country</label>
                                    <select class="form-select" id="country"
                                            aria-label="Default select example"
                                            required="" name="country">
                                        <option selected disabled>Select</option>
                                        @foreach($countries as $country)
                                            <option name="country" id="country" value="{{ $country->id }}" @if($user->country == $country->id) selected @endif>{{ $country->name }}</option>
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
        <!-- Orders Section -->
        <div class="row">
            <div class="col-xl">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header"><h5>My Orders</h5></div>
                    <div class="card-body text-center">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Date</th>
                                <th scope="col">Price</th>
                                <th scope="col">Shipping Charge</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td scope="row">1</td>
                                <td>Titan Watch</td>
                                <td>17-02-2022</td>
                                <td>₹1000</td>
                                <td>₹00</td>
                                <td>5</td>
                                <td>₹5000</td>
                                <td>Delivered</td>
                            </tr>
                            <tr>
                                <td scope="row">2</td>
                                <td>Police Watch</td>
                                <td>17-02-2022</td>
                                <td>₹1000</td>
                                <td>₹00</td>
                                <td>5</td>
                                <td>₹5000</td>
                                <td>Attempted Delivery</td>
                            </tr>
                            <tr>
                                <td scope="row">3</td>
                                <td>Rolex Watch</td>
                                <td>17-02-2022</td>
                                <td>₹1000</td>
                                <td>₹00</td>
                                <td>5</td>
                                <td>₹5000</td>
                                <td>Confirmed</td>
                            </tr>
                            <tr>
                                <td scope="row">4</td>
                                <td>Tag Heuer Watch</td>
                                <td>17-02-2022</td>
                                <td>₹1000</td>
                                <td>₹00</td>
                                <td>5</td>
                                <td>₹5000</td>
                                <td>Out for delivery</td>
                            </tr>
                            <tr>
                                <td scope="row">5</td>
                                <td>Titan Watch</td>
                                <td>17-02-2022</td>
                                <td>₹1000</td>
                                <td>₹00</td>
                                <td>5</td>
                                <td>₹5000</td>
                                <td>On its way</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

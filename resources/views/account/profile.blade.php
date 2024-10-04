@extends('Templates.app', ['title' => 'Profile | Apotek'])

@section('content-dinamis')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Profile Header -->
                <div class="profile-header text-center shadow-lg">
                    <img src="https://via.placeholder.com/150" alt="Profile Picture" class="profile-img img-thumbnail">
                    <h3 class="mb-1">John Doe</h3>
                    <p class="text-light">Admin</p>
                </div>

                <!-- Profile Information Card -->
                <div class="profile-card mt-4 p-4">
                    <h4>Profile Information</h4>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Name:</strong>
                        </div>
                        <div class="col-sm-8">
                            John Doe
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-sm-8">
                            johndoe@example.com
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <strong>Role:</strong>
                        </div>
                        <div class="col-sm-8">
                            Admin
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="#" class="btn btn-edit-profile">Edit Profile</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

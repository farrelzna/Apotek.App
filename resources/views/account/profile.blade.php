@extends('Templates.app', ['title' => 'Profile | Apotek'])

@section('content-dinamis')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Profile Header -->
                <div class="profile-header text-center rounded-bottom shadow-lg p-4">
                    <img src="https://via.placeholder.com/150" alt="Profile Picture" class="profile-img img-thumbnail">
                    <p class="text-dark">  {{ Auth::user()->name }} </p>
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
                            {{ Auth::user()->name }}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ Auth::user()->email }}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <strong>Role:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ Auth::user()->role }}
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('users.edit', Auth::user()->id) }}" class="btn btn-primary me-3">Edit Profile</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@extends('layouts.masterAdmin')
@section('title', 'Admin - Home')
@section('content')

    <section class="container">
        <div class="mt-5 home__welcome">
            @php
                $photo = $currentUser->admin_avatar ?? 'user.svg';
            @endphp
            <figure class="home__user--avatar-container">
                <img class="home__user--avatar render__image" src="{{ url('storage/img/users/' . $photo) }}" alt="">
            </figure>

            <p class="welcome">
                Welcome {{ ucwords($currentUser->name)}}!
            </p>

            @if (Session::get('error'))
                <h3 class="text-danger">{{ Session::get('error') }}</h3>
            @endif
        </div>
    </section>

    <section class="container">
        <h3 class="card-title h3">Update your information</h3>
        <div class="row">
            @if (Session::get('error'))
                <h3 class="text-danger">{{ Session::get('error') }}</h3>
            @endif
            @if (Session::get('success'))
                <h3 class="text-success">{{ Session::get('success') }}</h3>
            @endif
            <div class="col-md-6">
                <form action="{{ route('updateAdmin') }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div>
                        <label for="name" class="form-label">Name</label>
                        <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}"
                            placeholder="Name">
                        <p class="text-warning">@error('name') {{ $message }} @enderror</p>
                    </div>
                    <div>
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}"
                            placeholder="E-mail">
                        <p class="text-warning">@error('email') {{ $message }} @enderror</p>
                    </div>
                    <div>
                        <label for="pass" class="form-label">Password</label>
                        <input class="form-control" type="password" id="pass" name="password" placeholder="Password">
                        <p class="text-warning">@error('password') {{ $message }} @enderror</p>
                    </div>
                    <div>
                        <label for="image" class="form-label">Profile photo</label>
                        <input class="form-control" type="file" id="image" name="image">
                        <p class="text-warning">@error('image') {{ $message }} @enderror</p>
                    </div>
                    <button class="btn btn-dark" type="submit">
                        Update
                    </button>
                </form>
            </div>
            @php
                $photo = $currentUser->admin_avatar ?? 'user.svg';
            @endphp
            <div class="col-md-6">
                <a href="{{route('users')}}" class="btn btn-primary">Users</a>
                <a href="{{route('productAdmin')}}" class="btn btn-secondary">Products</a>
                <a href="{{route('ordersAdmin')}}" class="btn btn-dark">Orders</a>
            </div>
        </div>
    </section>

@endsection

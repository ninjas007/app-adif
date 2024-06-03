@extends('layouts.index')

@section('title', 'Profile')

@section('css')
<style>
    .avatar {
        margin-top: -40px;
        overflow: hidden;
    }

    .avatar img,
    .avatar {
        width: 80px;
        height: 80px;
    }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 p-5 mb-3">
                <form action="{{ route('account.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="avatar mx-auto mt-1">
                        <img src="{{ asset($user->avatar ?? 'img/avatar/avatar-1.png') }}" class="rounded-circle" alt="Photo profile"
                            style="border: .5px solid #e3e3e3; object-fit: cover;">
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Photo</label>
                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                        @error('photo')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                        @error('name')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                        @error('email')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Phone</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}">
                        @error('phone')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Gender</label>
                        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                            <option value="" selected disabled>Select Gender</option>
                            <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Birthday</label>
                        <input type="date" name="birthday" class="form-control @error('birthday') is-invalid @enderror" value="{{ old('birthday', \Carbon\Carbon::parse($user->birthday)->format('Y-m-d')) }}">
                        @error('birthday')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Address</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                    </div>

                    <div class="mb-1 text-dark" style="font-weight: bold">Change Password</div>
                    <hr>
                    @if (auth()->user()->password != 0)
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Current Password</label>
                            <div class="input-group">
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password">
                                <div class="input-group-prepend" onclick="showPassword('password')">
                                    <div class="input-group-text">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                </div>
                            </div>
                            @error('password')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endif

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">New Password</label>
                        <div class="input-group">
                            <input type="password" id="password2" class="form-control @error('password2') is-invalid @enderror" name="password2" placeholder="Enter password">
                            <div class="input-group-prepend" onclick="showPassword('password2')">
                                <div class="input-group-text">
                                    <i class="fas fa-eye"></i>
                                </div>
                            </div>
                        </div>
                        @error('password2')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-download"></i> Save Changes
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
    </script>
@endsection

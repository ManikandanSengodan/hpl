@extends('adminlte::page')

@section('title', 'Change Password')

@section('content_header')
    <h1>{{ __('Change Password') }}</h1>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                    <div class="offset-md-3 col-md-6">

                        @foreach (['danger', 'warning', 'success', 'info'] as $message)
                            @if(Session::has($message))
                                <div class="alert alert-{{ $message }}">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    {{ session($message) }}
                                </div>
                            @endif
                        @endforeach

                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Change Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('changePassword') }}" novalidate>
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="currentPassword">Current Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="currentPassword" name="old_password" placeholder="Current Password">
                                        @error('old_password')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="newPassword">New Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="newPassword" name="password" placeholder="New Password">
                                        @error('password')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmNewPassword">Confirm New Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmNewPassword" name="password_confirmation" placeholder="Confirm New Password">
                                        @error('password_confirmation')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
            </div>
        </div>
    </section>
@stop

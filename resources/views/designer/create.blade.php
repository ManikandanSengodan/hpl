@extends('adminlte::page')

@section('title', 'Create Designer')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Create Designer') }}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('designers.index') }}" class="btn bg-gradient-primary float-right">Back</a>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-1">

                    @foreach (['danger', 'warning', 'success', 'info'] as $message)
                        @if(Session::has($message))
                            <div class="alert alert-{{ $message }}">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ session($message) }}
                            </div>
                    @endif
                @endforeach

                <!-- general form elements -->
                    <div class="card card-primary" style="width: 850px;" >
                        <div class="card-header">
                            <h3 class="card-title">Create Designer</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('designers.store') }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="card-body row">
                                <div class="form-group col-6">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" placeholder="Name">
                                    @error('name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" placeholder="Email">
                                    @error('email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="role_id">Role</label>
                                    <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id">
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                   @endforeach
                                    </select>
                                
                                    @error('status')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="phone">Mobile No</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{old('phone')}}" placeholder="Mobile No">
                                    @error('phone')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                                    @error('password')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="text" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                    @error('password_confirmation')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-6">
                                    <label for="qualification">Qualification</label>
                                    <input type="text" class="form-control @error('qualification') is-invalid @enderror" id="qualification" value="{{old('qualification')}}" name="qualification" placeholder="Qualification">
                                    @error('qualification')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="b_group">Blood Group</label>
                                    <input type="text" class="form-control @error('b_group') is-invalid @enderror" id="b_group" value="{{old('blood_group')}}" name="blood_group" placeholder="Blood group">
                                    @error('b_group')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="documentID">Document ID</label>
                                    <input type="text" class="form-control @error('documentID') is-invalid @enderror" id="documentID" value="{{old('documentID')}}" name="documentID" placeholder="Document ID">
                                    @error('documentID')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="document_name">Document File</label>
                                    <input type="file" class="form-control @error('document_name') is-invalid @enderror" id="document_name" name="document_name" value="{{ old('document_name') }}">
                                    @error('document_name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="joined_on">Joined On</label>
                                    <input type="date" class="form-control @error('joined_on') is-invalid @enderror" id="joined_on" value="{{old('joined_on')}}" name="joined_on" placeholder="Joined On">
                                    @error('joined_on')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="left_on">Left On</label>
                                    <input type="date" class="form-control @error('left_on') is-invalid @enderror" id="left_on" value="{{old('left_on')}}" name="left_on" placeholder="Left On">
                                    @error('left_on')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('qualification') is-invalid @enderror" id="status" name="status">
                                    <option value=1>Active </option>
                                    <option value=0>InActive </option>
                                    </select>
                                
                                    @error('status')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="address">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{old('address')}}"></textarea>
                                    
                                    @error('address')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div>
    </section>
@stop

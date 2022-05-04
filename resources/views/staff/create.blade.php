@extends('adminlte::page')

@if($editStaff)
    @section('title', 'Edit Staff')
@else
    @section('title', 'Create Staff')
@endif

@section('content_header')
    <div class="row mb-1">
        <div class="offset-md-1 col-md-10">
            <h1 class="float-left ml-2 font-weight-bold">
                @if($editStaff)
                {{ __('Edit Staff - ') . ucwords($editStaff->name)}}
                @else
                {{ __('Create Staff') }}
                @endif
            </h1>
            <!-- <div class="float-right">
                <a href="" class="btn bg-gradient-danger btn-md mr-2">{{ __('Back') }}</a>
            </div> -->
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-1 col-md-10">
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
                            <h5 class="card-title font-weight-bold">{{ _('Staff Details') }}</h5>
                            @if($editStaff)
                                <button type="submit" onclick="submitForm()" class="btn bg-gradient-primary btn-md mr-2 float-right">{{'Update'}}</button>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- form start -->
                            <form method="POST" id="submit_form" action="{{ $editStaff ? route('staffs.update', $editStaff->id) : route('staffs.store')  }}" enctype="multipart/form-data" novalidate>
                                @csrf
                                @if($editStaff) @method('PUT') @endif
                                <div class="row justify-content-center">
                                    <div class="col-11">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="name">Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $editStaff ? old('name',$editStaff->name) : old('name') }}" placeholder="Name">
                                                @error('name')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="email">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $editStaff ? old('email',$editStaff->email) : old('email') }}" placeholder="Email">
                                                @error('email')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="phone">Mobile No<span class="text-danger">*</span></label>
                                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $editStaff ? old('phone',$editStaff->phone) : old('phone') }}" placeholder="Mobile No">
                                                @error('phone')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="qualification">Qualification </label>
                                                <input type="text" class="form-control @error('qualification') is-invalid @enderror" id="qualification" name="qualification" value="{{ $editStaff ? old('qualification',$editStaff->qualification) : old('qualification') }}" placeholder="Qualification">
                                                @error('qualification')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="role_id">Role <span class="text-danger">*</span></label>
                                                <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id">
                                                    <option value="">Select Role</option>
                                                    @foreach($roles as $role)
                                                        @if($editStaff)
                                                            <option value="{{$role->id}}" {{ old('role_id') == $role->id ? 'selected' : ($role->id == $editStaff->role_id ? 'selected' : '') }}>{{ucwords($role->name)}}</option>
                                                        @else
                                                            <option value="{{$role->id}}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ucwords($role->name)}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('role_id')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="b_group">Blood Group</label>
                                                <input type="text" class="form-control @error('b_group') is-invalid @enderror" id="b_group" name="blood_group" value="{{ $editStaff ? old('blood_group',$editStaff->blood_group) : old('blood_group') }}" placeholder="Blood group">
                                                @error('b_group')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="documentID">Document ID</label>
                                                <input type="text" class="form-control @error('documentID') is-invalid @enderror" id="documentID" name="documentID" value="{{ $editStaff ? old('documentID',$editStaff->documentID) : old('documentID') }}"  placeholder="Document ID">
                                                @error('documentID')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="document_name">Document File</label>
                                                <input type="file" style="height:1px" class="form-control @error('document_name') is-invalid @enderror" id="document_name" name="document_name">
                                                @error('document_name')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="joined_on">Joined On </label>
                                                <input type="date" class="form-control @error('joined_on') is-invalid @enderror" id="joined_on" name="joined_on" value="{{ $editStaff ? old('joined_on',$editStaff->joined_on) : old('joined_on') }}" placeholder="Joined On">
                                                @error('joined_on')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="left_on">Left On</label>
                                                <input type="date" class="form-control" id="left_on" name="left_on" value="{{ $editStaff ? old('left_on',$editStaff->left_on) : old('left_on') }}"placeholder="Left On">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" rows="2" id="address" name="address">{{ $editStaff ? old('address',$editStaff->address) : old('address') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="status">Status </label>
                                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                                    @if($editStaff)
                                                        <option value='1' {{ old('status') == '1' ? 'selected' : ($editStaff->status == '1' ? 'selected' : '') }}>Active </option>
                                                        <option value='0' {{ old('status') == '0' ? 'selected' : ($editStaff->status == '0' ? 'selected' : '') }}>InActive </option>
                                                    @else
                                                        <option value='1' {{ old('status') == "1" ? 'selected' : '' }}>Active </option>
                                                        <option value='0' {{ old('status') == "0" ? 'selected' : '' }}>InActive </option>
                                                    @endif
                                                </select>
                                                @error('status')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="password">Password @if(!$editStaff)<span class="text-danger">*</span>@endif</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                                                @error('password')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="password_confirmation">Confirm Password @if(!$editStaff)<span class="text-danger">*</span>@endif</label>
                                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                                @error('password_confirmation')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-12">
                                                <button type="submit" class="btn bg-gradient-primary btn-md mr-2 float-right">{{ $editStaff ? 'Update' : 'Save'}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

    <script>
        function submitForm() {
            $('#submit_form').submit();
        }
    </script>
@stop

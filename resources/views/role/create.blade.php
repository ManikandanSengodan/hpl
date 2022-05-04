@extends('adminlte::page')

@section('title', 'Role')

@section('content_header')
    <div class="row justify-content">
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-7">

                @include('shared.errors')

                <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $editRole ? __('Edit Role') : __('Create Role')  }}</h3>
                            @if($editRole)
                                <div class="float-right">
                                    <button class="btn btn-primary btn-md mr-2" onclick="submitForm()">Update</button>
                                    <a href="{{route('role.show', $editRole->id)}}" class="btn btn-primary btn-md float-right">{{ __('Cancel')}}</a>
                                </div>
                            @else
                                <a href="{{route('role.index')}}" class="btn btn-primary btn-md mr-2 float-right">{{ __('Cancel')}}</a>
                            @endif
                        </div>
                        <form method="POST" id="submit_form" action="{{ $editRole ? route('role.update', $editRole->id) : route('role.store') }}" novalidate>
                            @if($editRole) @method('PUT') @endif
                            @csrf

                            <div class="card-body row justify-content-center">
                                <div class="form-group col-6">
                                    <label for="role_name">Role Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="role_name" name="name" value="{{ $editRole ? old('name',$editRole->name) : old('name') }}" placeholder="Role Name">
                                    @error('name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary btn-md float-right">{{ $editRole ? __('Update') : __('Save')}}</button>
                            </div>
                        </form>
                    </div>
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


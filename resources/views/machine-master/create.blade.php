@extends('adminlte::page')

@if($editMachine)
    @section('title', 'Edit Machine Master')
@else
    @section('title', 'Create Machine Master')
@endif

@section('content_header')
    <div class="row justify-content">
        <div class="col-sm-7">
            <h1>{{ __('Machine Master') }}</h1>
        </div>
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
                            <h3 class="card-title">{{ $editMachine ? __('Edit Machine Master') : __('Create Machine Master')  }}</h3>
                            @if($editMachine)
                                <div class="float-right">
                                    <button class="btn btn-primary btn-md mr-2" onclick="submitForm()">Update</button>
                                    <a href="{{route('machine-master.show', $editMachine->id)}}" class="btn btn-primary btn-md float-right">{{ __('Cancel')}}</a>
                                </div>
                            @else
                                <a href="{{route('machine-master.index')}}" class="btn btn-primary btn-md float-right">{{ __('Cancel')}}</a>
                            @endif
                        </div>
                        <form method="POST" id="submit_form"
                              action="{{ $editMachine ? route('machine-master.update', $editMachine->id) : route('machine-master.store') }}"
                              novalidate>
                            @if($editMachine) @method('PUT') @endif
                            @csrf
                            <div class="card-body row">
                                <div class="form-group col-12">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name"
                                           value="{{ $editMachine ? old('name',$editMachine->name) : old('name') }}"
                                           placeholder="name">
                                    @error('name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="colour">Colour <span class="text-danger">*</span></label>
                                    <input type="color" class="form-control @error('colour') is-invalid @enderror" id="colour" name="colour" value="{{ $editMachine ? old('colour',$editMachine->colour) : old('colour') }}" placeholder="colour">
                                    @error('colour')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="role_name">Operator Designated <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('operator_designated') is-invalid @enderror"
                                           id="operator_designated" name="operator_designated"
                                           value="{{ $editMachine ? old('operator_designated',$editMachine->operator_designated) : old('operator_designated') }}"
                                           placeholder="Operator Designated">
                                    @error('operator_designated')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-center">
                                <button type="submit"
                                        class="btn btn-primary btn-md float-right">{{ $editMachine ? __('Update') : __('Save')}}</button>
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


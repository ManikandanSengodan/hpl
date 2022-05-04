@extends('adminlte::page')

@if($editCutFoldMachine)
    @section('title', 'Edit Cut Fold Machine')
@else
    @section('title', 'Create Cut Fold Machine')
@endif

@section('content_header')
    <div class="row justify-content">
        <div class="col-sm-7">
            <h1>{{ __('Cut Fold Machine') }}</h1>
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
                            <h3 class="card-title">{{ $editCutFoldMachine ? __('Edit Cut Fold Machine') : __('Create Cut Fold Machine')  }}</h3>
                            @if($editCutFoldMachine)
                                <div class="float-right">
                                    <button class="btn btn-primary btn-md mr-2" onclick="submitForm()">Update</button>
                                    <a href="{{route('cut-fold-machine.show', $editCutFoldMachine->id)}}" class="btn btn-primary btn-md float-right">{{ __('Cancel')}}</a>
                                </div>
                            @else
                                <a href="{{route('cut-fold-machine.index')}}" class="btn btn-primary btn-md float-right">{{ __('Cancel')}}</a>
                            @endif
                        </div>
                        <form method="POST" id="submit_form"
                              action="{{ $editCutFoldMachine ? route('cut-fold-machine.update', $editCutFoldMachine->id) : route('cut-fold-machine.store') }}"
                              novalidate>
                            @if($editCutFoldMachine) @method('PUT') @endif
                            @csrf
                            <div class="card-body row">
                                <div class="form-group col-12">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name"
                                           value="{{ $editCutFoldMachine ? old('name',$editCutFoldMachine->name) : old('name') }}"
                                           placeholder="name">
                                    @error('name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="fold">Fold <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('fold') is-invalid @enderror"
                                           id="fold" name="fold"
                                           value="{{ $editCutFoldMachine ? old('fold',$editCutFoldMachine->fold) : old('fold') }}"
                                           placeholder="fold">
                                    @error('fold')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="role_name">Operator Designated <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('operator_designated') is-invalid @enderror"
                                           id="operator_designated" name="operator_designated"
                                           value="{{ $editCutFoldMachine ? old('operator_designated',$editCutFoldMachine->operator_designated) : old('operator_designated') }}"
                                           placeholder="Operator Designated">
                                    @error('operator_designated')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-center">
                                <button type="submit"
                                        class="btn btn-primary btn-md float-right">{{ $editCutFoldMachine ? __('Update') : __('Save')}}</button>
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


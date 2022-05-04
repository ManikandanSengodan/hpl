@extends('adminlte::page')

@if($editSize)
    @section('title', 'Edit Size')
@else
    @section('title', 'Create Size')
@endif

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
                            <h3 class="card-title">{{ $editSize ? __('Edit Size') : __('Create Size')  }}</h3>
                            <div class="float-right">
                                @if($editSize)
                                    <button class="btn bg-gradient-primary btn-md mr-2" onclick="submitForm()">Update</button>
                                    <a href="{{ route('size-master-mm.show',$editSize->id) }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Cancel') }}</a>
                                @else
                                    <a href="{{ route('size-master-mm.index') }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Cancel') }}</a>
                                @endif
                            </div>
                        </div>
                        <form method="POST" id="submit_form" action="{{ $editSize ? route('size-master-mm.update', $editSize->id) : route('size-master-mm.store') }}" novalidate>
                            @if($editSize) @method('PUT') @endif
                            @csrf
                                <div class="card-body row justify-content-center">

                                    <div class="col-md-6" style="">
                                        <div class="form-group">
                                            <label for="status">Measurement <span class="text-danger">*</span></label>
                                            <select class="form-control @error('measurement') is-invalid @enderror"
                                                    id="measurement" name="measurement">
                                                <option disabled selected>Select Measurement</option>
                                                <option value="MM" @if($editSize && $editSize->measurement == 'MM') selected @endif>MM</option>
                                                <option value="Inch" @if($editSize && $editSize->measurement == 'Inch') selected @endif>Inch</option>
                                            </select>
                                            @error('measurement')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="role_name">Size <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('size') is-invalid @enderror"
                                                   id="size" name="size"
                                                   value="{{ $editSize ? old('size',$editSize->size) : old('size') }}"
                                                   placeholder="size" required>
                                            @error('size')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary btn-md float-right">{{ $editSize ? __('Update') : __('Save')}}</button>
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


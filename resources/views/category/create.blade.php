@extends('adminlte::page')

@if($editCategory)
    @section('title', 'Edit Category')
@else
    @section('title', 'Create Category')
@endif

@section('content_header')
    <div class="row justify-content-center">
        <div class="col-sm-7">
            <h1>{{ __('Category') }}</h1>
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
                            <h3 class="card-title">{{ $editCategory ? __('Edit Category') : __('Create Category')  }}</h3>


                            @if($editCategory)
                                <div class="float-right">
                                    <button class="btn btn-primary btn-md mr-2" onclick="submitForm()">Update</button>
                                    <a href="{{route('category.show', $editCategory->id)}}" class="btn btn-primary btn-md float-right">{{ __('Cancel')}}</a>
                                </div>
                            @else
                                <a href="{{route('category.index')}}" class="btn btn-primary btn-md float-right">{{ __('Cancel')}}</a>
                            @endif
                        </div>
                        <form method="POST" id="submit_form" action="{{ $editCategory ? route('category.update', $editCategory->id) : route('category.store') }}" novalidate>
                            @if($editCategory) @method('PUT') @endif
                            @csrf
                            <div class="card-body row justify-content-center">
                                <div class="form-group col-6">
                                    <label for="category_name">Category Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" value="{{ $editCategory ? old('category_name',$editCategory->category_name) : old('category_name') }}" placeholder="Category Name">
                                    @error('category_name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary btn-md float-right">{{ $editCategory ? __('Update') : __('Save')}}</button>
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


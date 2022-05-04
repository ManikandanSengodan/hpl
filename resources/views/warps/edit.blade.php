@extends('adminlte::page')

@section('title', 'Edit warp')

@section('content_header')
    <div class="row mb-0">
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
                    <div class="card card-primary" style="width: 850px;">
                        <div class="card-header">
                            <h3 class="card-title">Edit Warp</h3>
                            <div class="float-right">
                                    <button type="submit" onclick="submitForm()" class="btn btn-primary">Update</button>
                                    <a href="{{ route('warps.show', $warp->id) }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Cancel') }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" id="submit_form" action="{{ route('warps.update', $warp->id) }}" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="card-body row justify-content-center">

                            <div class="col-md-6" style=""> 

                            <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$warp->name}}" placeholder="Name">
                                    @error('name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="colour">Colour <span class="text-danger">*</span></label>
                                    <input type="color" class="form-control @error('colour') is-invalid @enderror" id="colour" name="colour" value="{{$warp->colour}}" placeholder="colour">
                                    @error('colour')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" value="{{$warp->notes}}">{{$warp->notes}}</textarea>
                                    @error('notes')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                </div>
                                
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Update</button>
                            </div>
                        </form>
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

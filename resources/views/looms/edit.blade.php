@extends('adminlte::page')

@section('title', 'Edit Loom')

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
                            <h3 class="card-title">Edit Loom</h3>
                            <div class="float-right">
                                <button type="submit" onclick="submitForm()" class="btn btn-primary">Update</button>
                                <a href="{{ route('looms.show', $loom->id) }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Cancel') }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" id="submit_form" action="{{ route('looms.update', $loom->id) }}" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="card-body row">

                            
                            <div class="form-group col-6">
                                    <label for="loom_name">Loom Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('loom_name') is-invalid @enderror" id="loom_name" name="loom_name" value="{{$loom->loom_name}}" placeholder="Loom Name">
                                    @error('loom_name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="weaving_width_Meter">Weaving <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('weaving_width_Meter') is-invalid @enderror" id="weaving_width_Meter" name="weaving_width_Meter" value="{{$loom->weaving_width_Meter}}" placeholder="Weaving width Meter">
                                    @error('weaving_width_Meter')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="sections">Sections <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('sections') is-invalid @enderror" id="sections" name="sections" value="{{$loom->sections}}" placeholder="Sections">
                                    @error('sections')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-6">
                                    <label for="speed">Speed <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('speed') is-invalid @enderror" id="speed" name="speed" value="{{$loom->speed}}" placeholder="speed">
                                    @error('speed')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="year">Year <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{$loom->year}}" placeholder="Year">
                                    @error('year')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-6">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" value="{{$loom->notes}}">{{$loom->notes}}</textarea>
                                    
                                    @error('notes')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
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

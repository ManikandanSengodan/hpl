@extends('adminlte::page')

@section('title', 'yarn')

@section('content_header')
    <!-- <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('yarn - ') . $yarn->yarn_name}}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('yarns.index') }}" class="btn bg-gradient-primary float-right">Back</a>
        </div>
    </div> -->
    <div class="row mb-1">
        <div class="offset-md-3 col-md-6">
            <h1 class="float-left ml-2 font-weight-bold">
               {{ __('Yarn - ') . ucwords($yarn->supplier)}}
            </h1>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Yarn</h3>
                            <div class="float-right">
                                <a href="{{ route('yarns.edit',$yarn->id) }}" class="btn bg-gradient-warning btn-md mr-2">{{ __('Edit') }}</a>
                                <form method="POST" action="{{ route('yarns.destroy', $yarn->id) }}"
                                      accept-charset="UTF-8"
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Are you sure do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn bg-gradient-danger btn-md mr-2" type="submit" value="Delete">
                                </form>
                                <a href="{{ route('yarns.index') }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Back') }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                    <tr>
                                        <td><strong>{{ __('Supplier Name') }}</strong></td>
                                        <td>{{ $yarn->supplier }}</td>

                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Yarn Denier') }}</strong></td>
                                        <td>{{ $yarn->yarn_denier }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td><strong>{{ __('Shade No') }}</strong></td>
                                        <td>{{ $yarn->shade_No }}{{ $yarn->shade_No_suffix }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td><strong>{{ __('Yarn Color') }}</strong></td>
                                        
                                        <td>{{ $yarn->color_shade }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Color Shade') }}</strong></td>
                                        <td style="background-color: {{ $yarn->yarn_color }};"></td>
{{--                                        <td style="background-color: {{ $yarn->color_shade }};"></td>--}}
                                    </tr>
                                    
                                    <tr>
                                        <td><strong>{{ __('Notes') }}</strong></td>
                                        <td>{{ $yarn->notes }}</td>
                                    </tr>
                                   
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@stop

@extends('adminlte::page')

@section('title', 'warp')

@section('content_header')
    <div class="row mb-0">
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">warp</h3>
                            <div class="float-right">
                                <a href="{{ route('warps.edit', $warp->id) }}" class="btn bg-gradient-warning btn-md mr-2">{{ __('Edit') }}</a>
                                <form method="POST" action="{{ route('warps.destroy', $warp->id) }}"
                                      accept-charset="UTF-8"
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Are you sure do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn bg-gradient-danger btn-md mr-2" type="submit" value="Delete">
                                </form>
                                <a href="{{ route('warps.index') }}" class="btn bg-gradient-primary btn-md mr-2 float-right">{{ __('Back') }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                    <tr>
                                        <td><strong>{{ __('Name') }}</strong></td>
                                        <td>{{ $warp->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Colour') }}</strong></td>
                                        <td style="background-color: {{ $warp->colour }};"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Notes') }}</strong></td>
                                        <td>{{ $warp->notes }}</td>
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

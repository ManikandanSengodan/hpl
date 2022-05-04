@extends('adminlte::page')

@section('title', 'loom')

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
                            <h3 class="card-title">loom</h3>
                            <div class="float-right">
                                <a href="{{ route('looms.edit', $loom->id) }}" class="btn bg-gradient-warning btn-md mr-2">{{ __('Edit') }}</a>
                                <form method="POST" action="{{ route('looms.destroy', $loom->id) }}"
                                      accept-charset="UTF-8"
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Are you sure do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn bg-gradient-danger btn-md mr-2" type="submit" value="Delete">
                                </form>
                                <a href="{{ route('looms.index') }}" class="btn bg-gradient-primary btn-md mr-2 float-right">{{ __('Back') }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                    <tr>
                                        <td><strong>{{ __('Loom Name') }}</strong></td>
                                        <td>{{ $loom->loom_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Weaving') }}</strong></td>
                                        <td>{{ $loom->weaving_width_Meter }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td><strong>{{ __('Sections') }}</strong></td>
                                        <td>{{ $loom->sections }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td><strong>{{ __('Speed') }}</strong></td>
                                        
                                    <td>{{ $loom->speed }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Year') }}</strong></td>
                                        <td>{{ $loom->year }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td><strong>{{ __('Notes') }}</strong></td>
                                        <td>{{ $loom->notes }}</td>
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

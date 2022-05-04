@extends('adminlte::page')

@section('title', 'FinishingMachine')

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
                            <h3 class="card-title">FinishingMachine</h3>
                            <div class="float-right">
                                <a href="{{ route('finishingmachines.edit', $finishingmachine->id) }}" class="btn bg-gradient-warning btn-md mr-2">{{ __('Edit') }}</a>
                                <form method="POST" action="{{ route('finishingmachines.destroy', $finishingmachine->id) }}"
                                      accept-charset="UTF-8"
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Are you sure do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn bg-gradient-danger btn-md mr-2" type="submit" value="Delete">
                                </form>
                                <a href="{{ route('finishingmachines.index') }}" class="btn bg-gradient-primary btn-md mr-2 float-right">{{ __('Back') }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                    <tr>
                                        <td><strong>{{ __('Machine Name') }}</strong></td>
                                        <td>{{ $finishingmachine->machine }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Folds Available') }}</strong></td>
                                        <td>{{ $finishingmachine->folds_available }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('End fold size') }}</strong></td>
                                        <td>{{ $finishingmachine->min_end_fold }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Max visible length') }}</strong></td>
                                        <td>{{ $finishingmachine->max_length_mm }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td><strong>{{ __('Speed') }}</strong></td>
                                        
                                    <td>{{ $finishingmachine->speed }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Year') }}</strong></td>
                                        <td>{{ $finishingmachine->year }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Serial Nos') }}</strong></td>
                                        <td>{{ $finishingmachine->serial_Nos }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Notes') }}</strong></td>
                                        <td>{{ $finishingmachine->notes ?? '-'}}</td>
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

@extends('adminlte::page')

@section('title', 'Cut Fold Machine')

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
                            <h3 class="card-title">Cut Fold Machine</h3>
                            <div class="float-right">
                                <a href="{{ route('cut-fold-machine.edit', $cutFold->id) }}" class="btn bg-gradient-warning btn-md mr-2">{{ __('Edit') }}</a>
                                <form method="POST" action="{{ route('cut-fold-machine.destroy', $cutFold->id) }}"
                                      accept-charset="UTF-8"
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Are you sure do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn bg-gradient-danger btn-md mr-2" type="submit" value="Delete">
                                </form>
                                <a href="{{ route('cut-fold-machine.index') }}" class="btn bg-gradient-primary btn-md mr-2 float-right">{{ __('Back') }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                    <tr>
                                        <td><strong>{{ __('Name') }}</strong></td>
                                        <td>{{ $cutFold->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Fold') }}</strong></td>
                                        <td>{{ $cutFold->fold }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Operator Designated') }}</strong></td>
                                        <td>{{ $cutFold->operator_designated }}</td>
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

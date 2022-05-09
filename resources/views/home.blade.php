@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('Dashboard') }}</h1>
@stop

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                 
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <a href="{{ route('customer.index') }}">
                    <div class="small-box bg-gradient-green">
                        <div class="inner">
                            <h3>{{ $customer_count ?? 0 }}</h3>

                            <p>{{ __('Customers') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@stop

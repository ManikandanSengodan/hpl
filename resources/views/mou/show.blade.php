@extends('adminlte::page')

@section('title', 'mou')

@section('content_header')
    <div class="row mb-1">
        <div class="offset-md-1 col-md-10">
            <h1 class="font-weight-bold float-left">
                {{ __('mou - ') . ucwords($mou->name)}}
            </h1>

        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="offset-md-1 col-md-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">MOU Details</h3>
                            <div class="float-right">
                                <a href="{{ route('mous.edit',$mou->id) }}" class="btn bg-gradient-warning mr-2">{{ __('Edit') }}</a>
                                <form method="POST" action="{{ route('mous.destroy', $mou->id) }}"
                                      accept-charset="UTF-8"
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Are you sure do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn bg-gradient-danger mr-2" type="submit" value="Delete">
                                </form>
                                <a href="{{ route('mous.index') }}" class="btn bg-gradient-primary mr-2">{{ __('Back') }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <tbody> 
                                <tr>
                                        <td><strong>{{ __('Code') }}</strong></td>
                                        <td>{{ $mou->mou_code }}</td>
                                    </tr>
                                <tr>
                                        <td><strong>{{ __('RO') }}</strong></td>
                                        <td>{{ ucwords($mou->region) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('ship to party code') }}</strong></td>
                                        <td>{{ ucwords($mou->ship_to_party_code) }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Customer') }}</strong></td>
                                        <td>{{ $mou->mouDetails->full_name }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Group Company') }}</strong></td>
                                        <td>{{ $mou->group_company }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Price Point') }}</strong></td>
                                        <td>{{ ucwords($mou->price_point) }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Major Grade') }}</strong></td>
                                        <td>{{ $mou->major_grade }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('CSS Period') }}</strong></td>
                                        <td>{{ $mou->css_period }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Type') }}</strong></td>
                                        <td>{{ $mou->mou_type }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Monthly Target') }}</strong></td>
                                        <td>{{ $mou->monthly_target }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Quarterly Target') }}</strong></td>
                                        <td>{{ $mou->quarterly_target }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Annual Target') }}</strong></td>
                                        <td>{{ $mou->annual_target }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Monthly Rate') }} INR</strong></td>
                                        <td>{{ $mou->monthly_rate }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Quarterly Rate') }} INR</strong></td>
                                        <td>{{ $mou->quarterly_rate }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Annual Rate') }} INR</strong></td>
                                        <td>{{ $mou->annual_rate }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('From Date') }}</strong></td>
                                        <td>{{ $mou->from_date }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('To date') }}</strong></td>
                                        <td>{{ $mou->to_date ?? '-' }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Address') }}</strong></td>
                                        <td>{{ $mou->address ?? '-' }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Status') }}</strong></td>
                                        <td>{{ $mou->status == 1 ? 'Active' : 'Inactive' }}</td>
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

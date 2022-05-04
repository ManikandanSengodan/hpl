@extends('adminlte::page')

@section('title', 'Admin Detail')

@section('content_header')
    <div class="row mb-1">
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-1 col-md-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Admin Detail</h3>
                            <div class="float-right">
                                <a href="{{ route('users.edit',$user->id) }}" class="btn bg-gradient-warning btn-md mr-2">{{ __('Edit') }}</a>
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                      accept-charset="UTF-8"
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Are you sure do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                        <input class="btn bg-gradient-danger btn-md mr-2" type="submit" value="Delete">
                                </form>
                                <a href="{{ route('users.index') }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Back') }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                
                                    <tr>
                                        <td><strong>{{ __('Name') }}</strong></td>
                                        <td>{{ ucfirst($user->name) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Email') }}</strong></td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td><strong>{{ __('Mobile No') }}</strong></td>
                                        <td>{{ $user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Qualification') }}</strong></td>
                                        <td>{{ ucwords($user->qualification) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Blood Group') }}</strong></td>
                                        <td>{{ $user->blood_group }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Status') }}</strong></td>
                                        <td>{{ $user->status }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Flat No') }}</strong></td>
                                        <td>{{ $address->flatno }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Apartment') }}</strong></td>
                                        <td>{{ $address->apartment }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Landmark') }}</strong></td>
                                        <td>{{ $address->landmark }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Area') }}</strong></td>
                                        <td>{{ $address->area }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('City') }}</strong></td>
                                        <td>{{ $address->city }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('State') }}</strong></td>
                                        <td>{{ $address->state }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Country') }}</strong></td>
                                        <td>{{ $address->country }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Zipcode') }}</strong></td>
                                        <td>{{ $address->zipcode }}</td>
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

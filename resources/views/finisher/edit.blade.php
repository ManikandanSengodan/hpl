@extends('adminlte::page')

@section('title', 'Edit Finisher')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Edit Finisher - ') . $finisher->name }}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('finishers.index') }}" class="btn bg-gradient-primary float-right">Back</a>
        </div>
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
                            <h3 class="card-title">Edit Finisher</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('finishers.update', $finisher->id) }}" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="card-body row">

                               <div class="col-md-6" style=""> 
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$finisher->name}}" placeholder="Name">
                                    @error('name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{$finisher->email}}" placeholder="Email">
                                    @error('email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                                    @error('password')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="text" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                    @error('password_confirmation')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Mobile No</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{$finisher->phone}}" placeholder="Mobile No">
                                    @error('phone')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="qualification">Qualification</label>
                                    <input type="text" class="form-control @error('qualification') is-invalid @enderror" id="qualification" value="{{$finisher->qualification}}" name="qualification" placeholder="Qualification">
                                    @error('qualification')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="b_group">Blood Group</label>
                                    <input type="text" class="form-control @error('b_group') is-invalid @enderror" id="b_group" value="{{$finisher->blood_group}}" name="blood_group" placeholder="Blood group">
                                    @error('b_group')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="1">Active </option>
                                    <option value="0">InActive </option>
                                    </select>
                                
                                    @error('status')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                </div>
                                <div class="col-md-6" style=""> 
                                <div class="form-group">
                                    <label for="flatno">flat No</label>
                                    <input type="text" class="form-control @error('flatno') is-invalid @enderror" id="flatno" value="{{$address->flatno}}" name="flatno" placeholder="Flatno">
                                    @error('flatno')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="apartment">Apartment</label>
                                    <input type="text" class="form-control @error('apartment') is-invalid @enderror" id="apartment" value="{{$address->apartment}}" name="apartment" placeholder="Apartment">
                                    @error('apartment')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="landmark">Landmark</label>
                                    <input type="text" class="form-control @error('landmark') is-invalid @enderror" id="landmark" value="{{$address->landmark}}" name="landmark" placeholder="Landmark">
                                    @error('landmark')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="area">Area</label>
                                    <input type="text" class="form-control @error('area') is-invalid @enderror" id="area" value="{{$address->area}}" name="area" placeholder="Area">
                                    @error('area')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" value="{{$address->city}}" name="city" placeholder="City">
                                    @error('city')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" value="{{$address->state}}" name="state" placeholder="State">
                                    @error('state')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" value="{{$address->country}}" name="country" placeholder="Country">
                                    @error('country')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="zipcode">Zipcode</label>
                                    <input type="text" class="form-control @error('zipcode') is-invalid @enderror" id="zipcode" value="{{$address->zipcode}}" name="zipcode" placeholder="zipcode">
                                    @error('zipcode')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div>
    </section>
@stop

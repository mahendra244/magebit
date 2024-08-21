@extends('User.layouts.main')
@section('content')
<div class="row m-t-70 admin-home  p-l-r-0">
    <div class="col-md-12 col-sm-12 col-xs-12 p-l-r-0">
        <div class="container">
            @if(session()->has('message'))
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 p-l-r-0">
                    <div class="alert alert-success alert-dismissible successMessage"  style="padding-top: 10px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        {{ session()->get('message')}}
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 text-center form-password">
                    <h2>Change Password</h2>
                    <form method="POST" action="{{ url('user/change-password') }}" name="changeform" class="m-t-40">
                        @csrf
                        <div class="row m-l-r-0 form-group">
                            <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password" placeholder="New Password *">
                            @error('new_password')
                            <div class="error text-left"><strong>{{ $message }}</strong></div>
                            @enderror                 
                        </div>
                        <div class="row m-l-r-0 form-group">
                            <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password" placeholder="Repeat Password *">
                            @error('new_confirm_password')
                            <div class="error text-left"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>
                        <div class="row m-l-r-0  m-t-30 m-b-10">
                            <button type="submit" id="changesubmit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>SAP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> -->
        <link rel="shortcut icon" href="https://www.sapdiscover.com/images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="{{ URL::asset('/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('/assets/css/fonts.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('/assets/css/registration.css') }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ URL::asset('/assets/css/intlTelInput.css') }}">
    </head>
    <body class="reg">
        <nav class="navbar navbar-expand-md main_nav">
            <div class="container p-l-r-0 rel" style="position: relative;">
                <div class="navbar-header">
                    <div class="navbar-brand logo-group">
                        <a class="sap-logo" href="#">
                            <img src="{{ URL::asset('/assets/images/sap-logo.png')}}" alt="SAP Logo">
                        </a>
                    </div>

                    <button type="button" class="navbar-toggle mob_navbar_toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                    </button>
                </div>
                
            </div>
        </nav>
        <div class="" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12 p-l-r-0">
                        <form class="form-login"  method="post" action="{{ url('login') }}">
                        @csrf
                            <h2 class="form-login-heading" style="text-transform:none !important"> Log In</h2>

                            <div class="card-body">
                                @if(Session::has('error'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('error') }}
                                        @php
                                            Session::forget('error');
                                        @endphp
                                    </div>
                                @endif

                                <div class="login-wrap">
                                    <div class="form-group has-feedback ">
                                        <input type="text" class="form-control" placeholder="Email ID *" name="email" value="{{ old('email') }}">
                                        {!! $errors->first('email', '<small class="text-danger">:message</small>') !!}

                                    </div>
                                    <div class="form-group has-feedback ">
                                        <input type="password" class="form-control" placeholder="Password *" name="password" value="{{ old('password') }}">
                                        {!! $errors->first('password', '<small class="text-danger">:message</small>') !!}

                                    </div>
                                    <button  class="btn btn-primary btn-theme btn-block" type="submit" >Login</button>
                                    <hr>
                                    <div class="form-group has-feedback text-center">
                                    <p class="float-right mt-2"> Don't have an account?  <a href="{{ url('user-registration')}}" class="text-success"> Register </a> </p> &nbsp;&nbsp;
                                    
                                    </div>
                                    
                        
                                </div>
                            </div>
                            
                        </form>

                    </div>
                </div>
            </div>
        </div> 
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="{{ URL::asset('/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/intlTelInput.js') }}"></script>
    </body>
</html>

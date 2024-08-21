<nav class="navbar navbar-default navbar-fixed-top nav-career-employee" style="top: 60px;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      {{-- <a class="navbar-brand" href="#">Brand</a> --}}
    </div>

       
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     <ul class="nav navbar-nav navbar-left">
     <li class="{{ Route::currentRouteName() == 'user.dashboard' ? 'active' : '' }}"><a href="{{ Route('user.dashboard') }}">Home</a></li>
    <li class="{{ Route::currentRouteName() == 'user.employee-data-import' ? 'active' : '' }}"><a href="{{ Route('user.employee-data-import') }}">Employee Import</a></li>
    <li class="{{ Route::currentRouteName() == 'user.company-data-import' ? 'active' : '' }}"><a href="{{ Route('user.company-data-import') }}">Company Import</a></li>
    <li class="{{ Route::currentRouteName() == 'user.updated-list' ? 'active' : '' }}"><a href="{{Route('user.updated-list')}}">Import Company Data</a></li>
    <li class="{{ Route::currentRouteName() == 'user.sendgrid-data-import' ? 'active' : '' }}"><a href="{{Route('user.sendgrid-data-import')}}">Import Sendgrid Data</a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
            <span class="caret"></span>  {{ Auth::user()->name }}
          </a>
          	<ul class="dropdown-menu">
	            <li>
                <a class="" href="{{url('user/change-password')}}">Change Password</a>
                <a class="logout" href="{{url('user/logout')}}">Logout</a>
	            </li>
        	</ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
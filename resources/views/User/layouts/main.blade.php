<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="robots" content="NOINDEX, NOFOLLOW"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="SAP">
    <meta name="keyword" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GMF Sendgrid</title>
    @php
      $browser = $_SERVER['HTTP_USER_AGENT'];
      $pos = strpos($browser, "Trident/");
      if($pos)
      {
        $path=env('IE_PATH');
        echo '<script type="text/javascript">window.location="'.$path.'"</script>';
      }
    @endphp
    <link rel="icon" type="image/vnd.microsoft.icon" href="{{asset('assets/images/dashboard/favicon.ico')}}"/>
    <link href="{{asset('assets/css/dashboard/bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link href="{{asset('assets/css/dashboard/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/lineicons/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/dashboard/custom.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/dashboard/common.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/dashboard/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/dashboard/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/dashboard/common.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/dashboard/bootstrap-tour.css')}}">
    <!-- js placed at the end of the document so the pages load faster -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <style>
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ebebeb;
        z-index: 99;
    }
    #status {
        width: 200px;
        height: 200px;
        position: absolute;
        left: 50%;
        /* centers the loading animation horizontally one the screen */
        top: 50%;
        /* centers the loading animation vertically one the screen */
        background-image: url(https://raw.githubusercontent.com/niklausgerber/PreLoadMe/master/img/status.gif);
        /* path to your loading animation */
        background-repeat: no-repeat;
        background-position: center;
        margin: -100px 0 0 -100px;
        /* is width and height divided by two */
    }
    .pagination {
    margin: 0 0 10px 0  !important;
    }
    .p-d-l-0{
    padding-left:0px;
    }
    </style>
     @stack('style')
  </head>
  <body class="admin-body">
      <div id="preloader">
          <div id="status">&nbsp;</div>
        </div>
    @include('User.layouts.header');
    <div class="clearfix" style="margin-top:62px"></div>
        @include('User.layouts.nav_bar')
      <div class="container-fluid " style="min-height:530px">
          @if(session('status'))
                <input type="hidden" class="notify" value="{{session('status')}}" >
          @endif
          @yield('content')
          @stack('modal')
      </div>
      @include('User.layouts.footer')
   </body>
      <script src="{{asset('assets/js/dashboard/jquery-2.1.3.min.js')}}"></script>
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>

      <script src="{{asset('assets/js/dashboard/bootstrap.min.js')}}"></script>
      <script src="{{asset('assets/js/dashboard/jquery.dcjqaccordion.2.7.js')}}"></script>
      <script src="{{asset('assets/js/dashboard/jquery.scrollTo.min.js')}}"></script>
      <script src="{{asset('assets/js/dashboard/jquery.nicescroll.js')}}"></script>
      <script src="{{asset('assets/js/dashboard/gritter/js/jquery.gritter.js')}}"></script>
      <script src="{{asset('assets/js/dashboard/gritter-conf.js')}}"></script>
      <script src="{{asset('assets/js/dashboard/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
      <script src="{{asset('assets/js/dashboard/owl.carousel.min.js')}}"></script>

     <script src="{{asset('assets/js/dashboard/bootstrap-tour.js')}}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.proto.js"></script>
  
    <!--script for this page-->
       <script>
      var notifyt=$('.notify').val();
      if(notifyt)
      {
        notifyt=$.parseJSON(notifyt);
        shownot(notifyt);
      }
      function shownot(notifyt)
      {
        $('#preloader').fadeOut('slow');
        $.notify({
          message: notifyt.Message,
          },{
            // settings
            delay:0,
            type: notifyt.type,
            allow_dismiss: true,
            showProgressbar: false,
            placement: {
            from: "top",
            align: "center"
          },
          animate: {
            enter: 'animated fadeInRight',
            exit: 'animated fadeOutRight'
          },
          });
        setTimeout(function() {
        $.notifyClose();
        }, 2000);
      }
      $(document).ready(function(){
      // makes sure the whole site is loaded 
      // $('#status').fadeOut(); // will first fade out the loading animation 
      $('#preloader').delay(1000).fadeOut('slow'); // will fade out the white DIV that covers the website. 
      // $('body').delay(350).css({'overflow':'visible'});
      });
      $(document).ready(function() {
          $(".se-pre-con").fadeOut("slow");
          // $('html,body').on("contextmenu",function(e){
          //    return false;
          // }); 
      });
      </script>
  @stack('script')
</html>
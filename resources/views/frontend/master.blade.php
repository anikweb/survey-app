<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Social Test Data offers various social tests, polls, quizes and surveys to find out social tendencies all over the world. "/>
	<meta name="author" content="Social Test Data, www.socialtestdata.com">
    @yield('meta_tag')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/ionicons.min.css') }}"> --}}
    @yield('internal_css')
    <title>Social Test Data</title>
  </head>
  <body>
    <header style="background: #4169E1">
        <div class="container">
            <nav class="navbar navbar-expand-lg" style="background: #4169E1">
                <a class="navbar-brand text-white" href="{{ route('frontend') }}"><h3>Social Test Data</h3></a>
                <button class="navbar-dark navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon text-white"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto ">
                    <li class="nav-item active">
                        <a class="nav-link" style="color: #FFDEAD" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFDEAD" href="#">Usage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFDEAD" href="#">Quality</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FFDEAD" href="#">Contact</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li> --}}
                    </ul>
                </div>
                </nav>
        </div>
    </header>
    @yield('content')
     <!-- Footer -->
     <footer class="py-3" style="background: #4169E1">
        <div class="container">
          <p class="m-0 text-center text-white">Social Test Data &copy;www.socialtestdata.com 2022. All rights reserved. &#124; <a href="terms-conditions-of-use.html">Terms and Conditions of Use</a>  &#124; <a href="privacy-policy.html">Privacy Policy</a> &#124;</p> </p>
        </div>
        <!-- /.container -->
      </footer>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="//cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="//cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/share.js') }}"></script>
    @yield('footer_js')
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
  </body>
</html>

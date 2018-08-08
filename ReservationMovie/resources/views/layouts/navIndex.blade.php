<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> <?php echo $title; ?> </title>
    <!-- Styles -->
    <!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('styles.css')}}">
    <!-- Style Alphabet Fiter -->
    <link rel="stylesheet" href="{{asset('cssList/listnav.css')}}">
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <script src="{{ asset('jquery-3.2.1.min.js') }}"> </script>
    <script src="{{ asset('jquery.autocomplete.js') }}"></script>
    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">    




    <style>
        .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
        .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
        .autocomplete-selected { background: #F0F0F0; }
        .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
        .autocomplete-group { padding: 2px 5px; }
        .autocomplete-group strong { display: block; border-bottom: 1px solid #000; } 
    </style>

</head>
<!-- Real-Time -->
@yield('Real-Time')
<body onload="{{ $RealTime }}">
    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: green; width: 100%;">
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation"> -->
        <!-- <span class="navbar-toggler-icon"></span> -->
        <!-- </button> -->
        <!-- <div class="collapse navbar-collapse" id="navbarTogglerDemo01"> -->
        <i><img src="{{asset('ic_view_list_white_48dp_1x.png')}}" alt="ic_view_list_white_48dp_1x" width="35px" id="SideBar_a"></i>
        <a class="navbar-brand text-Left" href="{{ url('/') }}"> KU-MOVIE</a>
        <!-- <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active"> -->
            <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
            <!-- </li>
            <li class="nav-item"> -->
            <!-- <a class="nav-link" href="#">Link</a> -->
            <!-- </li>
            <li class="nav-item"> -->
            <!-- <a class="nav-link disabled" href="#">Disabled</a> -->
            <!-- </li>
        </ul> -->


        <!-- <form class="form-inline my-2 my-lg-0"> -->
            <!-- <input type="text" class="form-control typeahead" placeholder="ค้นหาหนัง" name="search" id="autocomplete" style="width: 300px;"/> -->
            <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
        <!-- </form> -->
        </div>
    </nav>


                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->

                    <!-- Search -->
                    <!-- <input type="text" class="form-control typeahead" placeholder="Search" name="search" id="autocomplete"/> -->

                        <!-- <ul class="nav navbar-nav">
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Movie-List <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                            <li><a href="{{ url('/searchFix/') }}">A-M</a></li>
                            <li><a href="#">N-Z</a></li>
                            </ul>
                            </li>
                        </ul> -->

                        @guest
                        @else
                            <li class="dropdown">
                                <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a> -->
    `                       
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- SideBar -->
        <nav class="main-menu" id="SideBar_b">
            <ul>
                <li class="has-subnav">
                    <a href="{{ url('/') }}">
                        <i class="fa fa-home fa-2x"></i>
                        <span class="nav-text">
                            หน้าหลัก
                        </span>
                    </a>       
                </li>
                <li class="has-subnav">
                    <a href="{{ url('/list') }}">
                        <i class="fa fa-list fa-2x"></i>
                        <span class="nav-text">
                            รายชื่อหนังทั้งหมด
                        </span>
                    </a>       
                </li>
                <!-- <li class="has-subnav">
                    <a href="#">
                    <i class="fa fa-map-marker fa-2x"></i>
                        <span class="nav-text">
                            Forms
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="#">
                    <i class="fa fa-folder-open fa-2x"></i>
                        <span class="nav-text">
                            Pages
                        </span>
                    </a>
                
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-bar-chart-o fa-2x"></i>
                        <span class="nav-text">
                            Graphs and Statistics
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-font fa-2x"></i>
                        <span class="nav-text">
                            Typography and Icons
                        </span>
                    </a>
                </li> -->
            @guest
            @else
                <li>
                <a href="{{ url('movie/create') }}">
                    <i class="fa fa-laptop fa-2x"></i>
                        <span class="nav-text">
                            เพิ่มรายการหนัง
                        </span>
                    </a>
                </li>
                <li>
                <a href="{{ url('movie/on_air') }}">
                        <i class="fa fa-table fa-2x"></i>
                        <span class="nav-text">
                            กำหนดคิวฉายหนัง
                        </span>
                    </a>
                </li><br/>
                <li>
                    <a href="{{url('login')}}">
                        <i class="mx-2"></i>
                        <span class="nav-text">
                            สวัสดีคุณ: {{ Auth::user()->name }}
                        </span>
                    </a>
                
                </li><br/>
            <li style="background: #000; width: 99.9%">
                <a>
                    <span class="nav-text">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" style="color: red;">
                            <br/><b class="mx-4">Logout</b><br/><br/>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </span>
                </a>
            </li>
            @endguest
            </ul>
        </nav>
        

        @yield('content')
    </div>

    <!-- JQ Autocomplete -->
    <script type="text/javascript">
        $('#autocomplete').autocomplete({
            serviceUrl: '{{ url('/navSearch') }}',

            formatResult: function(suggestion, currentValue) {
                // dd(suggestion.value);
                return `
                    <label class="btn btn-dark mt-1">ID: ${suggestion.data}</label>
                    <img src="{{ url('/Movie_Picture/${suggestion.pic}') }}" width="50px">
                    <label>${suggestion.value}</label>
                `;
            },
            onSelect: function (suggestion) {
                location.replace("{{url('/search')}}" + '/' + suggestion.data);
            }
        });
    </script>
    
    
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('jsList/jquery-listnav.js') }}"></script>
    <script>
        $('#SideBar_a').on('click', function() {
            $('#SideBar_b').toggleClass('expanded');
        });
    </script>
    <!-- DataTable -->
    <script>
        $(document).ready(function() {
            var table = $('#dataTableAddMovie').DataTable();
        } );
    </script>
    <!-- Alphabet List Fiter -->
    <script>
        $(function(){
            $('#demoFive').listnav({
                includeOther: true,
                prefixes: ['a', 'The Complete Works of']
            });
            $('.demo a').click(function(e) {
                e.preventDefault();
            });
        });
    </script>
    </body>
</html>
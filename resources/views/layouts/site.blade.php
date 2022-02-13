<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
         <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Title -->
    <title>D-Classroom</title>

    <!-- Favicon icons -->
    <link href="images/favicon.png" rel="shortcut icon">

    <!-- All CSS -->
    <link rel="stylesheet" href="{{asset('front-end/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front-end/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('front-end/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('front-end/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('front-end/css/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('front-end/css/fonts/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('front-end/css/style.css')}}">

    </head>
    <body>
        <!-- Preloader -->
        <div id="preloader">
            <div id="status"></div>
        </div>
        <div class="header-top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-info">
                            <p><i class="ti-mobile"></i> +223 76 00 11 34</p>
                            <p><i class="ti-email"></i> contact@dialloclassroom.com</p>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <!--ul class="login-area">
                            <li>
                                <a href="{{route('web.site-login')}}" class="login"><i class="ti-power-off"></i> Connexion</a>
                            </li>
                            <li>
                                <a href="{{route('web.site-register')}}" class="rsgiter"><i class="ti-plus"></i> Inscription</a>
                            </li>
                        </ul-->
                    </div>
                </div>  
            </div><!-- END .CONTAINER -->
        </div>
    
        <!-- Header strat -->
        <header class="header">
            <div class="container">
                <nav class="navbar">
                    <!-- Site logo -->
                    <a href="{{route('web.index')}}" class="logo">
                        <span class=""><span>D-Classroom</span></span>
                    </a>
    
                    <a href="javascript:void(0);" id="mobile-menu-toggler">
                        <i class="ti-align-justify"></i>
                    </a>
                    <ul class="navbar-nav">
                        <li>
                            <a href="{{route('web.index')}}">Accueil</a>
                        </li>
                        <li><a href="{{route('web.about')}}">Apropos de nous</a></li>
                        <li>
                            <a href="{{route('web.cours')}}">Cours</a>
                        </li>
                        <li>
                            <a href="{{route('web.blogs')}}">Blogs</a>
                        </li>
                        <li><a href="{{route('web.contact')}}">Contact</a></li>
                    </ul>
                </nav>
            </div>
    </header>
    <!-- Header End -->
    @yield('content')
    <!-- Footer strat -->
    <footer class="footer">
        <div class="foo-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="widget widget-navigation">
                            <h4 class="widget-title" style="color:#fff">D-CLASSROM</h4>
                            <div class="widget-content">
                                <p style="color:#fff">
                                Startup de Formation, Diallo Classroom est un Cabinet de renforcement de comp&eacute;tences dans le domaine du BTP.
                                Un Cabinet d'Orientation, de Formation et de prestations sur les Logiciels de BTP (B&agrave;timent Travaux Public). 
                                </p>
                                <ul class="social-media">
                                    <li>
                                        <a href="https://www.facebook.com/DialloClassroom" target="_blank"><i class="ti-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/DialloClassroom" target="_blank"><i class="ti-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/dialloclassroom/?hl=fr" target="_blank"><i class="ti-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.snapchat.com/add/dialloclassroom?share_id=MjUwMDVC&locale=fr_ML" target="_blank" title="Snapchat"><i class="ti-mobile"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://vm.tiktok.com/ZMLFEWHva/" target="_blank" title="TikTok"><i class="ti-mobile"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://wa.me/message/4C32ZSUA3FKIL1" target="_blank" title="WathsApp"><i class="ti-mobile"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget widget-navigation">
                            <h4 class="widget-title" style="color:#fff">Liens rapides</h4>
                            <ul>
                                <li><a href="#" style="color:#fff">D&eacute;claration de confidentialit&eacute;</a></li>
                                <li><a href="#" style="color:#fff">Liste des cours</a></li>
                                <li><a href="#" style="color:#fff">Voir notre blog</a></li>
                                <li><a href="#" style="color:#fff">Signaler une violation des droits d'auteur</a></li>
                                <li><a href="#" style="color:#fff">Signaler un probl&egrave;me de s&eacute;curit&eacute;</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget widget-navigation">
                            <h4 class="widget-title" style="color:#fff">Besoin d'aide ?</h4>
                            <ul>
                                <li><a href="#" style="color:#fff">Faq</a></li>
                                <li><a href="#" style="color:#fff">Politique de confidentialit&eacute;</a></li>
                                <li><a href="#" style="color:#fff">Mentions L&eacute;gales</a></li>
                                <li><a href="#" style="color:#fff">Param&egrave;trer les cookies</a></li>
                                <li><a href="#" style="color:#fff">Nous rejoindre</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="foo-btm">
            <div class="container">
                <p class="copyright">Copyright © <script>
                        document.write(new Date().getFullYear());
                    </script> <i class="ti-heart"></i> <a href="#">D-classroom</a>. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <!-- Footer end -->

    <!-- JS -->
    <script src="{{asset('front-end/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('front-end/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('front-end/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('front-end/js/owl.carousel.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxYLtelXg0PGjeTiFDtlN7nrH_47buDWo"></script>
    <script src="{{asset('front-end/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('front-end/js/daterangepicker.js')}}"></script>
    <script src="{{asset('front-end/js/scripts.js')}}"></script>
    </body>
</html>

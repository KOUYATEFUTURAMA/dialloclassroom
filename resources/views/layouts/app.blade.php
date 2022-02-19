<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ 'Dialloclassroom' }}</title>

        <!-- Scripts -->
        <script src="{{asset('plugins/jQuery/query.min.js')}}"></script>
        <script src="{{asset('plugins/angular/angular.js')}}"></script>
        <script src="{{asset('template/js/pages/features/miscellaneous/toastr.js')}}"></script>
        <script src="{{asset('template/js/pages/features/miscellaneous/sweetalert2.js')}}"></script>
        <script src="{{asset('template/js/pages/features/forms/widgets/select2.js')}}"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

        <!-- Styles -->
        <link href="{{ asset('css/my-style.css') }}" rel="stylesheet">
        <link href="{{asset('template/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('template/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="{{asset('template/media/logos/logo.jpeg')}}" />

    </head>
    <body id="smartApp" ng-app="smartApp" class="header-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <script type="text/javascript">
            var smartApp = angular.module('smartApp', []);
            var basePath = "{{url('/')}}";
        </script>
        <!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile">
            @if(Auth::user()->role == 'Concepteur' or Auth::user()->role == 'Administrateur')
                <a href="{{ route('home.admin') }}">
                    <img alt="Logo" src="{{asset('template/media/logos/logo.jpeg')}}" class="h-40px"/>
                    &nbsp;<span class="esante-font-mobile"> Dialloclassroom </span>
                </a>
            @endif
            @if(Auth::user()->role == 'Client')
                <a href="{{ route('home.client') }}">
                    <img alt="Logo" src="{{asset('template/media/logos/fav.jpeg')}}" class="h-40px"/>
                    &nbsp;<span class="esante-font-mobile"> Dialloclassroom </span>
                </a>
            @endif
			<div class="d-flex align-items-center">
				<button class="btn btn-icon btn-icon-white btn-hover-icon-white" id="kt_aside_mobile_toggle">
					<span class="svg-icon svg-icon-xxl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"/>
                                <path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z" fill="#000000" opacity="0.3"/>
                            </g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
				<button class="btn btn-icon btn-icon-white btn-hover-icon-white ml-1" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24"></polygon>
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
			</div>
		</div>
        <div class="aside aside-left aside-fixed" id="kt_aside">
            <div class="aside-brand h-80px px-4 flex-shrink-0">
                @if(Auth::user()->role == 'Concepteur' or Auth::user()->role == 'Administrateur')
                    <a href="{{ route('home.admin') }}" class="menu-link">
                @endif
                @if(Auth::user()->role == 'Client')
                    <a href="{{ route('home.client') }}" class="menu-link">
                @endif
                <img alt="Logo" src="{{asset('template/media/logos/logo.jpeg')}}" class="h-50px" />
                <span style="font-family: Arial black; font-weight: 500;font-size: 13px;line-height: 1.2;color: #fff;">Dialloclassroom</span>
                </a>
                &nbsp;&nbsp;
                <button class="aside-toggle btn btn-sm btn-icon-white" id="kt_aside_toggle">
					<span class="svg-icon svg-icon svg-icon-xl">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<path fill-rule="evenodd" clip-rule="evenodd" d="M22 11.5C22 12.3284 21.3284 13 20.5 13H3.5C2.6716 13 2 12.3284 2 11.5C2 10.6716 2.6716 10 3.5 10H20.5C21.3284 10 22 10.6716 22 11.5Z" fill="black" />
								<path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M14.5 20C15.3284 20 16 19.3284 16 18.5C16 17.6716 15.3284 17 14.5 17H3.5C2.6716 17 2 17.6716 2 18.5C2 19.3284 2.6716 20 3.5 20H14.5ZM8.5 6C9.3284 6 10 5.32843 10 4.5C10 3.67157 9.3284 3 8.5 3H3.5C2.6716 3 2 3.67157 2 4.5C2 5.32843 2.6716 6 3.5 6H8.5Z" fill="black" />
							</g>
						</svg>
					</span>
				</button>
            </div>
            <div id="kt_aside_menu" class="aside-menu my-5 scroll ps ps--active-y" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500" style="height: 346px; overflow: hidden;">
                <ul class="menu-nav">
                    <li class="menu-item {{Route::currentRouteName() === 'home.admin' || Route::currentRouteName() === 'home.client' ? 'menu-item-active' : ''}}" aria-haspopup="true">
                        @if(Auth::user()->role == 'Concepteur' or Auth::user()->role == 'Administrateur')
                            <a href="{{ route('home.admin') }}" class="menu-link">
                        @endif
                        @if(Auth::user()->role == 'Client')
                            <a href="{{ route('home.client') }}" class="menu-link">
                        @endif
							<span class="svg-icon menu-icon">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                        <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                    </g>
								</svg>
							</span>
							<span class="menu-text">Tableau de bord</span>
						</a>
					</li>
                    <li class="h-10px"></li>
                        @if(Auth::user()->role == 'Concepteur' or Auth::user()->role == 'Administrateur')
                        @include('layouts.partials.menus.admin.parametre')
                        @include('layouts.partials.menus.admin.education')
                        @include('layouts.partials.menus.admin.site')
                        @include('layouts.partials.menus.admin.index')
                        @endif
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ route('logout') }}" class="menu-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="svg-icon menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M7.62302337,5.30262097 C8.08508802,5.000107 8.70490146,5.12944838 9.00741543,5.59151303 C9.3099294,6.05357769 9.18058801,6.67339112 8.71852336,6.97590509 C7.03468892,8.07831239 6,9.95030239 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,9.99549229 17.0108275,8.15969002 15.3875704,7.04698597 C14.9320347,6.73472706 14.8158858,6.11230651 15.1281448,5.65677076 C15.4404037,5.20123501 16.0628242,5.08508618 16.51836,5.39734508 C18.6800181,6.87911023 20,9.32886071 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,9.26852332 5.38056879,6.77075716 7.62302337,5.30262097 Z" fill="#000000" fill-rule="nonzero"/>
                                        <rect fill="#000000" opacity="0.3" x="11" y="3" width="2" height="10" rx="1"/>
                                    </g>
                                </svg>
                            </span>
                            <span class="menu-text">Se D&eacute;connecter</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex flex-column flex-root">
            <div class="d-flex flex-row flex-column-fluid page">
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    <div id="kt_header" class="header">
                        <div class="container">
                            <div class="d-flex align-items-center flex-wrap mr-1 mt-5 mt-lg-0">
								<div class="d-flex align-items-baseline flex-wrap mr-5">
									<h4 class="text-dark font-weight-bold my-1 mr-5">{{ $menuPrincipal }} >
									<small class="text-muted ml-2">{{ $titleControlleur }}</small></h4>
								</div>
							</div>
                            <div class="topbar">
                               <div class="topbar-item mr-3">
									<div class="btn btn-icon btn-bg-white btn-icon-primary btn-circle align-items-center overflow-hidden" id="kt_quick_user_toggle">
										<img alt="Logo" src="{{asset('template/media/users/user.jpg')}}" class="h-75 align-self-end" />
									</div>
                                    &nbsp;&nbsp;<span class="text-dark font-weight-bold"> {{Auth::user()->name}} </span>
								</div>
                            </div>
                        </div>
                    </div>
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        @if($btnModalAjout == 'TRUE')
                            <p class="text-right">
                                <button id="btnModalAjout" class="btn btn-primary btn-shadow font-weight-bold mr-15">
                                    <i class="ki ki-solid-plus icon-lg"></i> Ajouter
                                </button>
                            </p>
                        @endif
                        @yield('content')
                    </div>
                    <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
						<div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <input type="hidden" id="user_role" value="{{Auth::user()->role}}"/>
							 <div class="text-dark order-2 order-md-1">
                                    <span class="text-muted font-weight-bold mr-2">Copyright &copy; 2021</span>
                                    <a class="text-dark-50">Dialloclassroom</a>All rights reserved.
                                </div>
						</div>
					</div>
                </div>
            </div>
        </div>

        <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
                <!--begin::Header-->
                <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
                    <h3 class="font-weight-bold m-0">Mon profil</h3>
                    <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                        <i class="ki ki-close icon-xs text-muted"></i>
                    </a>
                </div>

                <!--begin::Content-->
                            <div class="offcanvas-content pr-5 mr-n5">
                                <div class="d-flex align-items-center mt-5">
                                    <div class="symbol symbol-100 mr-5">
                                        <div class="flex-shrink-0 mr-7">
                                            <div class="symbol symbol-50 symbol-lg-120 symbol-label symbol-circle">
                                                <img alt="logo" src="{{asset('template/media/users/user.jpg')}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{Auth::user()->name}}</a>
                                        <div class="text-muted mt-1">{{Auth::user()->role}}</div>
                                        <div class="navi mt-1">
                                            <a class="navi-item">
                                                <span class="navi-text text-muted text-hover-primary">{{Auth::user()->email}}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator separator-dashed mt-8 mb-5"></div>
                                <div class="border-0 d-flex align-items-center justify-content-between pt-0">
                                    <span class="navi-item mt-2">
                                        <span class="navi-link">
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-sm btn-light-danger font-weight-bolder py-3 px-6"> <i class="flaticon-logout"></i> Se D&eacute;connecter</a>
                                        </span>
                                    </span>
                                    <span class="navi-item mt-2">
                                        <span class="navi-link">
                                            <a href="{{ route('auth.user.profil') }}" class="btn btn-sm btn-light-primary font-weight-bolder py-3 px-6"> <i class="flaticon-user"></i> Voir profil</a>
                                        </span>
                                    </span>
                                </div>
                            </div>
            </div>
        <script>var HOST_URL = "https://preview.keenthemes.com/keen/theme/tools/preview";</script>
        <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3E97FF", "secondary": "#E5EAEE", "success": "#08D1AD", "info": "#844AFF", "warning": "#F5CE01", "danger": "#FF3D60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#DEEDFF", "secondary": "#EBEDF3", "success": "#D6FBF4", "info": "#6125E1", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
        <script src="{{asset('template/plugins/global/plugins.bundle.js')}}"></script>
        <script src="{{asset('template/plugins/custom/flot/flot.bundle.js')}}"></script>
        <script src="{{asset('template/js/scripts.bundle.js')}}"></script>
        <script src="{{asset('template/js/pages/widgets.js')}}"></script>
        <script src="{{asset('template/js/pages/features/charts/flotcharts.js')}}"></script>
        <script type="text/javascript">
            $('.overlay-block').removeClass('overlay');
            $('.spinner-lg').removeClass('spinner');
            $(function () {
                $("#btnModalAjout").on("click", function () {
                    document.forms["formAjout"].reset();
                    $(".bs-modal-ajout").modal("show");
                });

                //Reactivation de fenetre modal (le cas ou 2 fenetres sont superposées)
                $(document).on('hidden.bs.modal', function (e) {
                    if ($('.modal:visible').length) {
                        $("body").addClass('modal-open');
                    }
                });
            });
        </script>
    </body>
</html>

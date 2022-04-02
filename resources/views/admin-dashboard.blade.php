@extends('layouts.app')
@section('content')
<div class="card-body">
    <div class="row">
        <div class="col-xl-3">
            <div class="card card-custom gutter-b">
                <a href="{{ route('education.enseignants.index') }}">
                    <div class="card-body d-flex align-items-center py-5 py-lg-10">
                        <!--begin::Icon-->
                        <div class="d-flex flex-center position-relative ml-5 mr-15 ml-lg-11 mr-lg-19">
                            <span class="svg-icon svg-icon-6x svg-icon-info position-absolute opacity-15">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" width="70px" height="70px" viewBox="0 0 70 70" fill="none">
                                    <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                        <path d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z" fill="#000000"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="svg-icon svg-icon-2x svg-icon-primary position-absolute">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-done.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <div class="">
                            <h3 class="pb-1 text-dark-75 font-weight-bolder font-size-h5">
                                {{ number_format($enseignants->count(), 0, ',', ' ') }} ENSEIGNANTS
                            </h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card card-custom gutter-b">
                <a href="{{ route('education.cours.index') }}">
                    <div class="card-body d-flex align-items-center py-5 py-lg-10">
                        <!--begin::Icon-->
                        <div class="d-flex flex-center position-relative ml-5 mr-15 ml-lg-11 mr-lg-19">
                            <span class="svg-icon svg-icon-6x svg-icon-info position-absolute opacity-15">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" width="70px" height="70px" viewBox="0 0 70 70" fill="none">
                                    <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                        <path d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z" fill="#000000"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="svg-icon svg-icon-2x svg-icon-success position-absolute">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-done.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M5,6 L19,6 C19.5522847,6 20,6.44771525 20,7 L20,17 L4,17 L4,7 C4,6.44771525 4.44771525,6 5,6 Z" fill="#000000"/>
                                        <rect fill="#000000" opacity="0.3" x="1" y="18" width="22" height="1" rx="0.5"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <div class="">
                            <h3 class="pb-1 text-dark-75 font-weight-bolder font-size-h5">
                                {{ number_format($cours->count(), 0, ',', ' ') }} COURS
                            </h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card card-custom gutter-b">
                <a href="{{ route('education.blogs.index') }}">
                    <div class="card-body d-flex align-items-center py-5 py-lg-10">
                        <!--begin::Icon-->
                        <div class="d-flex flex-center position-relative ml-5 mr-15 ml-lg-11 mr-lg-19">
                            <span class="svg-icon svg-icon-6x svg-icon-info position-absolute opacity-15">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" width="70px" height="70px" viewBox="0 0 70 70" fill="none">
                                    <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                        <path d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z" fill="#000000"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="svg-icon svg-icon-2x svg-icon-warning position-absolute">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-done.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M5.5,4 L9.5,4 C10.3284271,4 11,4.67157288 11,5.5 L11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L5.5,8 C4.67157288,8 4,7.32842712 4,6.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M14.5,16 L18.5,16 C19.3284271,16 20,16.6715729 20,17.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,17.5 C13,16.6715729 13.6715729,16 14.5,16 Z" fill="#000000"/>
                                        <path d="M5.5,10 L9.5,10 C10.3284271,10 11,10.6715729 11,11.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,12.5 C20,13.3284271 19.3284271,14 18.5,14 L14.5,14 C13.6715729,14 13,13.3284271 13,12.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <div class="">
                            <h3 class="pb-1 text-dark-75 font-weight-bolder font-size-h5">
                                {{ number_format($blogs->count(), 0, ',', ' ') }} BLOGS
                            </h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card card-custom gutter-b">
                <a href="{{ route('site.videos.index') }}">
                    <div class="card-body d-flex align-items-center py-5 py-lg-10">
                        <!--begin::Icon-->
                        <div class="d-flex flex-center position-relative ml-5 mr-15 ml-lg-11 mr-lg-19">
                            <span class="svg-icon svg-icon-6x svg-icon-info position-absolute opacity-15">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" width="70px" height="70px" viewBox="0 0 70 70" fill="none">
                                    <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                        <path d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z" fill="#000000"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="svg-icon svg-icon-2x svg-icon-success position-absolute">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-done.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M11.7752551,13.2928932 C12.3275399,13.2928932 12.7752551,12.845178 12.7752551,12.2928932 C12.7752551,11.7406085 12.3275399,11.2928932 11.7752551,11.2928932 C11.2229704,11.2928932 10.7752551,11.7406085 10.7752551,12.2928932 C10.7752551,12.845178 11.2229704,13.2928932 11.7752551,13.2928932 Z M11.2235429,9.10222252 C12.2904751,8.8163389 12.9236401,7.71966498 12.6377564,6.65273278 C12.3518728,5.58580057 11.2551989,4.95263559 10.1882667,5.23851922 C9.12133448,5.52440284 8.4881695,6.62107675 8.77405312,7.68800896 C9.05993675,8.75494117 10.1566107,9.38810614 11.2235429,9.10222252 Z M13.8117333,18.7614808 C14.8786655,18.4755972 15.5118305,17.3789232 15.2259469,16.311991 C14.9400633,15.2450588 13.8433893,14.6118939 12.7764571,14.8977775 C11.7095249,15.1836611 11.0763599,16.280335 11.3622436,17.3472672 C11.6481272,18.4141994 12.7448011,19.0473644 13.8117333,18.7614808 Z M7.68800896,15.2259469 C8.75494117,14.9400633 9.38810614,13.8433893 9.10222252,12.7764571 C8.8163389,11.7095249 7.71966498,11.0763599 6.65273278,11.3622436 C5.58580057,11.6481272 4.95263559,12.7448011 5.23851922,13.8117333 C5.52440284,14.8786655 6.62107675,15.5118305 7.68800896,15.2259469 Z M17.3472672,12.6377564 C18.4141994,12.3518728 19.0473644,11.2551989 18.7614808,10.1882667 C18.4755972,9.12133448 17.3789232,8.4881695 16.311991,8.77405312 C15.2450588,9.05993675 14.6118939,10.1566107 14.8977775,11.2235429 C15.1836611,12.2904751 16.280335,12.9236401 17.3472672,12.6377564 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M17.6573343,19 L21,19 C21.5522847,19 22,19.4477153 22,20 C22,20.5522847 21.5522847,21 21,21 L12,21 C14.1432966,21 16.1116082,20.2507999 17.6573343,19 Z" fill="#000000"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <div class="">
                            <h3 class="pb-1 text-dark-75 font-weight-bolder font-size-h5">
                                {{ number_format($videos->count(), 0, ',', ' ') }} VIDEOS
                            </h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 pt-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder font-size-h4 text-dark-75">Liste des 5 cours les plus r&eacute;serv&eacute;s</span>
                        @php 
                            $totalS = 0;
                            foreach($coursReserves as $cour){
                                $totalS += $cour->total;
                            }
                        @endphp
                        <span class="text-muted mt-3 font-weight-bold font-size-lg">Total {{ number_format($totalS, 0, ',', ' ') }} fois</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-1 pb-4">
                    <div class="tab-content mt-5" id="myTabTable1">
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade show active" id="kt_tab_table_1_3" role="tabpanel" aria-labelledby="kt_tab_table_1_3">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-borderless table-vertical-center">
                                    <thead>
                                        <tr>
                                            <th class="p-0 min-w-150px"></th>
                                            <th class="p-0 min-w-140px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($coursReserves as $cour)
                                        <tr>
                                            <td class="pl-0 text-left">
                                                <a class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$cour->libelle_cours}}</a>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$cour->total}} fois</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Tablet-->
                        </div>
                        <!--end::Tap pane-->
                    </div>
                </div>
                <!--end::Body-->
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 pt-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder font-size-h4 text-dark-75">Liste des 5 cours les plus ach&eacute;t&eacute;s</span>
                        @php 
                            $totalC = 0;
                            foreach($coursAchats as $cour){
                                $totalC += $cour->total;
                            }
                        @endphp
                        <span class="text-muted mt-3 font-weight-bold font-size-lg">Total {{ number_format($totalC, 0, ',', ' ') }} fois</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-1 pb-4">
                    <div class="tab-content mt-5" id="myTabTable1">
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade show active" id="kt_tab_table_1_3" role="tabpanel" aria-labelledby="kt_tab_table_1_3">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-borderless table-vertical-center">
                                    <thead>
                                        <tr>
                                            <th class="p-0 min-w-150px"></th>
                                            <th class="p-0 min-w-140px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($coursAchats as $cour)
                                            <tr>
                                                <td class="pl-0 text-left">
                                                    <a class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$cour->libelle_cours}}</a>
                                                </td>
                                                <td class="text-right">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$cour->total}} fois</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Tablet-->
                        </div>
                        <!--end::Tap pane-->
                    </div>
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <div id="stats-widget-slider-3" class="carousel slide" data-ride="carousel" data-interval="8000">
                        <!--begin::Top-->
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <!--begin::Label-->
                            <span class="font-size-h6 text-muted font-weight-bolder text-uppercase pr-2">Chiffres d'affaires par acaht de cours</span>
                            <!--end::Label-->
                            <!--begin::Action-->
                            <div class="p-0">
                                <a href="#stats-widget-slider-3" class="btn btn-icon btn-light btn-sm mr-1" role="button" data-slide="prev">
                                    <span class="svg-icon svg-icon-md">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-left.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-12.000003, -11.999999)"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </a>
                                <a href="#stats-widget-slider-3" class="btn btn-icon btn-light btn-sm" role="button" data-slide="next">
                                    <span class="svg-icon svg-icon-md">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-right.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-270.000000) translate(-12.000003, -11.999999)"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </a>
                            </div>
                            <!--end::Action-->
                        </div>
                        <!--end::Top-->
                        <!--begin::Carousel-->
                        <div class="carousel-inner pt-9">
                            <!--begin::Item-->
                            <div class="carousel-item active">
                                <!--begin::Section-->
                                <div class="flex-grow-1">
                                    <!--begin::Title-->
                                    <h3 class="font-size-h4 text-dark-75 text-hover-primary font-weight-bold cursor-pointer">Chiffres d'affaires du jour</h3>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                  
                                    <p class="text-primary font-size-h2 font-weight-bolder pt-3 mb-0">{{ number_format($ca_acht_jour, 0, ',', ' ') }} F CFA</p>
                                    <!--end::Text-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="carousel-item">
                                <!--begin::Section-->
                                <div class="flex-grow-1">
                                    <!--begin::Title-->
                                    <h3 class="font-size-h4 text-dark-75 text-hover-primary font-weight-bold cursor-pointer">Chiffres d'affaires pour ces 7 derniers jours</h3>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <p class="text-primary font-size-h2 font-weight-bolder pt-3 mb-0">{{ number_format($ca_acht_week, 0, ',', ' ') }} F CFA</p>
                                    <!--end::Text-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="carousel-item">
                                <!--begin::Section-->
                                <div class="flex-grow-1">
                                    <!--begin::Title-->
                                    <h3 class="font-size-h4 text-dark-75 text-hover-primary font-weight-bold cursor-pointer">Chiffres d'affaires pour ce mois</h3>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <p class="text-primary font-size-h2 font-weight-bolder pt-3 mb-0">{{ number_format($ca_acht_mois, 0, ',', ' ') }} F CFA</p>
                                    <!--end::Text-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Carousel-->
                    </div>
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer border-0 d-flex align-items-center justify-content-between pt-0">
                    <!--begin::Label-->
                    <span class="text-muted font-size-lg font-weight-bold pr-2">Total {{ number_format($ca_acht_total, 0, ',', ' ') }} F CFA</span>
                    <!--end::Label-->
                    <a href="{{ route('education.reservations.achat') }}" class="btn btn-sm btn-primary font-weight-bolder px-6">Voir liste</a>
                </div>
                <!--end::Footer-->
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <div id="stats-widget-slider-4" class="carousel slide" data-ride="carousel" data-interval="8000">
                        <!--begin::Top-->
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <!--begin::Label-->
                            <span class="font-size-h6 text-muted font-weight-bolder text-uppercase pr-2">Chiffre daffaires par r&eacute;servation</span>
                            <!--end::Label-->
                            <!--begin::Action-->
                            <div class="p-0">
                                <a href="#stats-widget-slider-4" class="btn btn-icon btn-light btn-sm mr-1" role="button" data-slide="prev">
                                    <span class="svg-icon svg-icon-md">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-left.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-12.000003, -11.999999)"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </a>
                                <a href="#stats-widget-slider-4" class="btn btn-icon btn-light btn-sm" role="button" data-slide="next">
                                    <span class="svg-icon svg-icon-md">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-right.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-270.000000) translate(-12.000003, -11.999999)"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </a>
                            </div>
                            <!--end::Action-->
                        </div>
                        <!--end::Top-->
                        <!--begin::Carousel-->
                        <div class="carousel-inner pt-9">
                            <!--begin::Item-->
                            <div class="carousel-item active">
                                <!--begin::Section-->
                                <div class="flex-grow-1">
                                    <!--begin::Title-->
                                    <h3 class="font-size-h4 text-dark-75 text-hover-success font-weight-bold cursor-pointer">Chiffre daffaires aujourd'hui</h3>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <p class="text-success font-size-h2 font-weight-bolder pt-3 mb-0">{{ number_format($ca_reser_jour, 0, ',', ' ') }} F CFA</p>
                                    <!--end::Text-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="carousel-item">
                                <!--begin::Section-->
                                <div class="flex-grow-1">
                                    <!--begin::Title-->
                                    <h3 class="font-size-h4 text-dark-75 text-hover-success font-weight-bold cursor-pointer">Chiffre daffaires pour ces 7 derniers jours</h3>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <p class="text-success font-size-h2 font-weight-bolder pt-3 mb-0">{{ number_format($ca_reser_week, 0, ',', ' ') }} F CFA</p>
                                    <!--end::Text-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="carousel-item">
                                <!--begin::Section-->
                                <div class="flex-grow-1">
                                    <!--begin::Title-->
                                    <h3 class="font-size-h4 text-dark-75 text-hover-success font-weight-bold cursor-pointer">Chiffre daffaires pour ce mois</h3>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <p class="text-success font-size-h2 font-weight-bolder pt-3 mb-0">{{ number_format($ca_reser_mois, 0, ',', ' ') }} F CFA</p>
                                    <!--end::Text-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Carousel-->
                    </div>
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer border-0 d-flex align-items-center justify-content-between pt-0">
                    <!--begin::Label-->
                    <span class="text-muted font-size-lg font-weight-bold pr-2">Total {{ number_format($ca_reser_total, 0, ',', ' ') }} F CFA</span>
                    <!--end::Label-->
                    <a href="{{ route('education.reservations.index') }}" class="btn btn-sm btn-success font-weight-bolder px-6">Voir liste</a>
                </div>
                <!--end::Footer-->
            </div>
        </div>
    </div>
</div>
@endsection

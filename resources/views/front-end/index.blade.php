@extends('layouts.site')
@section('content')
<link href="{{asset('template/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('plugins/jQuery/query.min.js')}}"></script>
<script src="{{asset('template/js/pages/features/miscellaneous/sweetalert2.js')}}"></script>
<script src="{{asset('template/plugins/global/plugins.bundle.js')}}"></script>
<!-- Banner start -->
    <section class="banner v2">
        <div class="owl-carousel hero-slider">
            @foreach ($sliders as $slider)
                <div class="item" style="background-image:url('{{url($slider->image) }}'); border: solid #0c2e60;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <div class="banner-content">
                                    <h2><span>{{$slider->libelle_slider}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Feature section start -->
    <section class="feature pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4"> 
                    <div class="iconBox text-center">
                        <img src="{{asset('front-end/images/icons/3.jpg')}}" alt="image icon">
                        <h5>
                            <a>Des formations en ligne avec des formateurs exp&eacute;riment&eacute;s. </a>
                        </h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="iconBox text-center">
                        <img src="{{asset('front-end/images/icons/2.jpg')}}" alt="image icon">
                        <h5>
                            <a>Des formations en pr&eacute;sidentielle avec des formateurs qualifi&eacute;s</a>
                        </h5>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="iconBox text-center">
                        <img src="{{asset('front-end/images/icons/1.jpg')}}" alt="image icon">
                        <h5>
                            <a>Plus de 1000 vid&eacute;os de formation disponible.</a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Feature section end -->

    <!-- Cours section start -->
    <section class="courses home bg-offwhite">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-9 m-auto text-center">
                    <div class="sec-heading">
                        <h3 class="sec-title">Cours en vedette</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($cours_en_vedettes as $cours)
                <div class="col-lg-4 col-md-6">
                    <div class="single-course">
                        <figure class="course-thumb">
                            <img src="{{asset($cours->image_descriptive)}}" alt="">
                            <!--div class="info-area">
                                <ul>
                                    <li>
                                        <a href="#" class="used" data-toggle="tooltip" data-placement="top" title="USED">Nouveauté</a>
                                    </li>
                                </ul>
                            </div-->
                            <div class="meta-area">
                                <ul>
                                    <li>
                                        <a href="{{$cours->link()}}" data-toggle="tooltip" data-placement="top" title="{{$cours->mode->slug != 'cours-video' ? 'Reservez' : 'Achetez'}}"><i class="ti-heart"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </figure>
                        <div class="course-content">
                            <h3><a href="{{$cours->link()}}">{{Str::limit($cours->libelle_cours, 50, '...')}}</a></h3>
                            <hr class="my-2">
                            <dl class="row m-0">
                                <dt class="product-item-part col-xs-5">Dur&eacute;e</dt>
                                <dd class="col-xs-7">{{$cours->duree}} H</dd>
                                <dt class="product-item-part col-xs-5">Prix</dt>
                                <dd class="col-xs-7">
                                    {{number_format($cours->prix, 0, ',', ' ')}} F CFA </dd>
                                <dt class="product-item-part col-xs-5">Place disponible</dt>
                                <dd class="col-xs-7">
                                    {{$cours->nombre_place}}
                                </dd>
                                <dt class="product-item-part col-xs-5">Date</dt>
                                <dd class="col-xs-7">{{ date('d-m-Y',strtotime($cours->date_cours)) }}</dd>
                                <dt class="product-item-part col-xs-5">Type</dt>
                                <dd class="col-xs-7">{{ $cours->mode->libelle_mode }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Cours section end -->

    <!-- Gallery section start -->
    <section class="courses home" style="background-color:#0c2e60;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-9 m-auto text-center">
                    <div class="sec-heading">
                        <h3 class="sec-title text-white">Gallerie vid&eacute;o</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($videos as $video)
                <div class="col-lg-4 col-md-6">
                    <figure style="border: thick double #fff;">
                        <video src="{{asset($video->video)}}" controls class="rounded" style="width: 100%;" height="300"> 
                        </video>
                    </figure>
                    <h3 class="text-white mt-2">{{$video->titre}}</h3>
                </div>
                @endforeach
            </div>
            <br/>
            <p style="text-align: center;">
                <a class="text-white btn btn-filled h4" href="{{route('web.galeries')}}">
                    Voir d'autres vid&eacute;os 
                </a> 
            </p>
        </div>
    </section>
    <!-- Gallery section end -->

    <!-- Work section start -->
    <section class="work bg-bluewhite">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-9 m-auto text-center">
                    <div class="sec-heading">
                        <h3 class="sec-title">Pourquoi nous choisir ?</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-5 mb-lg-0">
                        <div class="process">
                            <ul>
                                <li>
                                    <span class="icon-bg">
                                        <i class="ti-signal"></i>
                                    </span>
                                    <h5>Mode de paiement souple</h5>
                                    <p>Les payements sont effectués en deux tranches.</p>
                                </li>
                                <li>
                                    <span class="icon-bg">
                                        <i class="ti-money"></i>
                                    </span>
                                    <h5>Special minoration</h5>
                                    <p>Une remise de 10 000 F CFA s’applique sur chaque formation pour les &eacute;tudiants.</p>
                                </li>
                                <li>
                                    <span class="icon-bg">
                                        <i class="ti-medall"></i>
                                    </span>
                                    <h5>Certificat</h5>
                                    <p>Un certificat vous sera d&eacute;livr&eacute;e &agrave; la fin de chaque formation.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="process">
                            <ul>
                                <li>
                                    <span class="icon-bg">
                                        <i class="ti-desktop"></i>
                                    </span>
                                    <h5>Logiciels gratuits</h5>
                                    <p>Les installations de logiciels sont 100% gratuits.</p>
                                </li>
                                <li>
                                    <span class="icon-bg">
                                        <i class="ti-video-clapper"></i>
                                    </span>
                                    <h5>Cours en ligne</h5>
                                    <p>Des cours en lignes sont organis&eacute;s pour faciliter l'acc&egrave;s des cours &agrave; tous.</p>
                                </li>
                                <li>
                                    <span class="icon-bg">
                                        <i class="ti-time"></i>
                                    </span>
                                    <h5>Horraires flexibles</h5>
                                    <p>Des horraires flexibles pour vous permettre de mieux assimiler les cours.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Work section end -->

    <!-- Start Testimonial Section -->
    <section class="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-9 m-auto text-center">
                    <div class="sec-heading">
                        <h3 class="sec-title text-white">Nos formateurs</h3>
                    </div>
                </div>
            </div>
            <div class="testimonialBox">                        
                <div class="test-caro owl-carousel owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s;">
                                @foreach ($enseignants as $enseignant)
                                    <div class="owl-item">
                                        <div class="single-course">
                                            <figure class="course-thumb" style="border-style: inset;">
                                                <img src="{{asset($enseignant->image)}}" alt="formateur">
                                                <div class="info-area">
                                                    <ul>
                                                        <li>
                                                            <a class="used" data-toggle="tooltip" data-placement="top" title="{{$enseignant->name}}">{{$enseignant->name}}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </figure>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Testimonial Section -->

    <!-- Blog section start -->
    <section class="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-9 m-auto text-center">
                    <div class="sec-heading">
                        <h3 class="sec-title">Chaque mise &agrave; jour de notre page de blog</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($last_blogs as $blog)
                    <div class="col-md-4">
                        <div class="post-item">
                            <img src="{{asset($blog->image)}}" alt="">
                            <div class="post-content">
                                <div class="meta-tags">
                                    <a class="post-meta category">{{$blog->categorie->libelle_categorie}}
                                    </a> | <a class="post-meta date">{{ date('d-m-Y',strtotime($blog->date_event)) }}</a>
                                </div>
                                <h3 class="post-title"><a href="{{$blog->link()}}">{{Str::limit($blog->titre_blog, 30, '...')}}</a></h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog section end -->

    <script>
        function popAction(){
            Swal.fire({
                title: 'Contactez ce numéro pour acheter ou reserver un cour. +223 76 00 11 34',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
    </script>
@endsection
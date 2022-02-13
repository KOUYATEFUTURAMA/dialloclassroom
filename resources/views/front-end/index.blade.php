@extends('layouts.site')
@section('content')
<!-- Banner start -->
    <section class="banner v2">
        <div class="owl-carousel hero-slider">
            <div class="item" style="background-image: url('front-end/images/slider/slider1.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-7">
                            <div class="banner-content">
                                <h2><span>Des certificats</span> reconnus par l'etat</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item" style="background-image: url('front-end/images/slider/slider2.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-7">
                            <div class="banner-content">
                                <h2><span>Un cadre ad&eacute;quat</span> pour un apprentissage de qualit&eacute;</h2>
                                <!--p>Nous avons des salles adapt&eacute;es pour votre formation.</p-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item" style="background-image: url('front-end/images/slider/slider3.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-7">
                            <div class="banner-content">
                                <h2><span>Des cours en ligne disponible.</span> </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item" style="background-image: url('front-end/images/slider/slider4.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-7">
                            <div class="banner-content">
                                <h2><span>D-classrom</span> PERFECTIONNER VOTRE CARRIERE AVEC NOS FORMATIONS PROFESSIONNELLES. ! </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature section start -->
    <section class="feature pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="iconBox text-center">
                        <img src="{{asset('front-end/images/icons/1.jpg')}}" alt="image icon">
                        <h5>
                            <a>Plus de 1000 vid&eacute;os de formation disponibles.</a>
                        </h5>
                    </div>
                </div>
                <div class="col-md-4"> 
                    <div class="iconBox text-center">
                        <img src="{{asset('front-end/images/icons/2.jpg')}}" alt="image icon">
                        <h5>
                            <a>Des formations en pr&eacute;sentilles, en lignes et en vid&eacute;o.</a>
                        </h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="iconBox text-center">
                        <img src="{{asset('front-end/images/icons/3.jpg')}}" alt="image icon">
                        <h5>
                            <a>Des formateurs experiment&eacute;s dans le domaine du b&acirc;timent.</a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Feature section end -->

    <!-- Courses section start -->
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
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="{{$cours->mode->slug != 'cours-video' ? 'Reservez' : 'Achetez'}}"><i class="ti-heart"></i> </a>
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
    <!-- Courses section end -->

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
                                    <p>Une remise de 10 000 F CFA s’applique sur chaque formation.</p>
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
                                    <h5>Cours en ligen</h5>
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
                <div class="col-lg-7 col-md-9 m-auto text-center">
                    <div class="sec-heading">
                        <h3 class="sec-title text-white">Les avis des internautes</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 col-md-12 m-auto">
                    <div class="testimonialBox">                        
                        <div class="test-caro owl-carousel owl-loaded owl-drag" data-slider-id="1">
                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2580px;">
                                    @foreach ($avis as $avi)
                                    <div class="owl-item active" style="width: 860px;">
                                        <div class="single-testimonial">
                                            <div class="testimonial-user">
                                                <img src="{{asset('front-end/images/avatar-small.png')}}" class="avatar-small circle" alt="">
                                            </div>
                                            <p>{{Str::limit($avi->content, 150, '...')}}</p>
                                            <span class="quote-sign"><i class="ti-quote-left"></i></span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
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
@endsection
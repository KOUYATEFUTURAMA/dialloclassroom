@extends('layouts.site')
@section('content')
    <!-- Page feature start -->
    <section class="page-feature py-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-6">
                    <h2 class=" text-left">Details du cours</h2>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumb text-right">
                        <a href="{{route('web.index')}}"><i class="ti-home"></i> Accueil</a>
                        <a href="{{route('web.cours')}}">/ Cours</a>
                        <span>/ D&eacute;tails de cours</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page feature end -->

    <!-- Course Details section start -->
    <section class="yacht-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="yacht-preview">
                        <div class="owl-carousel yacht-slider">
                            @if($cour->video_descriptive)
                                <div class="item">
                                    <video src="{{asset($cour->video_descriptive)}}" class="rounded" style="width:100%;" height="350" controls></video>
                                </div>
                            @else
                                <div class="item">
                                    <img src="{{asset($cour->image_descriptive_slider)}}" alt="">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="course-content">
                        <h3 class="text-left">{{$cour->libelle_cours}}</h3>
                        <div class="details">
                            @if($cour->mode->slug != 'cours-video')
                            <span>Par <a>{{$cour->enseignant->name}}</a></span>
                            @endif
                            <span>Ajouter le {{ date('d-m-Y',strtotime($cour->created_at)) }}</span>
                            <div class="ratings">
                                <span>12 inscrit</span>
                            </div>
                            <div class="ratings">
                                <span>{{ $cour->mode->libelle_mode }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="course-curriculum">
                        <div class="tab-content">
                            <div id="overview" class="tab-pane fade in show active">
                                <h4 class="tab-title">Description</h4>
                                <p>{{$cour->description}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="comments">
                        <h4 class="comment-title">{{$commentaires->count() > 1 ?  $commentaires->count().' Commentaires' :  $commentaires->count().' Commentaire'}} </h4>
                        <ul>
                            @foreach ($commentaires as $commentaire)
                                <li>
                                    <div class="single-comment">
                                        <div class="user-thumb">
                                            <img class="avatar-small" src="{{asset('front-end/images/avatar-small.png')}}" alt="">
                                        </div>
                                        <div class="comments-body">
                                            <h4>{{$commentaire->name}}</h4>
                                            <p>{{$commentaire->content}}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="comment-form">
                        <h4 class="comment-title">Laissez un commentaire</h4>
                        <form action="{{route('comment.store')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$cour->id}}" name="cour_id">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="name">Nom *</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nom & prénom(s)" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    @error('contact')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="name">Contact *</label>
                                    <input type="text" class="form-control" name="contact" placeholder="+223 77 89 56 32" value="{{ old('contact') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="content">Votre message *</label>
                                <textarea class="form-control" name="content" placeholder="Votre message" value="{{ old('content') }}" required></textarea>
                            </div>
                            <button class="btn btn-filled btn-round ml-auto"><span class="bh"></span> <span>Envoyer</span></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3">
                    <aside class="sidebar">
                        <div class="widget buy-course">
                            <p class="price"><strong>{{$cour->mode->slug == 'cours-video' ? number_format($cour->prix, 0, ',', ' ') : number_format(5000, 0, ',', ' ')}} F CFA</strong></p>
                            <span class="discount-price"> {{$cour->duree}}&nbsp; <i class="ti-timer"></i></span>
                            <a href="{{$cour->achatCour()}}" style="cursor:pointer; color:#fff;" class="btn btn-filled">
                                {{$cour->mode->slug != 'cours-video' ? 'Reserver' : 'Achetez'}} 
                            </a>
                        </div>
                       @if($cour->mode->slug != 'cours-video')
                            <div class="widget instractors">
                                <figure>
                                    <img src="{{asset('front-end/images/formateur.png')}}" alt="" class="avatar-md btn-round">
                                </figure>
                                <h4>{{$cour->enseignant->name}}</h4>
                                <span>Formateur</span>
                                <!-- <span class="total-courses"><i class="ti-user"></i> 09 Courses</span> 
                                <div class="socials">
                                    <a href="#" class="facebook"><i class="ti-facebook"></i></a>
                                    <a href="#" class="twitter"><i class="ti-twitter-alt"></i></a>
                                    <a href="#" class="linkedin"><i class="ti-linkedin"></i></a>
                                    <a href="#" class="youtube"><i class="ti-youtube"></i></a>
                                </div>-->
                            </div>
                        @endif    
                        <div class="widget recent-courses">
                            <h3 class="widget-title">Cours similaires</h3>
                            <ul>
                                @foreach ($cours_simmilaires as $cours)
                                    <li>
                                        <div class="single-course mb-0">
                                            <figure class="course-thumb">
                                                <img src="{{asset($cours->image_descriptive)}}" alt="">
                                                <strong class="ribbon">{{number_format($cours->prix, 0, ',', ' ')}} F CFA</strong>
                                            </figure>
                                            <div class="course-content">
                                                <h3><a href="{{$cours->link()}}">{{$cours->libelle_cours}}</a></h3>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- Courses Details section end -->
@endsection
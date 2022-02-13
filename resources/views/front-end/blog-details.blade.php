@extends('layouts.site')
@section('content')
    <!-- Page feature start -->
    <section class="page-feature py-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-6">
                    <h2 class=" text-left">D&eacute;tails blogs </h2>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumb text-right">
                        <a href="{{route('web.index')}}"><i class="ti-home"></i> Accueil</a>
                        <a href="{{route('web.blogs')}}">/ Blogs</a>
                        <span>/ D&eacute;tails Blogs </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page feature end -->

    <!-- Blog Posts section start -->
    <section class="blog-posts">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-blog-post">
                        <figure class="feature-img">
                            <img src="{{asset($blog->image_detail)}}" alt="">
                        </figure>
                        <div class="entry-content">
                            <div class="meta-tags">
                                <a class="post-meta">
                                    <i class="ti-time"></i> {{ date('d-m-Y',strtotime($blog->date_event)) }}
                                </a>
                                <a class="post-meta">
                                    <i class="ti-package"></i> {{$categorie->libelle_categorie}}
                                    <a class="post-meta">
                                        <i class="ti-comments"></i>{{$commentaires->count() > 1 ?  $commentaires->count().' Commentaires' :  $commentaires->count().' Commentaire'}}
                                    </a>
                                </a>
                            </div>
                            <h3>{{$blog->titre_blog}}</h3>
                            <p>{!!$blog->content!!}</p>
                        </div>
                    </div>
                    <div class="comments">
                        <h4 class="comment-title">
                            {{$commentaires->count() > 1 ?  $commentaires->count().' Commentaires' :  $commentaires->count().' Commentaire'}}
                        </h4>
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
                            <input type="hidden" value="{{$blog->id}}" name="blog_id">
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
                <div class="col-lg-4">
                    <aside class="sidebar">
                        <div class="widget recent-posts">
                            <h3 class="widget-title">Posts recents</h3>
                            <ul>
                                @foreach ($blogs as $blog)
                                    <li>
                                        <a href="{{$blog->link()}}">
                                            <img src="{{asset($blog->image)}}" alt="">
                                            <h5>{{Str::limit($blog->titre_blog, 30, '...')}}</h5>
                                            <div class="meta-tags">
                                                <span class="post-meta category"> {{$blog->categorie->libelle_categorie}}
                                                </span> | <span class="post-meta date"> {{ date('d-m-Y',strtotime($blog->date_event)) }}</span>
                                            </div>
                                        </a>
                                    </li>
                               @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Posts section end -->
@endsection
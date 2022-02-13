@extends('layouts.site')
@section('content')
    <!-- Page feature start -->
    <section class="page-feature py-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-6">
                    <h2 class=" text-left">Blogs</h2>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumb text-right">
                        <a href="{{route('web.index')}}">
                            <i class="ti-home"></i> Accueil
                        </a>
                        <span>/ Blogs</span>
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
                <div class="col-lg-12">
                    <div class="row">
                        @foreach ($blogs as $blog)
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
                    <div class="row">
                        <div class="col">
                            <div class="pagination">
                                {{ $blogs->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Posts section end -->
@endsection
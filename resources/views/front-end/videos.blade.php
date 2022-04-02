@extends('layouts.site')
@section('content')
    <!-- Page feature start -->
    <section class="page-feature pt-4">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-6">
                    <h2 class=" text-left">Galerie</h2>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumb text-right">
                        <a href="{{route('web.index')}}">
                            <i class="ti-home"></i> Accueil
                        </a>
                        <span>/ Galeries vid&eacute;os</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page feature end -->
    <!-- Yachts section start -->
    <section class="yachts pt-10">
        <div class="container">
            <div class="row">
                @foreach ($videos as $video)
                <div class="col-lg-4 col-md-6 mt-4">
                    <figure style="border: thick double #000000;">
                        <video src="{{asset($video->video)}}" controls class="rounded" style="width: 100%;" height="300"> 
                        </video>
                    </figure>
                    <h3 class="text-black mt-2">{{$video->titre}}</h3>
                </div>
                @endforeach
            </div>
          
            <div class="pagination mt-0">
                {{ $videos->links('vendor.pagination.custom') }}
            </div>
        </div>
    </section>
    <!-- Yachts section end -->
@endsection 
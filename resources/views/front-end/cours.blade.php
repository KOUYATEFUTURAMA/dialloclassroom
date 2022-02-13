@extends('layouts.site')
@section('content')
    <!-- Page feature start -->
    <section class="page-feature pt-4">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-6">
                    <h2 class=" text-left">Cours</h2>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumb text-right">
                        <a href="{{route('web.index')}}">
                            <i class="ti-home"></i> Accueil
                        </a>
                        <span>/ Cours</span>
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
                @foreach ($cours as $cour)
                
                <div class="col-lg-4 col-md-6">
                    <div class="single-course">
                        <figure class="course-thumb">
                            <img src="{{asset($cour->image_descriptive)}}" alt="">
                            <div class="info-area">
                                <ul>
                                </ul>
                            </div>
                            <div class="meta-area">
                                <ul>
                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="{{$cour->mode->slug != 'cours-video' ? 'Reservez' : 'Achetez'}}"><i class="ti-heart"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </figure>
                        <div class="course-content">
                            <h3><a href="{{$cour->link()}}">{{Str::limit($cour->libelle_cours, 50, '...')}}</a></h3>
                            <hr class="my-2">
                            <dl class="row m-0">
                                <dt class="product-item-part col-xs-5">Dur&eacute;e</dt>
                                <dd class="col-xs-7">{{$cour->duree}} H</dd>
                                <dt class="product-item-part col-xs-5">Prix</dt>
                                <dd class="col-xs-7">
                                    {{number_format($cour->prix, 0, ',', ' ')}} F CFA </dd>
                                <dt class="product-item-part col-xs-5">Place disponible</dt>
                                <dd class="col-xs-7">
                                    {{$cour->nombre_place}}
                                </dd>
                                <dt class="product-item-part col-xs-5">Date</dt>
                                <dd class="col-xs-7">{{ date('d-m-Y',strtotime($cour->date_cours)) }}</dd>
                                <dt class="product-item-part col-xs-5">Type</dt>
                                <dd class="col-xs-7">{{ $cour->mode->libelle_mode }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                @endforeach
               
            </div>
          
            <div class="pagination mt-0">
                {{ $cours->links('vendor.pagination.custom') }}
            </div>
        </div>
    </section>
    <!-- Yachts section end -->
@endsection
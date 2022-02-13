@extends('layouts.site')
@section('content')
    <!-- Page feature start -->
    <section class="page-feature py-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-6">
                    <h2 class=" text-left">Nous contacter</h2>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumb text-right">
                        <a href="{{route('web.index')}}">
                            <i class="ti-home"></i> Accueil
                        </a>
                        <span>/ Contact</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page feature end -->

    <!-- Contact section start -->
    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-9 m-auto text-center">
                    <div class="sec-heading">
                        <h3 class="sec-title">
                            @if(session()->has('message'))
                                <span style="color: green;">
                                    {{session()->get('message')}}
                                </span>
                            @else
                                Si vous avez une question, laissez nous un message.
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <form action="{{route('message.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-6">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="name">Nom *</label>
                                <input type="text" value="{{ old('name') }}" class="form-control" name="name" placeholder="Nom & prénom(s)" required>
                            </div>
                            <div class="form-group col-sm-6">
                                @error('sujet')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="sujet">Sujet *</label>
                                <input type="text" value="{{ old('sujet') }}" class="form-control" name="sujet" placeholder="Sujet de votre message" required>
                            </div>
                            <div class="form-group col-sm-6">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="email">E-mail *</label>
                                <input type="email" value="{{ old('email') }}" class="form-control" name="email" placeholder="Addresse mail " required>
                            </div>
                            <div class="form-group col-sm-6">
                                @error('contact')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="contact">Contact *</label>
                                <input type="text" value="{{ old('contact') }}" class="form-control" name="contact" placeholder="Numéro de téléphone" required>
                            </div>
                        </div>
                        <div class="form-group">
                            @error('message')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="message">Votre message *</label>
                            <textarea class="form-control" value="{{ old('message') }}" name="message" placeholder="Votre message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Envoyer</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <aside class="sidebar">
                        <div class="widget contact-info">
                            <h3 class="widget-title">Informations de contact</h3>
                            <div>
                                <h6>Emplacement</h6>
                                <span>
                                    Hamdallaye ACI 2000 à 100m du Boulangerie Badjelika, Bamako, Mali.
                                </span>
                            </div>
                            <div>
                                <h6>Contacts & WathsApp</h6>
                                <a href="tel:+22376001134">+223 76 00 11 34</a>
                            </div>
                            <div>
                                <h6>E-mail</h6>
                                <a href="contact@dialloclassroom.com">
                                    contact@dialloclassroom.com
                                </a>
                            </div>
                            <div>
                                Startup de Formation, Diallo Classroom est un Cabinet de renforcement de compétences dans le domaine du BTP.
                                Un Cabinet d'Orientation; de Formation et de prestations sur les Logiciels de BTP. 
                                <br/>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact section end -->
@endsection 
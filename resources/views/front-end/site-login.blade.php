@extends('layouts.site')
@section('content')
    <!-- Login / Registration start -->
    <section class="banner login-registration">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="content-box">
                        <h2>Connexion</h2>
                    </div>
                    <form action="#" class="sl-form">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" placeholder="Votre adresse mail de connexion" required>
                        </div>
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input type="password" placeholder="Votre mot de passe" required>
                        </div>
                        <button class="btn btn-filled btn-round"><span class="bh"></span> <span>Connexion</span></button>
                        <p class="notice">Vous n'avez pas de compte ? <a href="{{route('web.site-register')}}">Inscrivez vous</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Login / Registration end -->
@endsection
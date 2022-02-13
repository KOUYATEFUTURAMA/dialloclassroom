@extends('layouts.site')
@section('content')
    <!-- Login / Registration start -->
    <section class="banner login-registration">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="content-box">
                        <h2>Cr&eacute;er un compte</h2>
                    </div>
                    <form action="#" class="sl-form">
                        <div class="form-group">
                            <label>Nom complet *</label>
                            <input type="text" placeholder="Nom et prénom(s)" required>
                        </div>
                        <div class="form-group">
                            <label>E-mail *</label>
                            <input type="email" placeholder="Votre adresse email" required>
                        </div>
                        <div class="form-group">
                            <label>Contact *</label>
                            <input type="text" placeholder="Contact téléphonique" required>
                        </div>
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input type="password" placeholder="Votre mot de passe" required>
                        </div>
                        <div class="form-group">
                            <label>R&eacute;p&eacute;t&eacute; le mot de passe</label>
                            <input type="password" placeholder="Répété le mot de passe" required>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                            <label class="form-check-label">
                                Accepter <a href="#">les termes et conditions</a>
                            </label>
                        </div>
                        <button class="btn btn-filled btn-round">Inscrivez-vous</button>
                        <p class="notice">Vous avez d&eacute;j&agrave; un compte ? <a href="{{route('web.site-login')}}">Connectez vous</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Login / Registration end -->
@endsection
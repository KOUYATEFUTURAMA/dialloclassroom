@extends('layouts.site')
@section('content')
        <!-- Page feature start -->
        <section class="page-feature py-5">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class=" text-left">Apropos de nous</h2>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb text-right">
                            <a href="{{route('web.index')}}">
                                <i class="ti-home"></i> Accueil
                            </a>
                            <span>/ Apropos de nous</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Page feature end -->

        <!-- About section start -->
        <section class="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 m-auto text-center">
                        <div class="sec-heading">
                            <h3 class="sec-title">
                                D-classroom
                            </h3>
                            <p>
                                D-Classroom est un cabinet de renforcement de comp&eacute;tences dans le domaine du BTP. Un cabinet d'orientation, de formation et de prestations sur les logiciels de BTP ( B&acirc;timent Travaux Public).
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="entry-content">
                            <img src="{{asset('front-end/images/team/1.jpeg')}}" alt="">
                            <br/>
                            <img src="{{asset('front-end/images/team/2.jpeg')}}" alt="">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="entry-content">
                            <h3>Youssouf DIALLO fondateur de D-Classroom</h3>
                            <p>
                                Je suis Youssouf DIALLO Ing&eacute;nieur G&eacute;nie Civil, fondateur du cabinet D-Classroom et formateur sur les Logiciels de BTP ( B&acirc;timent et Travaux Publics). J’ai su d&eacute;velopper mes comp&eacute;tences en pleine autonomie mais aussi en &eacute;quipe. 
                                <br/>
                                J’ai une ma&icirc;trise des techniques de l’ing&eacute;nierie G&eacute;nie Civil que je mettrai &agrave; profit dans : 
                                <ul style="list-style-type:disc; margin-left: 5%; ">
                                    <li>
                                        La pr&eacute;paration des dossiers d’appels d’offres (DAO);
                                    </li>
                                    <li>
                                        La bonne gestion de vos projets de d&eacute;veloppement dans le domaine des infrastructures;
                                    </li>
                                    <li>
                                        La validation des dossiers d’ex&eacute;cution, suivi, le pilotage et la coordination des travaux d’infrastructures de G&eacute;nie Civil;
                                    </li>
                                    <li>
                                        La mise en œuvre de vos programmes &agrave; travers la planification, l’ex&eacute;cution et l’&eacute;valuation des activit&eacute;s;
                                    </li>
                                    <li>
                                        Le renforcement des capacit&eacute;s des collaborateurs et d’autres partenaires;
                                    </li>
                                    <li>
                                        La r&eacute;ception provisoire des travaux.;
                                    </li>
                                </ul>
                                <br/><br/>
                                Toujours « Orient&eacute; R&eacute;sultat », je mettrai tout en œuvre pour la r&eacute;ussite de mes mission dans le respect des contraintes de co&ucirc;t, de d&eacute;lai et de qualit&eacute; exig&eacute;e gr&acirc;ce &agrave; : 
                                <ul style="list-style-type:disc; margin-left: 5%; ">
                                    <li>
                                        Ma bonne connaissance des logiciels CAO/DAO ( Autocad, Archicad, Revit, Covadis…..), des logiciels de calcul de structure ( Cype, Robot Structural Analysis Professionnal, Aliz&eacute; LCPC ….) et des logiciels de gestion de projet ( MS-Project, Primavera);
                                    </li>
                                    <li>
                                        Mon aptitude &agrave; analyser et r&eacute;soudre des probl&egrave;mes, &agrave; prendre des d&eacute;cisions et des initiatives;
                                    </li>
                                    <li>
                                        Ma grand capacit&eacute; organisationnelle et m&eacute;thodologique;
                                    </li>
                                    <li>
                                        Ma capacit&eacute; &agrave; &eacute;laborer des termes de r&eacute;f&eacute;rences, cahiers des charges, contrats et autres documents utiles dans une intervention de d&eacute;veloppement; 
                                    </li>
                                    <li>
                                        Ma capacit&eacute; &agrave; &ecirc;tre autonome et d’adaptation &agrave; mon nouveau poste.  
                                    </li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About section end -->

        <section class="team-esection bg-offwhite">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-9 m-auto text-center">
                        <div class="sec-heading">
                            <h3 class="sec-title">
                                Notre &eacute;quipe
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="widget instractors">
                            <figure>
                                <img src="{{asset('front-end/images/team/3.jpeg')}}" alt="" class="avatar-lg">
                            </figure>
                            <div class="team-bio">
                                <h4>Alhousseyni SAMAKE</h4>
                                <span>Directeur Multim&eacute;dia</span>
                                <!-- <span class="total-courses"><i class="ti-user"></i> 09 Courses</span> -->
                                <div class="socials">
                                    <a href="#" class="facebook"><i class="ti-facebook"></i></a>
                                    <a href="#" class="twitter"><i class="ti-twitter-alt"></i></a>
                                    <a href="#" class="linkedin"><i class="ti-linkedin"></i></a>
                                    <a href="#" class="youtube"><i class="ti-youtube"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget instractors">
                            <figure>
                                <img src="{{asset('front-end/images/team/4.jpeg')}}" alt="" class="avatar-lg">
                            </figure>
                            <div class="team-bio">
                                <h4>Kadidiatou KEÏTA</h4>
                                <span>Comptable</span>
                                <!-- <span class="total-courses"><i class="ti-user"></i> 09 Courses</span> -->
                                <div class="socials">
                                    <a href="#" class="facebook"><i class="ti-facebook"></i></a>
                                    <a href="#" class="twitter"><i class="ti-twitter-alt"></i></a>
                                    <a href="#" class="linkedin"><i class="ti-linkedin"></i></a>
                                    <a href="#" class="youtube"><i class="ti-youtube"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget instractors">
                            <figure>
                                <img src="{{asset('front-end/images/team/5.jpeg')}}" alt="" class="avatar-lg">
                            </figure>
                            <div class="team-bio">
                                <h4>Adam CISSOUMA</h4>
                                <span>Secrétaire </span>
                                <!-- <span class="total-courses"><i class="ti-user"></i> 09 Courses</span> -->
                                <div class="socials">
                                    <a href="#" class="facebook"><i class="ti-facebook"></i></a>
                                    <a href="#" class="twitter"><i class="ti-twitter-alt"></i></a>
                                    <a href="#" class="linkedin"><i class="ti-linkedin"></i></a>
                                    <a href="#" class="youtube"><i class="ti-youtube"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3">
                            <div class="widget instractors">
                                <figure>
                                    <img src="{{asset('front-end/images/team/6.jpeg')}}" alt="" class="avatar-lg">
                                </figure>
                                <div class="team-bio">
                                    <h4>Abdoulaye SAMAKÉ</h4>
                                    <span>Assistant DG</span>
                                    <!-- <span class="total-courses"><i class="ti-user"></i> 09 Courses</span> -->
                                    <div class="socials">
                                        <a href="#" class="facebook"><i class="ti-facebook"></i></a>
                                        <a href="#" class="twitter"><i class="ti-twitter-alt"></i></a>
                                        <a href="#" class="linkedin"><i class="ti-linkedin"></i></a>
                                        <a href="#" class="youtube"><i class="ti-youtube"></i></a>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                </div>
            </div>
        </section>

        <!-- Certification section start -->
        <section class="certification">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-9 m-auto text-center">
                        <div class="sec-heading">
                            <h3 class="sec-title">Nos partenaires</h3>
                        </div>
                    </div>
                </div>
                <div class="partners-caro owl-carousel">
                    <a href="#"><img src="{{asset('front-end/images/partners/1.png')}}" alt=""></a>
                    <a href="#"><img src="{{asset('front-end/images/partners/2.png')}}" alt=""></a>
                    <a href="#"><img src="{{asset('front-end/images/partners/3.png')}}" alt=""></a>
                    <a href="#"><img src="{{asset('front-end/images/partners/4.png')}}" alt=""></a>
                </div>
            </div>
        </section>
        <!-- Certification section end -->
@endsection      
@extends('layouts.front.home')

@section('content')
    <!--container start-->
    <div class="container">
        <div class="row">
            <!--feature start-->
            <div class="text-center feature-head">
                <h1>Entrez en relation avec vos futurs clients !</h1>
                <p>
                    Notre savoir-faire nous permet d’élaborer une stratégie de conquête clients à partir des leviers de communications performants actuels.
                </p>
            </div>
            <div class="col-lg-4 col-sm-4">
                <section>
                    <div class="f-box active">
                        <i class=" fa fa-desktop"></i>
                        <h2>Prospects qualifiés</h2>
                    </div>
                    <p class="f-text">
                        Tout nos prospects sont vérifiés personnellement afin de qualifier les informations.
                    </p>
                </section>
            </div>
            <div class="col-lg-4 col-sm-4">
                <section>
                    <div class="f-box active2">
                        <i class=" fa fa-code"></i>
                        <h2>Prospects ciblés</h2>
                    </div>
                    <p class="f-text">
                        Notre formulaire vous permettra de choisir des prospects ciblés en fonction de vos critères de recherche.</p>
                </section>
            </div>
            <div class="col-lg-4 col-sm-4">
                <section>
                    <div class="f-box active">
                        <i class="fa fa-gears"></i>
                        <h2>Base de données à jour</h2>
                    </div>
                    <p class="f-text">
                        Nous mettons quotidiennement à jour nos bases de données afin de vous garantir des prospects récents.                    </p>
                </section>
            </div>
            <!--feature end-->
        </div>

    </div>


    <!--property start-->
    <div class="property gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6 text-center">
                    <img src="{{asset('front/img/property-img.png')}}" alt="">
                </div>
                <div class="col-lg-6 col-sm-6">
                    <h1>N’ayez plus de freins !</h1>
                    <hr>
                    <h3>Vous êtes un professionnel à la recherche de prospects qualifiés exclusifs ?</h3>
                    <ul style="margin-left: 30px;">
                        <li>Nous vous proposons de trouver de nouveaux clients correspondant à vos critères de recherche.</li>
                        <li>Vos contacts seront qualifiés et seront dans l'attente des réponses que vous pourrez leur apporter.</li>
                        <li>Notre travail est de vous faire rencontrer ces prospects et donc d'augmenter de ce fait vos ventes et transformations.</li>
                    </ul>
                    <a href="/register"  class="btn btn-purchase">Commencer maintenant</a>
                </div>
            </div>
        </div>
    </div>
    <!--property end-->

    <div class="container">



        <div class="container">
            <div class="row">
                <div class="row">
                    <div class="text-center feature-head">
                        <h1> Notre catalogue de prospects </h1>
                        <p>Aenean nibh ante, lacinia non tincidunt nec, lobortis ut tellus. Sed in porta diam.</p>
                    </div>
                    <div class="services">
                        <div class="col-lg-6 col-sm-6">
                            <div class="icon-wrap ico-bg round">
                                <i class="fa fa fa-car"></i>
                            </div>

                            <div class="content">
                                <h3 class="title">Auto</h3>
                                <p>Suspendisse dignissim in sem eget pulvinar. Mauris aliquam nulla at libero pretium, eu tincidunt nulla molestie pulvinar posuere.</p>
                            </div>

                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="icon-wrap ico-bg round">
                                <i class="fa fa fa-home"></i>
                            </div>
                            <div class="content">
                                <h3 class="title">Habitation</h3>
                                <p>Suspendisse dignissim in sem eget pulvinar. Mauris aliquam nulla at libero pretium, eu tincidunt nulla molestie pulvinar posuere.</p>
                            </div>
                        </div>
                    </div>
                    <div class="services">
                        <div class="col-lg-6 col-sm-6">
                            <div class="icon-wrap ico-bg round">
                                <i class="fa fa fa-medkit"></i>
                            </div>
                            <div class="content">
                                <h3 class="title">Santé / Vie</h3>
                                <p>Suspendisse dignissim in sem eget pulvinar. Mauris aliquam nulla at libero pretium, eu tincidunt nulla molestie pulvinar posuere.</p>
                            </div>


                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="icon-wrap ico-bg round">
                                <i class="fa fa-motorcycle"></i>
                            </div>
                            <div class="content">
                                <h3 class="title">Moto</h3>
                                <p>Suspendisse dignissim in sem eget pulvinar. Mauris aliquam nulla at libero pretium, eu tincidunt nulla molestie pulvinar posuere.</p>
                            </div>
                        </div>
                    </div>
                    <div class="services">
                        <div class="col-lg-6 col-sm-6">
                            <div class="icon-wrap ico-bg round">
                                <i class="fa fa fa-paw"></i>
                            </div>
                            <div class="content">
                                <h3 class="title">Animaux</h3>
                                <p>Suspendisse dignissim in sem eget pulvinar. Mauris aliquam nulla at libero pretium, eu tincidunt nulla molestie pulvinar posuere.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="icon-wrap ico-bg round">
                                <i class="fa fa fa-umbrella"></i>
                            </div>
                            <div class="content">
                                <h3 class="title">Obsèques / Décès</h3>
                                <p>Suspendisse dignissim in sem eget pulvinar. Mauris aliquam nulla at libero pretium, eu tincidunt nulla molestie pulvinar posuere.</p>
                            </div>
                        </div>
                    </div>
                    <div class="services">
                        <div class="col-lg-6 col-sm-6">
                            <div class="icon-wrap ico-bg round">
                                <i class="fa fa fa-blind"></i>
                            </div>
                            <div class="content">
                                <h3 class="title">Dépendance</h3>
                                <p>Suspendisse dignissim in sem eget pulvinar. Mauris aliquam nulla at libero pretium, eu tincidunt nulla molestie pulvinar posuere.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="icon-wrap ico-bg round">
                                <i class="fa fa fa-briefcase"></i>
                            </div>
                            <div class="content">
                                <h3 class="title">Professionnel</h3>
                                <p>Suspendisse dignissim in sem eget pulvinar. Mauris aliquam nulla at libero pretium, eu tincidunt nulla molestie pulvinar posuere.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--parallax start-->
    <section class="parallax1">
        <div class="container">
            <div class="row">
                <div class="top"></div>
                <hr>
                <h1>
                    Gérez vos campagnes et maitrisez votre budget, un ciblage précis et pertinent!<br>
                    Recevez des prospects qualifiés en quelques clics
                   </h1>
                <hr>
                <p>LEADS ASSURANCE – VOS PROSPECTS CIBLÉS</p>
            </div>
        </div>
    </section>
    <!--parallax end-->

    <div class="container">
        <!--clients start-->
        <div class="clients">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <ul class="list-unstyled">
                            <li><a href="#"><img src="{{asset('front/img/clients/logo1.png')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{asset('front/img/clients/logo2.png')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{asset('front/img/clients/logo3.png')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{asset('front/img/clients/logo4.png')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{asset('front/img/clients/logo5.png')}}" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--clients end-->
    </div>

    <!--container end-->
@endsection

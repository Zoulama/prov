@extends('layouts.back.master')

@section('content')

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">
            <div class="row">
                <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-home"></i>Accueil</a></li>
                        <li><a href="#">Credits</a></li>
                        <li class="active">Achat de credits</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
            <div class="row">
            <div class="main col-md-12">

              <!-- page-title start -->
              <!-- ================ -->
              
              <div class="separator-2"></div>
              <!-- page-title end -->
                <div class="container">
                    <h2 class="text-center"><strong>Achats de</strong> Credits</h2>                    <!-- pricing tables start -->
                    <!-- ================ -->
                    <div class="pricing-tables circle-head object-non-visible" data-animation-effect="fadeInUpSmall"  data-effect-delay="0">
                        <div class="row grid-space-10">
                        @foreach($DataPackCredits as $values)
                            <div class="col-sm-3">
                                <!-- pricing table start -->
                                <!-- ================ -->
                                <div class="plan shadow light-gray-bg bordered">
                                    <div class="header dark-bg" style="background-color: #ff6c60;color: #fff;">
                                        <h3>{{$values['label']}}</h3>
                                        <br><br><br>
                                        <div class="price" style="background-color: #2a3542;">
                                            <span>
                                                {{$values['price']}} &euro;
                                            </span>
                                        </div>

                                    </div>
                                    <br><br><br>
                                    <ul class="shadow light-gray-bg">
                                        <li><b>{{$values['credit_offer']}} credits offert</b></li>
                                        <li>
                                            <a href="{{route('Credit.Pay',$values['id'])}}" class="btn btn-dark btn-animated radius-50">
                                                Acheter ce pack
                                                <i class="fa fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- pricing table end -->
                            </div>
                        @endforeach
                   
                        </div>
                    </div>
                    <!-- pricing tables end -->
                </div>
                
            </section>
            </div>
            </div>
            <!-- page end-->
        
    </section>
    <!--main content end-->

@endsection

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
                        <li class="active">Achat de Pack credits</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
            <div class="row">
                <section class="panel">
                          <header class="panel-heading">
                              Vous avez selectionner le &nbsp;{{$PackCredit->label}}
                          </header>
                          <div class="panel-body">
                                <div class="panel-body text-center">
                                    <h4>
                                         {{$PackCredit->nb_credit}}&nbsp; credits  &nbsp; avec {{$PackCredit->credit_offer}} credits &nbsp; offerts.
                                    </h4>
                                    <p class="price">{{$PackCredit->price}} &euro;</p> 
                                </div>
                          </div>
                          <div class="panel-body">
                              <a href="{{route('Payment.Credit',$PackCredit->price)}}" class="btn btn-success btn-lg btn-block">Je passe à la caiss</a>
                          </div>
                      </section>
            </div>
            </section>
            
            <!-- page end-->
        
    </section>
    <!--main content end-->

@endsection

@extends('layouts.back.master')

@section('content')

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">

            <div class="row">
                <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-home"></i> Accueil</a></li>
                         <li><a href="#">Credits</a></li>
                        <li class="active">Mes achats de credits</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
            <!-- page start-->
            <div class="row">
                <div class="col-sm-12">
              <section class="panel">
              <header class="panel-heading">
                 Historique des credits achetés 
              </header>
              <div class="panel-body">
              <div class="adv-table">
              <!--<table class="display table table-bordered" id="hidden-table-info">-->
              <table  class="display table table-bordered table-striped" id="">
              <thead>
              <tr>
                <th>Pack</th>
                <th>Nombre de credits</th>
                <th>Credit offert</th>
                <th>Montant</th>
                <th>Date achat</th>
                <th>Facture</th>
              </tr>
              </thead>
              <tbody>
                @if(isset($achats_credits))
                    @foreach($achats_credits as $value)
                        <tr class="gradeX">
                            <td style="color:blue;">{{$value['pack']}}</td>
                            <td>{{$value['nb_credit']}}</td>
                            <td>{{$value['credit_offer']}}</td>
                            <td>{{$value['montant']}} &euro;</td>
                            <td>{{$value['date_achat']}}</td>
                            <td>
                              <div class='text-right'>
                                    <a class="btn btn-primary" href="{{route('Invoice.PackCredit',$value['id'])}}">
                                        <i class='icon-download'></i>
                                        Télécharger
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
              </tbody>
              </table>

              </div>
              </div>
              </section>
              </div>
              </div>
            <!-- page end-->
        </section>
    </section>
    <!--main content end-->

@endsection

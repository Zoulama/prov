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
                        <li><a href="#">Prospects</a></li>
                        <li class="active">Achats de prospect</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>


            <!-- page start-->
            <div class="row">
                <div class="col-sm-12">
              <section class="panel">
              <header class="panel-heading">
                 Historique des Prospects achetés 
              </header>
               @if(Session::has('pay_sucess'))
                           <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="success">&times;</button>
                              <strong> {{Session::get('pay_sucess')}}</strong> 
                           </div>
                @endif
              <div class="panel-body">
              <div class="adv-table">
              <!--<table class="display table table-bordered" id="hidden-table-info">-->
              <table  class="display table table-bordered table-striped" id="">
              <thead>
              <tr>
                <th>#</th>
                <th>Date achat</th>
                <th>Facture</th>
                <th>Prospects</th>
              </tr>
              </thead>
              <tbody>
                @if(isset($tabAchat))
                    @foreach($tabAchat as $value)
                        <tr class="gradeX">
                            <td>{{$value['count']}}</td>
                            <td style="color:blue;">{{$value['date_achat']}}</td>
                            <td>
                                <div class='text-right'>
                                    <a class="btn btn-primary" href="{{route('Download',$value['key_F'])}}">
                                        <i class='icon-download'></i>
                                        Facture à télécharger
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class='text-right'>
                                    <a class="btn btn-primary" href="{{route('Download',$value['key_P'])}}">
                                        <i class='icon-download'></i>
                                         Prospect à télécharger
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

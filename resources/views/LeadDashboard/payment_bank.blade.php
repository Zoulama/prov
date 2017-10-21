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
                            paiement
                          </header>
                          <div class="panel-body">
                               <form method="POST" action="{{$payboxdata['SERVEUR']}}">
                                <input type="hidden" name="PBX_SITE" value="{{$payboxdata['PBX_SITE']}}">
                                <input type="hidden" name="PBX_RANG" value="{{$payboxdata['PBX_RANG']}}">
                                <input type="hidden" name="PBX_IDENTIFIANT" value="{{$payboxdata['PBX_IDENTIFIANT']}}">
                                <input type="hidden" name="PBX_TOTAL" value="{{$payboxdata['PBX_TOTAL']}}">
                                <input type="hidden" name="PBX_DEVISE" value="{{$payboxdata['PBX_DEVISE']}}">
                                <input type="hidden" name="PBX_CMD" value="{{$payboxdata['PBX_CMD']}}">
                                <input type="hidden" name="PBX_PORTEUR" value="{{$payboxdata['PBX_PORTEUR']}}">
                                <input type="hidden" name="PBX_REPONDRE_A" value="{{$payboxdata['PBX_REPONDRE_A']}}">
                                <input type="hidden" name="PBX_RETOUR" value="{{$payboxdata['PBX_RETOUR']}}">
                                <input type="hidden" name="PBX_EFFECTUE" value="{{$payboxdata['PBX_EFFECTUE']}}">
                                <input type="hidden" name="PBX_ANNULE" value="{{$payboxdata['PBX_ANNULE']}}">
                                <input type="hidden" name="PBX_REFUSE" value="{{$payboxdata['PBX_REFUSE']}}">
                                <input type="hidden" name="PBX_HASH" value="{{$payboxdata['PBX_HASH']}}">
                                <input type="hidden" name="PBX_TIME" value="{{$payboxdata['PBX_TIME']}}">
                                <input type="hidden" name="PBX_HMAC" value="{{$payboxdata['PBX_HMAC']}}">

                                <input type="submit" class="btn btn-success btn-lg btn-block" value="Envoyer">

                            </form>
                              </div>

                </section>
            </div>
            </section>
            
            <!-- page end-->
        
    </section>
    <!--main content end-->

@endsection

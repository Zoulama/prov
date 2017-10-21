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
                        <li><a href="#">Paiement</a></li>
                        <li class="active">Paiement refusé</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
            <div class="row">
           <center><b><h2>Votre transaction a été refusé</h2></center></b><br>
           <br><b>MONTANT : </b>{{$montant}}
           <br><b>REFERENCE : </b>{{$ref_com}}
           <br><b>TRANS : </b>{{$trans}}
            </div>
            </section>
            
            <!-- page end-->
        
    </section>
    <!--main content end-->

@endsection

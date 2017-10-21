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
           <?php $count = Auth::user()->newThreadsCount(); ?>
            @if($count > 0)
            <span class="label label-danger">{{ $count }}</span>
            @endif
            </div>
            </section>
            
            <!-- page end-->
        
    </section>
    <!--main content end-->

@endsection

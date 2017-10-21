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
                        <li class="active">Tarifs</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>


            <!-- page start-->
            <div class="row">
                <div class="col-sm-12">
              <section class="panel">
              <header class="panel-heading">
                  Liste des tarifs applicables
              </header>
              <div class="panel-body">
              <div class="adv-table">
              <table class="display table table-bordered" id="hidden-table-info">
              <thead>
              <tr>
                  <th>Profil de prospect</th>
                  <th>Lead mutalisé</th>
                  <th>Lead exclusif</th>
              </tr>
              </thead>
              <tbody>
              @foreach($tarifs as $value)
              <tr class="gradeA">
                  <td style="color:blue;">{{$value['label']}}</td>
                  <td style="background-color: #41cac0">{{$value['mutualisee']}} &euro;</td>
                  <td style="background-color: #f1c500">{{$value['exclusive']}} &euro;</td>
              </tr>
             @endforeach
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

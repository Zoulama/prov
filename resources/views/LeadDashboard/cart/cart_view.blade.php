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
                        <li><a href="#">Salles des marchés</a></li>
                        <li class="active">Prospects potentiels</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>

            <!-- page start-->
            <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-12"> 
                @if(Session::has('pay_error'))
                           <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="danger">&times;</button>
                              <strong> {{Session::get('pay_error')}}</strong> 
                @endif
              <!-- page-title start -->
              <!-- ================ -->
              <h1 class="page-title">Votre panier</h1>
              <div class="separator-2"></div>
              <!-- page-title end -->
              @if(!empty($cartTab))
                  <table class="table cart table-hover table-colored">
                    <thead>
                      <tr>
                        <th>Type </th>
                        <th>Adresse </th>
                        <th>Formule </th>
                        <th>Date </th>
                        <th>Prix</th>
                        <th>Supprimer </th>
                        <!--<th class="amount">Total </th>-->
                      </tr>
                    </thead>
                    <tbody>
                    @if(!empty($cartTab))
                      @foreach($cartTab as $values)
                        <tr class="remove-data">
                          <td class="product"><a href="{{route('Prospect.show',array($values['type'],$values['id_p']))}}">{{$values['name_prospect']}}</a> <small>{{$values['name_prospect']}}.</small></td>
                          <td class="location">{{$values['locate_prospect']}}</td>
                          <td class="product">{{$values['formule_prospect']}}</td>
                          <td class="product">{{$values['date_prospect']}}</td>
                          <td class="price">{{$values['prix_prospect']}} &euro; </td>
                          <td class="remove">
                            <a href="{{route('Prospect.CartRemove',$values['id'])}}" class="btn btn-remove btn-sm btn-default">Supprimer
                          </a></td>
                        </tr>
                        
                      @endforeach
                      <tr>
                          <td class="total-quantity" colspan="4">{{Cart::count()}}</td>
                          <td class="total-amount">{{Cart::total()}} &euro;</td>
                        </tr>
                    @endif
                    </tbody>
                  </table>
                  <div class="text-right">  
                    <a href="{{route('Prospect.PayByCard')}}" class="btn btn-group btn-default">
                      <i class="icon-left-open-big"></i> Payez par carte
                    </a>
                    <a href="{{route('Prospect.PayByCredits')}}" class="btn btn-group btn-default">
                      <i class="icon-check"></i> Payez par credit
                    </a>
                  </div>
              @else
                <span>Votre panier est vide</span>
              @endif

            </div>
            <!-- main end -->

          </div>
            <!-- page end  -->
             
        </section>
    </section>
    <!--main content end-->

@endsection



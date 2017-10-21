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
                        <li class="active">Details prospect</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
            <!-- page start-->
            <section class="panel">
                  <header class="panel-heading">
                       Details Prospect
                      <span class="pull-right">
                          <button type="button" id="loading-btn" class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i>Rafraichir</button>
                      </span>
                  </header>
              </section>
                <div class="row">
                  <div class="col-md-8">
                      <section class="panel">
                        <header class="panel-heading">
                          <strong> INFORMATIONS DE LA DEMANDE </strong>
                        </header>
                        <div class="panel-body">
                            <table class="table table-hover p-table">
                          <thead>
                          <tr>
                              <th>Label</th>
                              <th>Informations</th>
                              <th>Status</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($ProspectInfo as $keys => $values)
                            @foreach($values as $key => $value)
                                  <tr>
                                      <td>
                                          {{$key}}
                                      </td>
                                      <td>
                                         {{$value}}
                                      </td>
                                      
                                      <td>
                                          <span class="label label-info">Completed</span>
                                      </td>
                                  </tr>
                              @endforeach
                          @endforeach
                          </tbody>
                          </table>
                        </div>
                      </section>

                      <section class="panel">
                          <div class="bio-graph-heading project-heading">
                              <strong> COORDONNÉES DU PROSPECT </strong>
                          </div>
                          <div class="panel-body bio-graph-info">
                              <!--<h1>New Dashboard BS3 </h1>-->
                              <div class="row p-details">
                                  <div class="bio-row">
                                      <p> <span class="bold">Civilité :</span>
                                       <span style="color: transparent;text-shadow: 0px 0px 10px #333;">
                                          {{str_repeat("#", strlen($data['Civi']))}}
                                       </span>
                                      </p>
                                  </div>
                                 
                                  <div class="bio-row">
                                      <p><span class="bold">Nom :</span>
                                        <span style="color: transparent;text-shadow: 0px 0px 10px #333;">
                                            {{str_repeat("#", strlen($data['prenom']))}}
                                         </span>
                                      </p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span class="bold">Prénom :</span>
                                          <span style="color: transparent;text-shadow: 0px 0px 10px #333;">
                                          {{str_repeat("#", strlen($data['prenom']))}}
                                       </span>
                                      </p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span class="bold">Code postal :</span>
                                          <span style="color: transparent;text-shadow: 0px 0px 10px #333;">
                                          {{str_repeat("#", strlen($data['postalPark']))}}
                                       </span>
                                      </p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span class="bold">Ville :</span>
                                          <span style="color: transparent;text-shadow: 0px 0px 10px #333;">
                                          {{str_repeat("#", strlen($data['Ville']))}}
                                       </span>
                                      </p>
                                  </div>

                                  <div class="bio-row">
                                      <p><span class="bold">Adresse e-mail:</span>
                                          <span style="color: transparent;text-shadow: 0px 0px 10px #333;">
                                          {{str_repeat("#", strlen($data['eMail']))}}
                                       </span>
                                      </p>
                                  </div>

                                  <div class="bio-row">
                                      <p><span class="bold">Téléphone fixe:</span>
                                          <span style="color: transparent;text-shadow: 0px 0px 10px #333;">
                                          {{str_repeat("#", strlen($data['Tele']))}}
                                       </span>
                                      </p>
                                  </div>
                                  
                              </div>

                          </div>

                      </section>

                  </div>
                  <div class="col-md-4">
                      <section class="panel">
                          <header class="panel-heading">
                              SAISISSEZ CETTE OPPORTUNITÉ !
                          </header>
                          <div class="panel-body">
                              
                              <div class="text-center mtop20">
                                  <a href="#" class="btn btn-sm btn-primary">
                                  <i class="fa fa-cart-plus"></i>
                                  FORMULE MUTUALISEE
                                  </a>
                                  <a href="#" class="btn btn-sm btn-warning">
                                  <i class="fa fa-cart-plus"></i>
                                  FORMULE EXCLUSIVE
                                  </a>
                              </div>
                          </div>
                      </section>


                  </div>
                    <div class="col-md-4">
                      <section class="panel">
                          <header class="panel-heading">

                             <strong> LOCALISATION DU LA DEMANDE</strong>
                              <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-remove"></a>
                            </span>
                          </header>
                          <div class="panel-body">
                              <div id="gmap_marker" class="gmaps"></div>
                          </div>
                      </section>
                  </div>
              </div>
            <!-- page end-->
        </section>
    </section>
    <!--main content end-->
    
    
@endsection

@section('script_js')
<script type="text/javascript">
var mapOptions = {
                zoom:13,
                center: new google.maps.LatLng({{$coord['lat']}},{{$coord['lng']}})
            }
            var map = new google.maps.Map(document.getElementById("gmap_marker"), mapOptions);

                var marker{{Auth::user()->id}} = new google.maps.Marker({
                    position: new google.maps.LatLng({{$coord['lat']}},{{$coord['lng']}}),
                    map: map,
                    title: "{{$coord['titre']}}",
                });
</script>
@endsection




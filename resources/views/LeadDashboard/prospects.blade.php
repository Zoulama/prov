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
        <div class="col-sm-12">
        <section class="panel">
          <header class="panel-heading">
              {{$nbProspect}} PROSPECTS POTENTIELS
          </header>
          <div class="panel-body">
          <div class="adv-table">
          <!--<table class="display table table-bordered" id="hidden-table-info">-->
          <table  class="display table table-bordered table-striped" id="dynamic-table">
          <thead>
          <tr>
              <th>Ref</th>
              <th>Date</th>
              <th>Type lead</th>
              <th>Profil de prospect</th>
              <th>CP</th>
              <th>Ville</th>
              <th colspan="2">Lead mutalisé</th>
              <th colspan="2">Lead exclusif</th>
              <th>Voir</th>
          </tr>
          </thead>
          <tbody>
            @foreach($allProspect as $value)
            <tr class="gradeX">
                <td>{{$value['ref']}}</td>
                <td id='date_prospect'>{{$value['date']}}</td>
                <td style="color:blue;" id ='title_act'>{{$value['title_act']}}</td>
                <td>{{$value['profil_pros']}}</td>
                <td id='cp_prospect'>{{$value['cp']}}</td>
                <td id='ville_prospect'>{{$value['ville']}}</td>
                <td id='lead_mut'>{{$value['lead_mut']}}&euro;</td>
                <td style="background-color: #41cac0">
                  <button onclick="add_cart({{$value['id']}},'mutualisee','{!!$value['title_act']!!}','{!!$value['date']!!}',{{$value['lead_mut']}},'{!!$value['cp']!!}','{!!$value['ville']!!}','{!!$value['type']!!}')"
                      id="" data-original-title="" data-title="">
                      <i class="fa fa-cart-plus" aria-hidden="true"></i>
                  </button>
                </td>
                <td id='lead_excl'>{{$value['lead_excl']}}&euro;</td>
                <td style="background-color: #f1c500">
                  <button onclick="add_cart({{$value['id']}},'exclusive','{!!$value['title_act']!!}','{!!$value['date']!!}',{{$value['lead_excl']}},'{!!$value['cp']!!}','{!!$value['ville']!!}','{!!$value['type']!!}')"
                      id="" data-original-title="" data-title="">
                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                </button>
                </td>
                <td style="background-color: #ff6c60;text-align:center;">
                      <a href="{{route('Prospect.show',array($value['type'],$value['id']))}}">
                          <i class="fa fa-eye" aria-hidden="true"></i>
                      </a>
                </td>
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
@section('script_js')
<script>
function add_cart(a,b,c,d,e,f,g,h){
    $.ajax({
              url: "{{route("Prospect.add") }}",
              method: 'get',
              data:{
                   id             : a,
                   fo_lead        : b,
                   title_act      : c,
                   date_p         : d,
                   price          : e,
                   zipcode        : f,
                   ville          : g,
                   type           : h,

              },
              success: function(data) {
                console.log(data);
                $('.dropdown-toggle').dropdown();
                $('#cart-shop').html();
                document.location.href = '/prospects';  
              }
    });
}

</script>
@endsection

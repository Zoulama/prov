<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    {{ Html::style('front/css/bootstrap.min.css') }}
    <style type="text/css">
       .container {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
        width: 800px;
      }
      
       .invoice-title h2, .invoice-title h3 {
        display: inline-block;
        
        }

        .table > tbody > tr > .no-line {
            border-top: none;
            width: 80%;
        }

        .table > thead > tr > .no-line {
            border-bottom: none;
            width: 80%;
        }

        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
            width: 80%;
        } 

    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
        <div class="invoice-title">
          <h2>Achat de prospect </h2>
          <br>
          {{ HTML::image('front/img/logo_lead.png','alt',array( 'width' => 300, 'height' => 70 )) }}
        </div>
        <hr>
        <div class="row">
          <div class="col-xs-6">
            <address>
            <strong>Facturé à:</strong><br>
              {{$data['first_name']}} {{$data['last_name']}}<br>
              XXXXXXXXXXXXXXX<br>
              XXXXXXXXXXXXXXX<br>
              XXXXXXXXXXX,XXXXXX
            </address>
          </div>
          <div class="col-xs-6 text-right">
            <address>
              <strong>Entreprise</strong><br>
              XXXXXXXXXXXX<br>
              XXXXXXXXXXXX<br>
              XXXXXXXX<br>
              XXXXXXXXXXX, XXXXXX
            </address>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6">
            <address>
              <strong>Methode de paiement:</strong><br>
              {{$data['type_paiement']}}<br>
              {{$data['email']}}
            </address>
          </div>
          <div class="col-xs-6 text-right">
            <address>
              <strong>Date de facture:</strong><br>
              {{$data['date_facture']}}<br><br>
            </address>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><strong>Facture #{{$data['num_fact']}}</strong></h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-condensed">
                <thead>
                    <tr>
                      <td><strong>Reference</strong></td>
                      <td class="text-center"><strong>Description</strong></td>
                      <td class="text-center"><strong>Formule</strong></td>
                      <td class="text-right"><strong>Prix</strong></td>
                    </tr>
                </thead>
                <tbody>
                @if(isset($data['cartTab']) && !empty($data['cartTab']))
                  @foreach($data['cartTab'] as $value)
                    <tr>
                      <td>{{$value['id']}}</td>
                      <td class="text-center">{{$value['name_prospect']}}</td>
                      <td class="text-center">{{$value['formule_prospect']}}</td>
                      <td class="text-right">{{$value['prix_prospect']}}&euro;</td>
                    </tr>
                  @endforeach
                @endif
                  <tr>
                    <td class="no-line"></td>
                    <td class="no-line"></td>
                    <td class="no-line text-center"><strong>Nombre deProsepcts</strong></td>
                    <td class="no-line text-right">{{$data['nombre']}}</td>
                  </tr>
                  <tr>
                    <td class="no-line"></td>
                    <td class="no-line"></td>
                    <td class="no-line text-center"><strong>Total</strong></td>
                    <td class="no-line text-right">{{$data['total_price']}}&euro;</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</body>
<html>


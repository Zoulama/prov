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
          <h2>Achat Credit</h2>
          <br>
          {{ HTML::image('front/img/logo_lead.png','alt',array( 'width' => 300, 'height' => 70 )) }}
        </div>
        <hr>
        <div class="row">
          <div class="col-xs-6">
            <address>
            <strong>Facturé à:</strong><br>
              {{$DataInvoice['first_name']}}<br>
              {{$DataInvoice['last_name']}}<br>
              XXXXXXX<br>
              XXXXXXX,XXXXXX
            </address>
          </div>
          <div class="col-xs-6 text-right">
            <address>
              <strong>XXXXXXXXX:</strong><br>
              XXXXXXXXXX<br>
              XXXXXXXX<br>
              XXXXXXX<br>
              XXXXXXXXXXXXX,XXXXX
            </address>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6">
            <address>
              <strong>Methode de paiement:</strong><br>
              Carte bancaire<br>
              {{$DataInvoice['email']}}
            </address>
          </div>
          <div class="col-xs-6 text-right">
            <address>
              <strong>Date de Facture:</strong><br>
              {{$DataInvoice['date_achat']}}<br><br>
            </address>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><strong>Facture #{{$DataInvoice['num_fact']}}</strong></h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-condensed">
                <thead>
                    <tr>
                      <td><strong>Reference</strong></td>
                      <td class="text-center"><strong>Description</strong></td>
                      <td class="text-center"><strong>Prix</strong></td>
                      <td class="text-right"><strong>Total</strong></td>
                    </tr>
                </thead>
                <tbody>
                  <!-- foreach ($order->lineItems as $line) or some such thing here -->
                  <tr>
                    <td>#{{$DataInvoice['num_fact']}}</td>
                    <td class="text-center">{{$DataInvoice['pack']}}</td>
                    <td class="text-center">{{$DataInvoice['montant']}}</td>
                    <td class="text-right">{{$DataInvoice['montant']}}&euro;</td> 
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


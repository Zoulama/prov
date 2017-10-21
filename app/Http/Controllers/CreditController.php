<?php namespace LeadAssurance\Http\Controllers;

use Auth;
use PDF;
use Session;
use Illuminate\Http\Request;
use LeadAssurance\Http\Requests;
use LeadAssurance\Models\PackCredits;
use LeadAssurance\Models\Credits;
use LeadAssurance\Models\Achats;
use LeadAssurance\Classes\Payments\Payment;
use LeadAssurance\Classes\Repositories\DashboardRepository;
class CreditController extends Controller
{
    public function achatsCredit(){
    	$PackCredits = PackCredits::all();
    	foreach ($PackCredits as  $value) {
    		$DataPackCredits []=[
    								'id' 			=> $value->id,
    								'nb_credit' 	=> $value->nb_credit,
							        'credit_offer' 	=> $value->credit_offer,
							        'price' 		=> $value->price,
							        'label' 		=> $value->label,
    		];
    	}

    	return view('LeadDashboard.credits.credit_achats',compact('DataPackCredits'));
    }

    public function getPack($id){
    	$PackCredit = PackCredits::find($id);
        $pack_sess=Session::all()['_token'].'_'.Auth::user()->id.'_'.Auth::user()->account_id;
        Session::put($pack_sess,$id);
        Session::put('PRICE_PACK',$PackCredit->price);
    	return view('LeadDashboard.credits.get_pack_credit',compact('PackCredit'));
    }

    public function paymentCredit($montant){
        $data=[
            'montant'   => $montant,
            'type'      => 'PACK'
        ];

        $payboxdata=Payment::payBoxData($data);

        return view('LeadDashboard.payment_bank',compact('payboxdata'));
    }

    public function transAccepte(Request $request){
        $dataUser = Auth::check() ? Auth::user() : null;
        if (!is_null($dataUser)) {
            $pack_sess=Session::all()['_token'].'_'.$dataUser->id.'_'.$dataUser->account_id;
                if ($request->has('Mt') && 
                    $request->has('Ref') && 
                    $request->has('Auto') && 
                    $request->has('Trans') 
                    ) {
                        $montant=($request->Mt)/100;
                        $ref_com=$request->Ref;
                        $auto=$request->Auto;
                        $trans=$request->Trans;
                        if ($request->session()->has($pack_sess)) {
                            $achats=Achats::create([
                            'user_id'        => $dataUser->id,
                            'pack_credit_id' => $request->session()->get($pack_sess),
                            'prospect_id'    => null
                            ]);
                        }

                        $dataUser->credit_courant += intval($montant);
                        $dataUser->credit_total_achetes += intval($montant);
                        $dataUser->save();
                }
        }
                
        return view('LeadDashboard.paiement.transaction_accepte',compact('montant','ref_com','auto','trans'));
    }

    public function transAnnule(Request $request){
        if ($request->has('Mt') && $request->has('Ref') && $request->has('Trans')){
                $montant=$request->Mt;
                $ref_com=$request->Ref;
                $trans=$request->Trans;
        }
        return view('LeadDashboard.paiement.transaction_annule',compact('montant','ref_com','trans'));
    }

    public function transRefuse(){
        return view('LeadDashboard.paiement.transaction_refuse',compact('payboxdata'));
    }

    public function achatCredits(){
        $users  = Auth::user();
        $achatCredits = $users->credit()->get();
        $achats       =$users->achat()->where('pack_credit_id','<>',null)->get();
       
        foreach ($achats as $value) {
            $date = $value->created_at->toDateTimeString();
            $PackCredits = PackCredits::find($value->pack_credit_id);
            $achats_credits[]=[
                'pack'              => trim($PackCredits->label),
                'nb_credit'         => $PackCredits->nb_credit,
                'credit_offer'      => $PackCredits->credit_offer,
                'montant'           => $PackCredits->price,
                'date_achat'        => $date,
                'id'                => $value->id
            ];
        }

        return view('LeadDashboard.achat.credits',compact('achats_credits'));
    }

    public function getInvoicePackCredit($id){
        $users  = Auth::user();
        $achats =$users->achat()->where('id','=',$id)->first();
        $date = $achats->created_at->toDateTimeString();
        $PackCredits = PackCredits::find($achats->pack_credit_id);
        $DataInvoice=[
                'pack'              => trim($PackCredits->label),
                'nb_credit'         => $PackCredits->nb_credit,
                'credit_offer'      => $PackCredits->credit_offer,
                'montant'           => $PackCredits->price,
                'date_achat'        => $date,
                'first_name'        => $users->first_name,
                'last_name'         => $users->last_name,
                'num_fact'          => $id,
                'email'             => $users->email,
        ];

        $data =[
           'DataInvoice' => $DataInvoice
        ];

//dd($DataInvoice);
        $file_name = $users->id.uniqid().'.pdf';
        return PDF::loadView('LeadDashboard.paiement.invoice_credit',
            array('DataInvoice' =>$DataInvoice))
                            ->setPaper('a4')->setOrientation('portrait')
                            ->setOption('margin-bottom',0)
                            ->stream($file_name);
    }

}


		
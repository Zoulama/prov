<?php namespace LeadAssurance\Http\Controllers;

use Auth;
use Cart;
use Session;
use Redirect;
use Response;
use File;
use League\Csv\Reader;
use League\Csv\Writer;
use Illuminate\Http\Request;
use LeadAssurance\Http\Requests;
use LeadAssurance\Classes\Tarif;
use LeadAssurance\Models\Achats;
use LeadAssurance\Models\Invoices;
use LeadAssurance\Classes\Payments\Payment;
use LeadAssurance\Classes\Repositories\DashboardRepository;

class CartController extends Controller
{
    public function addCart(Request $request){
    	
    	if ($request->ajax())
        {
            //$dataPreospect=DashboardRepository::getProspectDetail($request->type_lead,$request->id_lead);
            $price =$request->price;
	    	$add=Cart::add($request->id,$request->title_act, 1,$price,
				    		[
					    		'date_p' 	=> $request->date_p,
					    		'for' 		=> $request->fo_lead,
					    		'zipcode' 	=> $request->zipcode,
					    		'ville' 	=> $request->ville,
                                'type'      => $request->type,
                                'id'        => $request->id,
				    		]
	    	);
	    	return Response::json($add);
        }
    	
    }

    public function CartView(){
    	$cartTab= DashboardRepository::cartContent();

        return view('LeadDashboard.Cart.cart_view',compact('cartTab'));
    }

    public function cartCheckout(){
         $data=[
            'montant'   => $total_price =Cart::total(),
            'type'      => 'CART'
        ];
    
        $payboxdata=Payment::payBoxData($data);
        return view('LeadDashboard.payment_bank',compact('payboxdata'));
    }


   /* public function CartCheckoutPay(){
        $data=[
            'montant'   => $total_price =Cart::total(),
            'type'      => 'CART'
        ];
        $payboxdata=Payment::payBoxData($data);
        return view('LeadDashboard.Cart.cart_checkout_pay');
    }*/

    public function cartCheckoutReview(){
        return view('LeadDashboard.Cart.cart_checkout_review');
    }

    public function cartPayComplete(){
        return view('LeadDashboard.Cart.cart_checkout_complete');
    }


    public function removeCart($id){
            Cart::remove($id);
            return redirect()->route('Prospect.CartView');
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
                        $montant=$request->Mt;
                        $ref_com=$request->Ref;
                        $auto=$request->Auto;
                        $trans=$request->Trans;
                        DashboardRepository::achatDeProspect('CARD');
                }
        }
                
        return view('LeadDashboard.paiement.transaction_accepte',compact('montant','ref_com','auto','trans'));
    }

    public function transAnnule(Request $request){
        if ($request->has('montant') && $request->has('ref') && $request->has('trans')){
                $montant=$request->montant;
                $ref_com=$request->ref;
                $trans=$request->trans;
        }
        return view('LeadDashboard.paiement.transaction_annule',compact('montant','ref_com','trans'));
    }

    public function achatProspects(){
        $user   = Auth::user();
        $achats = $user->invoice()->get();
        $i=0;
        foreach ($achats as $value) {
            $i++;
            $tabAchat[] =[
                    'count'                 => $i,
                    'id'                    => $value->id,
                    'key_F'                 => $value->id.'_F',
                    'key_P'                 => $value->id.'_P',
                    'date_achat'            => $value->created_at->toDateTimeString(),
                    'invoice_file_name'     => $value->invoice_file_name,
                    'prospect_file_name'    => $value->prospect_file_name,

            ];
        }
        
        return view('LeadDashboard.achat.prospects',compact('tabAchat'));
    }

    public function dowloadFile($id){
        $var =explode('_',$id);
        $inv = Invoices::find($var[0]);
        if ($var[1]=='P') {
            $file = 'csv_files/'.$inv->prospect_file_name;
        }else{
            $file = 'invoices_files/'.$inv->invoice_file_name;
        }
        $extension = File::extension($file);
        
        $headers = ['Content-Type: application/'.$extension];
        $newName = 'fichier_csv_prospect_'.time().'.'.$extension;

        return response()->download($file, $newName, $headers);
    }

    public function paiementByCredit(){
        $dataUser = Auth::check() ? Auth::user() : null;
        $credits =Cart::total();
        if(!is_null($dataUser)){
            if (($dataUser->credit_courant - $credits) >= 0 ) {
                $dataUser->credit_courant -=$credits;
                $dataUser->credit_depenses +=$credits;
                $dataUser->save();
                $cartContent = Cart::content();
                DashboardRepository::achatDeProspect('CREDIT');
                Session::flash('pay_sucess', 'Paiement effectué avec succés');
            }else{
                Session::flash('pay_error', 'Erreur lors du paiement veuillez recommancer');
                return redirect()->route('Prospect.CartView');
            }
        }
        return redirect()->route('Prospect.achats');
    }
}

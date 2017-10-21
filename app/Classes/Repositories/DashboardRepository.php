<?php namespace LeadAssurance\Classes\Repositories;

use stdClass;
use Auth;
use DB;
use Cart;
use PDF;
use Cache;
use League\Csv\Reader;
use League\Csv\Writer;
use DateInterval;
use DatePeriod;
use Carbon\Carbon;
use LeadAssurance\Models\Activity;
use LeadAssurance\Models\Achats;
use LeadAssurance\Models\Invoices;
use LeadAssurance\Models\Invoice;
use LeadAssurance\Classes\Tarif;

class DashboardRepository
{

    public static $excepColum = ['Civi','nom','prenom','eMail','Tele','dateNaissance','id','counterLead'];
    public static $csv_folder ='csv_files';
    public static $invoices_files ='invoices_files';
    public static $csvHeader = [
                                    'Reference',
                                    'Date',
                                    'Type de prospect',
                                    'Profession',
                                    'Civilité',
                                    'Nom',
                                    'Prenom',
                                    'Adresse',
                                    'Code postal',
                                    'Ville',
                                    'Telephone',
                                    'E-mail'
                                ];


    
    public static function  ConnetToApi($url){
       
        $client = new \GuzzleHttp\Client();
        $resProspect = $client->request('GET',$url, [
            'auth' => [HELLOASSULOGIN, HELLOASSUPASS]
        ]);
        return $resProspect;
    }


    public function prospectPotentiels(){
        if (Cache::get('all_prospects') !=null) {
            $allDataProspect = Cache::get('all_prospects');
        }else{
            $allDataProspect=Cache::remember('all_prospects',5, function() {
                     $resAll=self::ConnetToApi(ALL_PROSPECTS_URL);
                     return json_decode($resAll->getBody(true));
            });
        }

        foreach ($allDataProspect as $key => $value) {
            if (is_array($value) && !empty($value)) {
                foreach ($value as $keys => $valueKey) {
                   $date_prospect=explode(' ', $valueKey->created_at);
                    $tabProspect[]=[
                        'ref'           => '',
                        'id'            => $valueKey->id,
                        'date'          => str_replace('-','/', $date_prospect[0]),
                        'title_act'     => (string)Tarif::tarifProspect()[$key]['label'],
                        'type'          => $key,
                        'profil_pros'   => 'vide',
                        'cp'            => $valueKey->postalPark,
                        'ville'         => $valueKey->Ville,
                        'lead_mut'      => Tarif::tarifProspect()[$key]['mutualisee'],
                        'lead_excl'     => Tarif::tarifProspect()[$key]['exclusive'],
                    ];
                } 
            }
        }
        return $tabProspect;
    }
    
    public static function getProspectDetail($type,$id){
          if (Cache::get('details_prospect_'.$id) !=null) {
            $dataProspect = Cache::get('details_prospect_'.$id);
        }else{
            $dataProspect=Cache::remember('details_prospect_'.$id,6, function() use ($type,$id) {
                      $resProspect=self::ConnetToApi(URL_API.$type.'/'.$id);
                      return json_decode($resProspect->getBody(true));
            });
        }

        return $dataProspect;
    }
    public static function parsData($data){
        $collection = collect($data);
        $filtered = $collection->except(self::$excepColum);
        $filtered->all();
        return $filtered->toArray();
    }

    public static function getLabelProspect($type){
          $resProspect=self::ConnetToApi(URL_LABEL);
          $dataLbelProspect=json_decode($resProspect->getBody(true));
          $prospestDataLabel=self::parsData($dataLbelProspect->$type);
          $prospestDataLabel['created_at']='Date de creation';
          $prospestDataLabel['updated_at']='Date de modification';

          return $prospestDataLabel;
    }

    public static function updateProspect($type,$id,$formule){
        $update=self::ConnetToApi(URL_API_UPDATE.$type.'/'.$id.'/'.$formule);
    }

    public static function formateTime($date){
        $df=explode(' ',$date);
        $df_1=explode('-',$df[0]);
        $df_2=explode(':',$df[1]);
        $dtm =$df_1[0].$df_1[1].$df_1[2];
        $dtms =$df_2[0].$df_2[1].$df_2[2];
        $dtateTime =$dtm.$dtms;
        return $dtateTime;
    }

    public static function creatCsvPreospect($Csv_Data,$invoices){

        $Data_user =Auth::user();
        $date =Carbon::now()->format('Y-m-d H:i:s');
        $datateTime=self::formateTime($date);
        $stream = fopen(self::$csv_folder.'/prospect_'.$datateTime.'_'.$Data_user->id.'.csv', 'x+');
        $datateTimefile =self::$csv_folder.'/prospect_'.$datateTime.'_'.$Data_user->id.'.csv';
        $prospect_file = 'prospect_'.$datateTime.'_'.$Data_user->id.'.csv';
        $invoices->prospect_file_name =$prospect_file;
        $invoices->save();
        $csv = Writer::createFromPath($datateTimefile);
        $csv->setDelimiter(";");
        $csv->setNewline("\r\n");
        $csv->setOutputBOM(Writer::BOM_UTF8);
        $csv->insertOne(self::$csvHeader);
        $csv->insertAll($Csv_Data);

    }

    public static function cartContent(){
        $cartContent=Cart::content();
        $total_price =Cart::total();
        $count = Cart::count();
        foreach ($cartContent as $row) {
            $location = $row->options->zipcode.' '.$row->options->ville;
            $cartTab[] =[
                        'id'                => $row->rowId,
                        'name_prospect'     => $row->name,
                        'formule_prospect'  => $row->options->for,
                        'date_prospect'     => $row->options->date_p,
                        'locate_prospect'   => $location,
                        'prix_prospect'     => $row->price,
                        'type'              => $row->options->type,
                        'id_p'              => $row->options->id,
            ];
        }
        $cartTab = isset($cartTab) ? $cartTab : [];
        return $cartTab;
    }

    public static function achatDeProspect($type_paiement){
            $dataUser = Auth::check() ? Auth::user() : null;
            $cartContent = Cart::content();
            foreach ($cartContent as $value) {
               
                $id      = $value->id;
                $type    = $value->options->type;
                $formule = $value->options->for;
                $dataProspect=self::getProspectDetail($type,$id);

                self::updateProspect($type,$id,$formule);
                $achats=Achats::create([
                    'user_id'        => $dataUser->id,
                    'pack_credit_id' => null,
                    'prospect_id'    => $id
                ]);

                $date_prospect=explode(' ', $dataProspect->$type->created_at);
                $Type_de_prospect =(string)Tarif::tarifProspect()[$type]['label'];
    
                $varAttrib=get_object_vars($dataProspect->$type);

                if (isset($dataProspect->$type->prof)) {
                    $profession = $dataProspect->$type->prof;
                }else{
                    $profession = $dataProspect->$type->pro;
                }

                if ($dataProspect->$type->Civi=='0') {
                    $civilite = 'Monsieur';
                }else{
                    $civilite = 'Madame';
                }

                $ville =str_replace(' ','-', $dataProspect->$type->Ville);

                $Data_Csav[]=[
                    'Reference'             =>'00000'.$dataProspect->$type->id,
                    'Date'                  => str_replace('-','/', $date_prospect[0]),
                    'Type_de_prospect'      => $Type_de_prospect,
                    'Profession'            => $profession,
                    'Civilité'              => $civilite,
                    'Nom'                   => $dataProspect->$type->nom,
                    'Prenom'                => $dataProspect->$type->prenom,
                    'Adresse'               => $dataProspect->$type->adresse,
                    'Code postal'           => $dataProspect->$type->postalPark,
                    'Ville'                 => $ville,
                    'Telephone'             => (string)$dataProspect->$type->Tele,
                    'Email'                 => $dataProspect->$type->eMail,
                ];
            }
            
            $invoices =Invoices::create([
                'user_id'               => $dataUser->id,
                'account_id'            => $dataUser->account_id,
            ]);

            $info_client =[
                    'fullname'  => $dataUser->first_name.' '.$dataUser->last_name,
                    'email'     => $dataUser->username,
            ];

            $info_facture =[
                    'num_fact'  => $dataUser->id.uniqid(),
                    'date_fact' => Carbon::now(),
            ];

            if ($type_paiement=='CARD') {
                 $paiement_type = PAIEMENT_CART_MSG;
            }else{
                $paiement_type = PAIEMENT_CREDIT_MSG;
            }

            $data=[
                'cartTab'       => self::cartContent(),
                'info_client'   => $info_client,
                'info_facture'  => $info_facture,
                'type_paiement' => $paiement_type,
                'first_name'    => $dataUser->first_name,
                'last_name'     => $dataUser->last_name,   
                'email'         => $dataUser->email,
                'total_price'   => Cart::total(),
                'nombre'        => Cart::count(),
                'num_fact'      => $invoices->id,
                'date_facture'  => Carbon::now(),
            ];

            $file_name = $dataUser->id.uniqid().'.pdf';
            PDF::loadView('LeadDashboard.paiement.invoice_prospect',array('data' => $data ))
                                ->setPaper('a4')->setOrientation('portrait')
                                ->setOption('margin-bottom',0)
                                ->save(self::$invoices_files . '/'.$file_name);
            $invoices->invoice_file_name =$file_name;
            self::creatCsvPreospect($Data_Csav,$invoices);
            Cart::destroy();
    }

    public function mesAchatProspect(){
        $users  = Auth::user();
        $achatProspect =$users->invoice()->get();
    }
}

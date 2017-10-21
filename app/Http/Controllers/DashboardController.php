<?php namespace LeadAssurance\Http\Controllers;

use stdClass;
use Auth;
use DB;
use View;
use Utils;
use PDF;
use GoogleMaps;
use Illuminate\Http\Request;
use LeadAssurance\Classes\Repositories\DashboardRepository;
use LeadAssurance\Http\Requests;


class DashboardController extends BaseController
{
    public function __construct(DashboardRepository $dashboardRepo)
    {
        $this->dashboardRepo = $dashboardRepo;
    }


    public function index()
    {
        //dd($this->dashboardRepo->prospectPotentiels());
        //dd($this->dashboardRepo->getLabelProspect('motos'));
        return view('LeadDashboard.index');
    }

   public function indexNew()
    {
        $user = Auth::user();
        $viewAll = $user->hasPermission('view_all');
        $userId = $user->id;
        $account = $user->account;
        $accountId = $account->id;

        $dashboardRepo = $this->dashboardRepo;
        $metrics = $dashboardRepo->totals($accountId, $userId, $viewAll);
        $activities = $dashboardRepo->activities($accountId, $userId, $viewAll);

        $data = [
            'account' => $user->account,
            'invoicesSent' => $metrics ? $metrics->invoices_sent : 0,
            'activities' => $activities,
            'payments' => $payments,
        ];

        return View::make('dashboard', $data);
    }

    public function chartData($groupBy, $startDate, $endDate, $currencyCode, $includeExpenses)
    {
        $includeExpenses = filter_var($includeExpenses, FILTER_VALIDATE_BOOLEAN);
        $data = $this->dashboardRepo->chartData(Auth::user()->account, $groupBy, $startDate, $endDate, $currencyCode, $includeExpenses);

        return json_encode($data);
    }


    public function getProfile()
    {

        return view('LeadDashboard.profile');
    }

    public function editProfile($id)
    {
        return view('LeadDashboard.profile_edit');
    }

    public function messagerie()
    {
        return view('LeadDashboard.inbox');
    }

    public function updateProfile()
    {

    }

    public function getAchats()
    {

        return view('LeadDashboard.achats');
    }

    public function recenteActicite()
    {
        return view('LeadDashboard.activite_recente');
    }
    

    public function getProspects()
    {
        $allProspect = $this->dashboardRepo->prospectPotentiels();
        $nbProspect =count($allProspect);
        return view('LeadDashboard.prospects',compact('allProspect','nbProspect'));
    }

    public function getTarifs()
    {

        return view('LeadDashboard.tarifs');
    }

    public function getFaqs()
    {

        return view('LeadDashboard.faqs');
    }

    public function showProspect($type,$id){
        $dataPreospect=DashboardRepository::getProspectDetail($type,$id);
        
        $data=get_object_vars($dataPreospect->$type);
        $data_pros=DashboardRepository::parsData($data);
        $data_restPros=array_keys($data_pros);
        
        foreach ($data_restPros as $value) {
          
               $ProspectInfo[]= [
                    DashboardRepository::getLabelProspect($type)[$value] => $data_pros[$value],
                ];
            
            
        }
        
        $search = $data['adresse'].' , '.$data['postalPark'].' , '.$data['Ville'];
        
        $reponse = GoogleMaps::load('geocoding')
        ->setParam ([
            'address'    => $search,
                    'components' => [
                        'country'              => 'FR',
                      ]
            ])
            ->get();

        if(json_decode($reponse)->status=='OK'){
            $reponse=json_decode($reponse)->results[0];
            if (isset($reponse)) {
                $results=[
                        'ville'           => $data['Ville'],
                        'code_postal'     => $data['postalPark'],
                        'adresss_complet' => $reponse->formatted_address,
                        'localite'        =>[
                                                'lat' => $reponse->geometry->location->lat,
                                                'lng' => $reponse->geometry->location->lng,
                                            ],
                ];
            }else{
                dd('verifiez bien l\'adresse postal');
            }
        }else{
            dd('bad adresse');
        }

            $coord =[
            'lat'       => $results['localite']['lat'],
            'lng'       => $results['localite']['lng'],
            'titre'     => $results['ville'],
        ];

            //dd($results);
        /*if(json_decode($reponse)->status=='OK'){
            $reponse=json_decode($reponse)->results[0];*/
        
        return view('LeadDashboard.prospect_detail',compact('ProspectInfo','coord','data'));
    }
}

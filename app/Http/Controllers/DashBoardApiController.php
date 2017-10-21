<?php namespace LeadAssurance\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use LeadAssurance\Http\Requests;
use LeadAssurance\Classes\Repositories\DashboardRepository;
use LeadAssurance\Classes\Transformers\ActivityTransformer;

class DashBoardApiController extends Controller
{
     public function __construct(DashboardRepository $dashboardRepo)
    {
        parent::__construct();

        $this->dashboardRepo = $dashboardRepo;
    }

    public function index()
    {
        $user = Auth::user();
        $viewAll = $user->hasPermission('view_all');
        $userId = $user->id;
        $accountId = $user->account->id;

        $dashboardRepo = $this->dashboardRepo;
        $metrics = $dashboardRepo->totals($accountId, $userId, $viewAll);
        $activities = $dashboardRepo->activities($accountId, $userId, $viewAll);


        $data = [
            'id' => 1,
            'activities' => $this->createCollection($activities, new ActivityTransformer(), ENTITY_ACTIVITY),
        ];

        return $this->response($data);
    }
}

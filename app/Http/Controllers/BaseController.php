<?php namespace LeadAssurance\Http\Controllers;

use Illuminate\Http\Request;
use LeadAssurance\Http\Requests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BaseController extends Controller
{
    use DispatchesJobs, AuthorizesRequests;

    protected $entityType;

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (! is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }
}

<?php namespace LeadAssurance\Classes\Repositories;

use DB;
use Utils;
use LeadAssurance\Models\Credit;
use LeadAssurance\Models\Client;

class CreditRepository extends BaseRepository
{
    public function getClassName()
    {
        return 'LeadAssurance\Models\Credit';
    }
}

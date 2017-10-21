<?php namespace LeadAssurance\Models;

use Eloquent;

/**
 * Class Bank
 */
class Bank extends Eloquent
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param $finance
     * @return \LeadAssurance\Libraries\Bank
     */
    public function getOFXBank($finance)
    {
        $config = json_decode($this->config);

        return new \LeadAssurance\Libraries\Bank($finance, $config->fid, $config->url, $config->org);
    }
}

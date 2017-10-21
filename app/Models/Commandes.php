<?php namespace LeadAssurance\Models;

use Illuminate\Database\Eloquent\Model;

class Commandes extends Model
{
    protected $table = 'orders';

    public function user(){
    	return $this->belongsTo('LeadAssurance\Models\Users');
    }
}

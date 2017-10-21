<?php

namespace LeadAssurance\Models;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    protected $table = 'invoice';
    protected $fillable =[
    			'user_id',
    			'account_id',
    			'invoice_file_name',
    			'prospect_file_name',
    			'created_at',
    			'updated_at',
    		];

    public function user(){
    	return $this->belongsTo('LeadAssurance\Models\Users');
    }
}

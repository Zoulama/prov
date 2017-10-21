<?php namespace LeadAssurance\Models;

use Illuminate\Database\Eloquent\Model;

class Achats extends Model
{
    protected $table = 'achats';
    protected $fillable = ['user_id','pack_credit_id','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('LeadAssurance\Models\Users');
    }
}



	
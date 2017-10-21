<?php  namespace LeadAssurance\Models;

use Illuminate\Database\Eloquent\Model;

class Credits extends Model
{
    protected $table = 'credits';
    protected $fillable =[
    			'user_id',
    			'account_id',
    			'created_at',
    			'updated_at',
    			'is_deleted',
    			'amount',
    			'public_id'
    		];

    public function user(){
        return $this->belongsTo('LeadAssurance\Models\Users');
    }
}

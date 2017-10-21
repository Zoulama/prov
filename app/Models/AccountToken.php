<?php namespace LeadAssurance\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AccountToken
 */
class AccountToken extends EntityModel
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return mixed
     */
    public function getEntityType()
    {
        return ENTITY_TOKEN;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo('LeadAssurance\Models\Account');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('LeadAssurance\Models\User')->withTrashed();
    }
}

<?php namespace LeadAssurance\Models;

use Eloquent;

/**
 * Class PaymentLibrary
 */
class PaymentLibrary extends Eloquent
{
    /**
     * @var string
     */
    protected $table = 'payment_libraries';
    /**
     * @var bool
     */
    public $timestamps = true;

}

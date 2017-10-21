<?php namespace LeadAssurance\Http\ViewComposers;

use Cache;
use Illuminate\View\View;

/**
 * TranslationComposer.php.
 *
 * @copyright See LICENSE file that was distributed with this source code.
 */
class TranslationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('paymentTypes', Cache::get('paymentTypes')->each(function ($pType) {
            $pType->name = trans('texts.payment_type_'.$pType->name);
        })->sortBy(function ($pType) {
            return $pType->name;
        }));
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 3/29/16
 * Time: 11:19 PM
 */

namespace Androzd\Imagine;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Collective\Html\HtmlBuilder
 */
class ImagineFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'imagine';
    }
}

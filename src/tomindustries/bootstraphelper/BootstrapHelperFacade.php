<?php
/**
 * HelloFacade.php
 * @author Tom
 * @since 18/06/13
 */

namespace tomindustries\doctorpdf;
use Illuminate\Support\Facades\Facade;

/**
 * Class HelloFacade
 * @package tomindustries\psr0lib
 */
class BootstrapHelperFacade extends Facade
{
    /**
     * Resolve our Facade to a string that corresponds to a class
     * within Laravel's Inversion of Control container,
     * which we set up in the ServiceProvider.
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'bootstraphelper';
    }
}
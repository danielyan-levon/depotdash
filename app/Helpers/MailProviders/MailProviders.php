<?php
/**
 * DepotDash Mail Providers Service Factory
 *
 * This will create an instance of the service.
 *
 * @author Gevorg Hovsepyan <hovsepyan.gev1@gmail.com>
 *
 */
namespace App\Helpers\MailProviders;

class MailProviders
{

    public static function service($service, $args = [])
    {
        $class = '\App\Helpers\MailProviders\\' . $service . 'Service\\' . $service . 'Service';

        return new $class($args);
    }

}
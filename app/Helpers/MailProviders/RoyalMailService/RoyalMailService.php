<?php

/**
 * Royal Mail Service
 *
 * Used RMLocalCollectAPI, RMPostageAPI, RMShippingAPI, RMTrackingAPI
 *
 * @author Gevorg Hovsepyan <hovsepyan.gev1@gmail.com>
 *
 * @category RoyalMailService
 * @package RoyalMailService
 *
 * @TODO the above mentioned APIs are not integrated fully mainly it is connected with Royal Mail APIs service. Need more info on APIs for understanding
 */

namespace App\Helpers\MailProviders\RoyalMailService;

use App\Helpers\MailProviders\MailProvidersInterface;
//use App\Helpers\MailProviders\RoyalMailService\RMLocalCollectAPI;
use App\Helpers\MailProviders\RoyalMailService\RMShippingAPI;
use App\Helpers\MailProviders\RoyalMailService\RMPostageAPI;
use App\Helpers\MailProviders\RoyalMailService\RMTrackingAPI;

class RoyalMailService implements MailProvidersInterface
{
    
}
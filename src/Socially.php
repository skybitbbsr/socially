<?php

namespace SkyBit\Socially;

use Facebook\Exceptions\FacebookSDKException;
use Google_Service_Oauth2;
use SkyBit\Socially\Hubs\FacebookConfig;
use SkyBit\Socially\Hubs\GoogleConfig;
use SkyBit\Socially\Traits\FacebookTrait;
use SkyBit\Socially\Traits\GoogleTrait;

/**
 * Class Socially
 * @package SkyBit\Socially
 */
class Socially
{
    use FacebookTrait, GoogleTrait;

    /**
     * @var
     */
    private static $facebookToken;

    /**
     * @var
     */
    private static $googleToken;

}
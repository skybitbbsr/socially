<?php
/**
 * Created by PhpStorm.
 * User: surya
 * Date: 28/2/19
 * Time: 3:54 PM
 */

namespace SkyBit\Socially\Hubs;

use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

/**
 * Class FacebookConfig
 * @package Helpers
 */
class FacebookConfig
{
    /**
     * @var
     */
    private static $fb;

    /**
     * @var array
     */
    private static $permissions;

    /**
     * @return \Facebook\Facebook
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public static function init()
    {
        if (!isset(self::$fb)) {
            self::$permissions = env('FACEBOOK_APP_PERMISSIONS');

            self::$fb = new Facebook ([
                'app_id' => env("FACEBOOK_APP_ID"),
                'app_secret' => env("FACEBOOK_APP_SECRET"),
                'default_graph_version' => env("FACEBOOK_DEFAULT_GRAPH_VERSION")
            ]);
        }
        return self::$fb;

    }

    /**
     * @return \Facebook\Helpers\FacebookRedirectLoginHelper
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public static function getFacebookHelper()
    {
        return self::init()->getRedirectLoginHelper();
    }

    /**
     * @return string
     */
    public static function getFacebookLoginUrl()
    {
        try {
            $helper = self::getFacebookHelper();
            return $helper->getLoginUrl(env('FACEBOOK_REDIRECT_URI'), self::$permissions);
        } catch (FacebookSDKException $e) {
        }
    }
}

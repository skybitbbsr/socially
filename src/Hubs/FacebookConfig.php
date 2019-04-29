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
        self::$permissions = explode(' ', env('FACEBOOK_APP_PERMISSIONS'));

        $attributes = [
            'app_id' => env("FACEBOOK_APP_ID"),
            'app_secret' => env("FACEBOOK_APP_SECRET"),
            'default_graph_version' => env("FACEBOOK_DEFAULT_GRAPH_VERSION")
        ];

        if (!isset(self::$fb)) {

            self::$fb = new Facebook ($attributes);
        }
        return self::$fb;

    }

    /**
     * @return \Facebook\Helpers\FacebookRedirectLoginHelper | null
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public static function getFacebookHelper()
    {
        try {

            $helper =  self::init()->getRedirectLoginHelper();

        } catch (FacebookSDKException $e) {

            error_log($e);
            $helper = null;

        }

        return $helper;
    }

    /**
     * @throws
     * @return mixed
     */
    public static function getFacebookLoginUrl()
    {
        $uri = env('FACEBOOK_REDIRECT_URI');

        $helper = self::getFacebookHelper();

        return $helper->getLoginUrl($uri, self::$permissions);

    }
}

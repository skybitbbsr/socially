<?php

namespace SkyBit\Socially\Hubs;

use Google_Client;

/**
 * Class GoogleConfig
 * @package App\CustomHelper
 */
class GoogleConfig
{
    /**
     * @var
     */
    private static $google;

    /**
     * @return Google_Client
     */
    public static function init()
    {
        if (!isset(self::$google)) {
            self::$google = new Google_Client();
            self::$google->setClientId(env("GOOGLE_APP_CLIENT_ID"));
            self::$google->setClientSecret(env("GOOGLE_APP_CLIENT_SECRET"));
            self::$google->setApplicationName(env("GOOGLE_APP_NAME"));
            self::$google->setRedirectUri(env("GOOGLE_REDIRECT_URI"));
            self::$google->addScope(env("GOOGLE_APP_SCOPE"));

        }
        return self::$google;
    }

    /**
     * @return Google_Client
     */
    public static function getGoogleHelper()
    {
        return self::init();
    }

    /**
     * @return string
     */
    public static function getGoogleLoginUrl()
    {
        $gClient = self::getGoogleHelper();
        return $gClient->createAuthUrl();
    }
}

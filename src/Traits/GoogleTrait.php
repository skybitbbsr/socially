<?php

namespace SkyBit\Socially\Traits;


use Google_Service_Oauth2;
use SkyBit\Socially\Hubs\GoogleConfig;

trait GoogleTrait {

    /**
     *
     */
    public static function googleLoginUrl()
    {
        return GoogleConfig::getGoogleLoginUrl();
    }

    /**
     * @param string $token
     * @return \Google_Service_Oauth2_Userinfoplus
     */
    public static function googleLogin($token = '')
    {
        $gClient = GoogleConfig::getGoogleHelper();

        if (isset($token)) {
            $gClient->fetchAccessTokenWithAuthCode($token);
            self::$googleToken = $gClient->getAccessToken();
        }

        $oAuth = new Google_Service_Oauth2($gClient);
        return $oAuth->userinfo_v2_me->get();
    }

}
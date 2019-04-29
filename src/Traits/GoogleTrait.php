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

    private static function getAuthCode()
    {
      if (isset($_GET['code'])) {
            return $_GET['code'];
        }
    }

    /**
     * @param string $token (optional)
     * @return \Google_Service_Oauth2_Userinfoplus
     */
    public static function googleLogin($token = '')
    {
        $gClient = GoogleConfig::getGoogleHelper();

        if (!isset($token)) {
          $token = self::getAuthCode();
        }

        $gClient->fetchAccessTokenWithAuthCode($token);
        self::$googleToken = $gClient->getAccessToken();

        $oAuth = new Google_Service_Oauth2($gClient);
        return $oAuth->userinfo_v2_me->get();
    }

}

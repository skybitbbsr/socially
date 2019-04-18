<?php

namespace SkyBit\Socially;

use Facebook\Exceptions\FacebookSDKException;
use Google_Service_Oauth2;
use SkyBit\Socially\Hubs\FacebookConfig;
use SkyBit\Socially\Hubs\GoogleConfig;

/**
 * Class Socially
 * @package SkyBit\Socially
 */
class Socially
{
    /**
     * @var
     */
    private static $facebookToken;

    /**
     * @var
     */
    private static $googleToken;

    /**
     *
     */
    public static function facebookLoginUrl()
    {
        FacebookConfig::getFacebookLoginUrl();
    }

    /**
     * @param array
     * @return Mixed
     */
    public static function facebookLogin($fields = [])
    {
        $facebookReturnedData = null;

        if(empty($fields)) {
            return $facebookReturnedData;
        }

        try {
            $helper = FacebookConfig::getFacebookHelper();
            $accessToken = $helper->getAccessToken();

            # Recording current accessToken
            self::$facebookToken = $accessToken;

        } catch (FacebookSDKException $exception) {
            error_log('Exception in Facebook SDK' . $exception);
            return $facebookReturnedData;
        }

        if (isset($accessToken)) {

            # Facebook Graph endpoint URL
            $url = '/me?fields=' . implode(',', $fields);

            # set all the required fields according to your permissions to be fetched from API here
            try {
                # Returns a `Facebook\FacebookResponse` object according to the request url
                $response = FacebookConfig::init()->get($url, $accessToken);

                # this method gets the user profile from the facebook response object of Facebook
                $facebookReturnedData = $response->getGraphUser();

            } catch (\Exception $exception) {
                error_log('Exception in getting Facebook User details' . $exception);
                return $facebookReturnedData;
            }
        }
        return $facebookReturnedData;
    }

    /**
     *
     */
    public static function googleLoginUrl()
    {
        GoogleConfig::getGoogleLoginUrl();
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
<?php

namespace SkyBit\Socially\Traits;

use Facebook\Exceptions\FacebookSDKException;
use SkyBit\Socially\Hubs\FacebookConfig;

trait FacebookTrait {

    /**
     *
     */
    public static function facebookLoginUrl()
    {
        return FacebookConfig::getFacebookLoginUrl();
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

}
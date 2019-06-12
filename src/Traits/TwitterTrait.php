<?php

namespace SkyBit\Socially\Traits;

use Abraham\TwitterOAuth\TwitterOAuth;
use Abraham\TwitterOAuth\TwitterOAuthException;

trait TwitterTrait {

    /**
     * Creates URL for Login with Twitter
     *
     * @throws TwitterOAuthException
     * @return string
     */
    public static function twitterLoginUrl()
    {

        $connection = new TwitterOAuth(
            env('TWITTER_API_KEY'), env('TWITTER_API_SECRET')
        );

        if(!session('twitter_oauth_key') || !session('twitter_oauth_secret')) {
            $access_token = $connection->oauth("oauth/request_token",
                ["oauth_callback" => env('TWITTER_REDIRECT_URI')]);

            session('twitter_oauth_key', $access_token['oauth_token']);
            session('twitter_oauth_secret', $access_token['oauth_token_secret']);
        }

        return $connection->url("oauth/authorize", ["oauth_token" => session('oauth_token')]);
    }

    /**
     * @param array
     * @return Mixed
     */
    public static function twitterLogin()
    {
        $twitterReturnedData = null;

        $connection = new TwitterOAuth(
            env('TWITTER_API_KEY'), env('TWITTER_API_SECRET'),
            session('twitter_oauth_key'), session('twitter_oauth_secret')
        );

        try {
            $accessToken = $connection->oauth('oauth/access_token', [
                'oauth_verifier' => $_GET['oauth_verifier'],
                'oauth_token' => $_GET['oauth_token']
            ]);
        } catch (TwitterOAuthException $e) {
            return $twitterReturnedData;
        }

        $content = new TwitterOAuth(
            env('TWITTER_API_KEY'), env('TWITTER_API_SECRET'),
            $accessToken['oauth_token'], $accessToken['oauth_token_secret']
        );

        $twitterReturnedData = $content->get('account/verify_credentials', ['include_email' => env('TWITTER_INCLUDE_EMAIL')]);

        return $twitterReturnedData;
    }

}
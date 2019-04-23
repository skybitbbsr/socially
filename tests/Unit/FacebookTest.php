<?php

namespace Tests;

use SkyBit\Socially\Hubs\FacebookConfig;
use SkyBit\Socially\Socially;

class FacebookTest extends Test
{
    public function testGetFacebookUrl()
    {
        $socially = FacebookConfig::getFacebookLoginUrl();

        $this->assertIsString($socially);
    }

    public function testGetFacebookHelper()
    {
        $socially = FacebookConfig::getFacebookHelper();

        $this->assertIsObject($socially);
    }
}

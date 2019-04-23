<?php

namespace Tests;

use SkyBit\Socially\Hubs\FacebookConfig;
use SkyBit\Socially\Hubs\GoogleConfig;
use SkyBit\Socially\Socially;

class GoogleTest extends Test
{
    public function testGetGoogleUrl()
    {
        $socially = GoogleConfig::getGoogleLoginUrl();

        $this->assertIsString($socially);
    }

    public function testGetGoogleHelper()
    {
        $socially = GoogleConfig::getGoogleHelper();

        $this->assertIsObject($socially);
    }
}

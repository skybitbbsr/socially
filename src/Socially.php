<?php

namespace SkyBit\Socially;

use SkyBit\Socially\Traits\FacebookTrait;
use SkyBit\Socially\Traits\GoogleTrait;
use SkyBit\Socially\Traits\TwitterTrait;

/**
 * Class Socially
 * @package SkyBit\Socially
 */
class Socially
{
    use FacebookTrait, GoogleTrait, TwitterTrait;

    /**
     * @var
     */
    private static $facebookToken;

    /**
     * @var
     */
    private static $googleToken;

}
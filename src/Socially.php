<?php

namespace SkyBit\Socially;

use Illuminate\Config\Repository as Config;

class Socially
{
    /**
     * The Config Handler.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    public function __construct(Config $config)
    {
        $this->config  = $config;
    }

    public function facebook()
    {
        $this->config = (array) $this->config->get('socially.facebook');
    }

    public function google()
    {
        $this->config = (array) $this->config->get('socially.google');
    }

}
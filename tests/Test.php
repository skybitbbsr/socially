<?php
namespace Tests;

use Dotenv\Dotenv;
use \PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $dotenv = Dotenv::create('./');
        $dotenv->load();

        parent::__construct($name, $data, $dataName);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfig() {
        $firstname = config ('contoh.author.first');
        $lastname = config ('contoh.author.last');
        $email = config ('contoh.email');
        $gender = config ('contoh.gender');

        self::assertEquals('yudi', $firstname);
        self::assertEquals('wahyudi', $lastname);
        self::assertEquals('wahyudi@gmail.com', $email);
        self::assertEquals('Male', $gender);
    }
}

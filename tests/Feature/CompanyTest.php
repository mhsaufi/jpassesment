<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/company');

        $response->assertStatus(200);
    }

    public function testRead(){

        $response = $this->json('GET','company/1');

        $response->assertStatus(200)->assertJson(['name' => 'Zigs']);
    }
}

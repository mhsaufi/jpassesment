<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/employee');

        $response->assertStatus(200);
    }

    public function testRead(){

        $response = $this->json('GET','employee/1');

        $response->assertStatus(200)->assertJson(['id' => '1']);
    }
}

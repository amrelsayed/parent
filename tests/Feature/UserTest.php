<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testAddProvidersDataToDB()
    {
        $response = $this->get('/api/v1/add-users-data');

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'email' => 'parent1@parent.eu',
        ]);
    }

    public function testGetData()
    {
        $this->get('/api/v1/add-users-data');

        $response = $this->get('/api/v1/users');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'provider',
                    'amount',
                    'currency',
                    'email',
                    'status_code',
                    'provider_id',
                    'created_at',
                ]
            ]
        ]);
    }

    public function testFilterWithProvider()
    {
        $this->get('/api/v1/add-users-data');

        $response = $this->get('/api/v1/users?provider=DataProviderX');
        
        $response->assertSee("DataProviderX");

        $response->assertDontSee("DataProviderY");
    }

    public function testFilterWithStatusCode()
    {
        $this->get('/api/v1/add-users-data');

        $response = $this->get('/api/v1/users?statusCode=authorised');
        
        $response->assertSee("authorised");

        $response->assertDontSee("declined");
    }

    public function testFilterWithBalanceRange()
    {
        $this->get('/api/v1/add-users-data');

        $response = $this->get('/api/v1/users?balanceMin=200&balanceMax=400');
        
        $response->assertJsonFragment(["amount" => "200"]);
        $response->assertJsonFragment(["amount" => "280"]);

        $response->assertJsonMissing(["amount" => "130"]);
        $response->assertJsonMissing(["amount" => "500"]);
    }

    public function testFilterWithCurrency()
    {
        $this->get('/api/v1/add-users-data');

        $response = $this->get('/api/v1/users?currency=EUR');
        
        $response->assertJsonFragment(["currency" => "EUR"]);

        $response->assertJsonMissing(["currency" => "USD"]);
        $response->assertJsonMissing(["currency" => "EGP"]);
        $response->assertJsonMissing(["currency" => "AED"]);
    }

    public function testAllFilters()
    {
        $this->get('/api/v1/add-users-data');

        $response = $this->get('/api/v1/users?provider=DataProviderX&statusCode=authorised&balanceMin=250&balanceMax=400&currency=EUR');
        
        $response->assertSee("DataProviderX");
        $response->assertDontSee("DataProviderY");

        $response->assertSee("authorised");
        $response->assertDontSee("declined");

        $response->assertJsonFragment(["amount" => "280"]);
        $response->assertJsonMissing(["amount" => "130"]);

        $response->assertJsonFragment(["currency" => "EUR"]);
        $response->assertJsonMissing(["currency" => "USD"]);
    }
}

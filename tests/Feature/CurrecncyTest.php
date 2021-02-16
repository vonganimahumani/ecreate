<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Currency;
use Illuminate\Support\Facades\Auth;

class CurrecncyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function test_can_list_currencies()
    {
        $this->actingAs(factory('App\User')->create());
        $currency = factory('App\Currency')->create();

        $response = $this->get('/currencies');

        $response->assertSee($currency->base_currency);

    }

     /** @test */
    public function authenticated_users_can_create_a_new_currency()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory('App\User')->create());

        $currency = factory('App\Currency')->make();

        $this->assertEquals($currency->user_currency,'ZAR');
    }

      /** @test */
    public function test_unauthenticated_users_cannot_create_a_new_currency()
    {
        $currency = factory('App\Currency')->make();

        $this->post('/currencies/store',$currency->toArray())->assertStatus(405);
    }

    public function a_currency_requires_inputs(){

        $this->actingAs(factory('App\User')->create());

        $currency = factory('App\Currency')->make(['base_currency' => null,'user_currency' => null]);

        $this->post('/currencies/store',['base_currency' => null,'user_currency' => null])
                ->assertSessionHasErrors('base_currency','user_currency');
    }
    /** @test */
    public function authorized_user_can_update_the_currency(){

        $this->actingAs(factory('App\User')->create());

        $currency = factory('App\Currency')->create(['user_id' => Auth::id()]);
        $currency->base_currency = "AED";

        $this->put('/currencies/'.$currency->id, $currency->toArray());

        $this->assertDatabaseHas('currencies',['id'=> $currency->id , 'base_currency' => 'AED']);

    }

    /** @test */
    public function unauthorized_user_cannot_update_the_task(){

        $currency = factory('App\Currency')->create();
        $currency->base_currency = "ZAR";
        $response = $this->put('/currencies/'.$currency->id, $currency->toArray());
        $response->assertStatus(302);
    }
}

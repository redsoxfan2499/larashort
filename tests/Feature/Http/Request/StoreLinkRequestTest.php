<?php

namespace Tests\Feature\Http\Request;

use App\Http\Requests\StoreLinkRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Util\Xml\Validator;
use Tests\TestCase;

class StoreLinkRequestTest extends TestCase
{
    /**
     * Test StoreLinkRequest validation rules
     *
     * @test
     */
    public function store_link_validation_rules_validation()
    {
        $storeLink = new StoreLinkRequest();
        $this->assertEquals([
            'custom_slug'   => 'required|alpha|max:10',
            'redirect_url'  => 'required|unique:link_mappings,redirect_url|url'
        ], $storeLink->rules());
    }

    /**
     * A test to check invalid data for the form custom slug
     *
     * @test
     */
    public function test_invalid_data_for_custom_slug()
    {
        $storeLink = new StoreLinkRequest();
        $storeLink = $this->post(url('/'), [
            'custom_slug' => '546yj',
        ]);
        $storeLink->assertSessionHasErrors(['custom_slug']);
    }

    /**
     * A test to check invalid data for the form redirect url
     *
     * @test
     */
    public function test_invalid_data_for_url()
    {
        $storeLink = new StoreLinkRequest();
        $storeLink = $this->post(url('/'), [
            'redirect_url' => 'gogle..com',
        ]);
        $storeLink->assertSessionHasErrors(['redirect_url']);
    }

    /**
     * A test to see if links store is a post and then redirects
     *
     * @test
     */
    public function test_links_store()
    {
        $response = $this->post('/', []);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['custom_slug', 'redirect_url']);
    }
}

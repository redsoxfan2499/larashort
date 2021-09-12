<?php

namespace Tests\Feature\Http;

use App\LinkMapping;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use DB;

class LinksTest extends TestCase
{
    /**
     * A test to test if links index page returns 200 status
     *
     * @test
     */
    public function test_links_index_returns_200()
    {
        $response = $this->get(route('links.index'));

        $response->assertStatus(200);
    }

    /**
     * A test to test if links index returns correct view
     *
     * @test
     */
    public function test_links_index_returns_correct_view()
    {
        $response = $this->get(route('links.index'));

        $response->assertViewIs('links');
    }

    /**
     * A test to test if links index page returns some data
     *
     * @test
     */
    public function test_links_index_returns_data()
    {
        $response = $this->get(route('links.index'));

        $response->assertStatus(200);
        $this->assertTrue(count(LinkMapping::all()) > 1);
    }

    /**
     * A test to test if links show page returns some data
     *
     * @test
     */
    public function test_links_show_page()
    {
        $response = $this->get(url('links/3'));

        $response->assertStatus(200);
        $this->assertNotEmpty(LinkMapping::where('id', 3)->first());
    }

    /**
     * A test to test if handle redirect request actually will do a redirect
     * using actually shortened_url from my actual database
     *
     * @test
     */
    public function test_handle_handle_redirect_request()
    {
        $response = $this->get(url('http://larashort.local/testme/321YZ'));

        $response->assertStatus(302);
    }
}

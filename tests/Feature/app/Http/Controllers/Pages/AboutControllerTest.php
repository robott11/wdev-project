<?php

namespace Tests\Feature\app\Http\Controllers\Pages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AboutControllerTest extends TestCase
{
    /**
     * Test if the about view is being returned
     *
     * @return void
     */
    public function test_about_view()
    {
        $response = $this->get(route('about'));

        $response->assertSuccessful();
        $response->assertViewIs('pages.about');
    }
}

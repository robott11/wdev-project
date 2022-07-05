<?php

namespace Tests\Feature\app\Http\Controllers\Pages;

use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function test_index_view()
    {
        $response = $this->get(route('home'));

        $response->assertSuccessful();
        $response->assertViewIs('pages.home');
    }
}

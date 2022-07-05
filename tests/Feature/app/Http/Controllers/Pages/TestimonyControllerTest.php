<?php

namespace Tests\Feature\app\Http\Controllers\Pages;

use App\Models\Testimony;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestimonyControllerTest extends TestCase
{
    use withFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_testimony_view()
    {
        $response = $this->get(route('testimony'));

        $response->assertSuccessful();
        $response->assertViewIs('pages.testimonies');
        $response->assertViewHas('testimonies', Testimony::paginate(2));
    }

    public function test_create_testimony()
    {
        $testimony = [
            'name' => $this->faker->name,
            'message' => $this->faker->text
        ];

        $response = $this->post(route('testimony.create'), $testimony);
        $response->assertRedirect(route('testimony'));
        $response->assertSessionHas('status');
    }

    public function test_create_testimony_with_missing_fields()
    {
        $response = $this->post(route('testimony.create'));

        $response->assertRedirect();
        $response->assertSessionHas('errors');
    }
}

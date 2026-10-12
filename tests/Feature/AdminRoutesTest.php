<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_all_admin_routes(): void
    {
        $admin = User::create([
            'users_family_name' => 'Admin',
            'users_given_name' => 'Super',
            'email' => 'admin@test.com',
            'password' => 'secret123',
            'users_role' => 'admin',
        ]);

        $routes = [
            '/admin',
            '/admin/event',
            '/admin/event/create',
            '/admin/event/spotlight',
            '/admin/gallery',
            '/admin/user',
            '/admin/frequently-asked-question',
            '/admin/profile',
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($admin)->get($route);
            $response->assertOk();
        }
    }

    public function test_admin_can_toggle_gallery_status_and_filter_tabs(): void
    {
        $admin = \App\Models\User::create([
            'users_family_name' => 'Admin',
            'users_given_name' => 'Super',
            'email' => 'admin_gallery@test.com',
            'password' => 'secret123',
            'users_role' => 'admin',
        ]);

        $gallery = \App\Models\Gallery::create([
            'galleries_type' => 'carousel',
            'galleries_status' => true,
        ]);

        \Livewire\Livewire::actingAs($admin)
            ->test(\App\Livewire\Pages\Admin\Gallery\Index::class)
            ->assertSee('#BANNER-001')
            ->assertSee('Live on Homepage')
            ->call('toggleStatus', $gallery->galleries_id)
            ->assertSet('tab', 'all');

        $this->assertFalse((bool) $gallery->fresh()->galleries_status);

        \Livewire\Livewire::actingAs($admin)
            ->test(\App\Livewire\Pages\Admin\Gallery\Index::class)
            ->set('tab', 'inactive')
            ->assertSee('#BANNER-001')
            ->set('tab', 'active')
            ->assertDontSee('#BANNER-001');
    }

    public function test_public_pages_render_successfully(): void
    {
        $this->get('/')->assertOk()->assertSee('Student Events');
        $this->get('/about-us')->assertOk()->assertSee('Student Activities Center');
        $this->get('/calendar-of-events')->assertOk();
        $this->get('/frequently-asked-questions')->assertOk();
    }

    public function test_admin_can_manage_faq_with_tabs_and_toggle(): void
    {
        $admin = \App\Models\User::create([
            'users_family_name' => 'Admin',
            'users_given_name' => 'Super',
            'email' => 'admin_faq@test.com',
            'password' => 'secret123',
            'users_role' => 'admin',
        ]);

        $faq = \App\Models\FAQ::create([
            'faqs_question' => 'How to submit event proposal?',
            'faqs_answer' => 'Submit to SAC office.',
            'faqs_status' => true,
        ]);

        \Livewire\Livewire::actingAs($admin)
            ->test(\App\Livewire\Pages\Admin\FrequentlyAskedQuestion\Index::class)
            ->assertSee('How to submit event proposal?')
            ->call('toggleStatus', $faq->faqs_id);

        $this->assertFalse((bool) $faq->fresh()->faqs_status);

        \Livewire\Livewire::actingAs($admin)
            ->test(\App\Livewire\Pages\Admin\FrequentlyAskedQuestion\Index::class)
            ->set('tab', 'inactive')
            ->assertSee('How to submit event proposal?')
            ->set('tab', 'active')
            ->assertDontSee('How to submit event proposal?');
    }
}



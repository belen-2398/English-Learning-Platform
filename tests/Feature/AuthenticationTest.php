<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create([
            'role_as' => 0,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_unauthenticated_user_cannot_access_admin_pages()
    {
        $dashResponse = $this->get('/admin/dashboard');
        $dashResponse->assertStatus(302);
        $dashResponse->assertRedirect('/login');

        $lessResponse = $this->get('/admin/lessons');
        $lessResponse->assertStatus(302);
        $lessResponse->assertRedirect('/login');

        $topResponse = $this->get('/admin/topics');
        $topResponse->assertStatus(302);
        $topResponse->assertRedirect('/login');

        $WoDResponse = $this->get('/admin/word-of-day');
        $WoDResponse->assertStatus(302);
        $WoDResponse->assertRedirect('/login');
    }

    public function test_teacher_user_cannot_access_admin_pages()
    {
        $teacher = User::factory()->create([
            'role_as' => 1,
        ]);

        $this->actingAs($teacher);

        $dashResponse = $this->get('/admin/dashboard');
        $dashResponse->assertStatus(302);
        $dashResponse->assertRedirect('/');

        $lessResponse = $this->get('/admin/lessons');
        $lessResponse->assertStatus(302);
        $lessResponse->assertRedirect('/');

        $topResponse = $this->get('/admin/topics');
        $topResponse->assertStatus(302);
        $topResponse->assertRedirect('/');

        $WoDResponse = $this->get('/admin/word-of-day');
        $WoDResponse->assertStatus(302);
        $WoDResponse->assertRedirect('/');
    }

    public function test_admin_login_redirects_to_admin_dashboard(): void
    {
        $admin = User::factory()->create([
            'role_as' => 2,
        ]);

        // $this->actingAs($admin);

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::ADMINHOME);
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class AdminPageTest extends TestCase
{
    use RefreshDatabase;
    use WithLoggedInUser;

    public function testIAccessTheAdminPageAsAdmin(): void
    {
        $this->createLoggedInAdmin();

        factory(User::class)->create([
            'name' => 'Taylor Swift',
            'approved_at' => Carbon::now(),
        ]);

        $response = $this->get('/admin');

        $response->assertStatus(200);
        $response->assertSeeText('Taylor Swift');
    }

    public function testICantAccessTheAdminPageAsNonAdmin(): void
    {
        $this->createLoggedInUser();

        $response = $this->get('/admin');
        $response->assertStatus(302);
        $response->assertRedirect('/unapproved');
    }

    public function testICantAccessTheAdminPageAsGuest(): void
    {
        $response = $this->get('/admin');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}

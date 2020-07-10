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

    public function testICanApproveUsers(): void
    {
        $this->createLoggedInAdmin();

        $user = factory(User::class)->create([
            'name' => 'Taylor Swift',
            'approved_at' => null,
        ]);

        $response = $this->get('/admin/approved/'.$user->id);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('users', ['name' => 'Taylor Swift', 'approved_at' => null]);
    }

    public function testICanUnApproveUsers(): void
    {
        $this->createLoggedInAdmin();

        $user = factory(User::class)->create([
            'name' => 'Taylor Swift',
            'approved_at' => Carbon::now()->toDateTimeString(),
        ]);

        $response = $this->get('/admin/unapproved/'.$user->id);

        $response->assertStatus(302);

        $this->assertDatabaseHas('users', ['name' => 'Taylor Swift', 'approved_at' => null]);
    }
}

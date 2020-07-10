<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class UnapprovedUsersTest extends TestCase
{
    use RefreshDatabase;
    use WithLoggedInUser;

    public function testICanOnlySeeUnApprovedUsers(): void
    {
        $this->createLoggedInUser();

        factory(User::class)->create([
            'name' => 'Taylor Swift',
            'approved_at' => Carbon::now(),
        ]);

        factory(User::class)->create([
            'name' => 'Lorde',
            'approved_at' => null,
        ]);
        $response = $this->get('/unapproved');

        $response->assertStatus(200);
        $response->assertDontSeeText('Taylor Swift');
        $response->assertSeeText('Lorde');
    }

    public function testICanNotGetToTheUnApprovedPageAsAGuest():void
    {
        factory(User::class)->create([
            'name' => 'Taylor Swift',
            'approved_at' => Carbon::now(),
        ]);

        $response = $this->get('/unapproved');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}

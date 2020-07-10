<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class ApprovedUsersTest extends TestCase
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

        $response = $this->get('/approved');

        $response->assertStatus(200);
        $response->assertDontSeeText('Lorde');
        $response->assertSeeText('Taylor Swift');
    }

    public function testICanNotGetToTheApprovedPageAsAnUnapprovedUser():void
    {
        $this->createUnApprovedLoggedInUser();

        factory(User::class)->create([
            'name' => 'Taylor Swift',
            'approved_at' => Carbon::now(),
        ]);

        $response = $this->get('/approved');
        $response->assertStatus(302);
        $response->assertRedirect('/unapproved');
    }

    public function testICanNotGetToTheApprovedPageAsAGuest():void
    {
        factory(User::class)->create([
            'name' => 'Taylor Swift',
            'approved_at' => Carbon::now(),
        ]);

        $response = $this->get('/approved');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}

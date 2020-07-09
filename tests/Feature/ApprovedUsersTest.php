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

    public function testICanOnlySeeUnApprovedUsers(): void
    {
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
}

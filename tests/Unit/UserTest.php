<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a user.
     */
    public function test_create_user(): void
    {
        $user = User::factory()->create(['email' => 'test@example.com']);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('test@example.com', $user->email);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    /**
     * Test creating a category, mock.
     */
    public function test_create_product_mock()
    {
        $user = $this->createMock(User::class);
        $user->method('save')
            ->willReturn(true);

        $this->assertTrue($user->save());
    }

    /**
     * Test finding a user by ID.
     */
    public function test_find_user_by_id(): void
    {
        $createdUser = User::factory()->create(['email' => 'test@example.com']);
        $foundUser = User::find($createdUser->id);

        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals('test@example.com', $foundUser->email);
    }

    /**
     * Test truncating users.
     */
    public function test_truncate_users(): void
    {
        User::factory()->count(5)->create();
        User::truncate();

        $this->assertCount(0, User::all());
    }
}

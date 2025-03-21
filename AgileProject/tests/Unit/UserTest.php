<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{


    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_user()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }

    /** @test */
    public function it_hides_sensitive_attributes()
    {
        $user = User::factory()->create();
        $userArray = $user->toArray();

        $this->assertArrayNotHasKey('password', $userArray);
        $this->assertArrayNotHasKey('remember_token', $userArray);
    }

    /** @test */
    public function it_casts_attributes_properly()
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'password' => 'secret',
        ]);

        $this->assertInstanceOf(\DateTimeInterface::class, $user->email_verified_at);
        $this->assertTrue(Hash::check('secret', $user->password));
    }

    /** @test */
    public function it_has_proper_fillable_attributes()
    {
        $user = new User();

        $this->assertEquals([
            'name',
            'email',
            'password',
        ], $user->getFillable());
    }

    /** @test */
    public function it_does_not_allow_mass_assignment_of_protected_attributes()
    {
        $user = User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);

        $this->assertNull($user->getAttribute('admin')); // Testing non-fillable attribute
    }
}
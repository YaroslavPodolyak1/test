<?php

namespace Tests;

use App\Core\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    public function sanctumActingAs(?User $user = null): self
    {
        Sanctum::actingAs($user ?? User::factory()->create());

        return $this;
    }
}

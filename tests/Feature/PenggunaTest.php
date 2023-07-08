<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PenggunaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCanShowPenggunaPage()
    {
        $user = User::role('admin')->get()->random();

        // dd($user);
        $this->actingAs($user);
        $this->get('/pengguna')->assertOk();
        // $response = $this->get('/pengguna');

        // $response->assertStatus(200);
    }

    public function testCannotShowPenggunaPage()
    {
        $user = User::role('pegawai')->get()->random();

        $this->actingAs($user);
        $this->get('/pengguna')->assertStatus(403);
        // $response = $this->get('/pengguna');

        // $response->assertStatus(200);
    }
}

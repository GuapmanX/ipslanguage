<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
 
uses(RefreshDatabase::class);

test('guest cant go to main page', function () {
    $response = $this->get('/');
    $response->assertRedirect('/login');
});

test('Logged in users can go to the main page', function (){
    $user = User::factory()->create();
    $this->actingAs($user)->get('/')->assertOk();
});

test('Administrators can go to admin panel',function(){
    $user = User::factory()->admin()->create();
    $this->actingAs($user)->get('/admin')->assertOk();
});

test('regular users cant go to admin panel',function(){
    $user = User::factory()->create();
    $response = $this->actingAs($user)->get('/admin');
    $response->assertRedirect('/');
});
//What tests can i make for this app that are not completely redundant?

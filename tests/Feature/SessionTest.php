<?php

use App\Models\User;

test('guest cant go to main page', function () {
    $response = $this->get('/');
    $response->assertRedirect('/login');
});

test('Logged in users can go to the main page', function (){
    $user = User::factory()->create();
    $this->actingAs($user)->get('/')->assertOk();
    User::destroy($user->id);
});
//What tests can i make for this app that are not completely redundant?

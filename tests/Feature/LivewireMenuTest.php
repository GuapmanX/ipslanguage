<?php




use App\Livewire\LanguageFilter;
use App\Livewire\TranslateMenu;
use App\Livewire\UserDisplay;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

test('Translate Menu gets rendered', function(){
    $menu = Livewire::test(TranslateMenu::class, [ 'default' => 'All' ]);
    $menu->assertStatus(200);
});

test('Filter Menu gets rendered', function(){
    $menu = Livewire::test(LanguageFilter::class);
    $menu->assertStatus(200);
});

test('User display gets rendered', function(){
    $menu = Livewire::test(UserDisplay::class, [ 'users' => User::where('is_admin', false)->get()]);
    $menu->assertStatus(200);
});



test('Filter can be changed', function(){
    $languages = config('languages');;
    $selectedLanguage = SelectRandomLanguage($languages)['Language'];

    $filter = Livewire::test(LanguageFilter::class);
    $filter->call('ChangeFilter',$selectedLanguage);
    
    expect($filter->SelectedFilter)->toBe($selectedLanguage);
});

test('Can change shown language in the menu',function(){
    $languages = config('languages');
    $selectedLanguage = SelectRandomLanguage($languages)['Language'];

    $menu = Livewire::test(TranslateMenu::class, [ 'default' => 'All' ]);
    $menu->dispatch("FilterChanged",$selectedLanguage);

    expect($menu->Filter)->toBe($selectedLanguage);
});
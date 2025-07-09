<?php




use App\Livewire\LanguageFilter;
use App\Livewire\TranslateMenu;
use Livewire\Livewire;
use Tests\TestCase;

test('Translate Menu gets rendered', function(){
    $menu = Livewire::test(TranslateMenu::class);
    $menu->assertStatus(200);
});

test('Filter Menu gets rendered', function(){
    $menu = Livewire::test(LanguageFilter::class);
    $menu->assertStatus(200);
});



test('Filter can be changed', function(){
    $languages = require base_path("resources/php/Languages.php");
    $selectedLanguage = SelectRandomLanguage($languages)['Language'];

    $filter = Livewire::test(LanguageFilter::class);
    $filter->call('ChangeFilter',$selectedLanguage);
    
    expect($filter->SelectedFilter)->toBe($selectedLanguage);
});

test('Can change shown languge in the menu',function(){
    $languages = require base_path("resources/php/Languages.php");
    $selectedLanguage = SelectRandomLanguage($languages)['Language'];

    $menu = Livewire::test(TranslateMenu::class);
    $menu->dispatch("FilterChanged",$selectedLanguage);

    expect($menu->Filter)->toBe($selectedLanguage);
});
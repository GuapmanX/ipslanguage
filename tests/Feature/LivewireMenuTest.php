<?php




use App\Livewire\LanguageFilter;
use App\Livewire\TranslateMenu;
use Livewire\Livewire;


test('Translate Menu gets rendered', function(){
    $menu = Livewire::test(TranslateMenu::class);
    $menu->assertStatus(200);
    expect($menu->Filter)->toBe("All");
});

/* test('Filter can be changed',function(){ //doesnt work
    //$menu = Livewire::test(TranslateMenu::class);
    $filter = Livewire::test(LanguageFilter::class);
    $filter->emit("FilterChanged","Polish");

    //expect($menu->Filter)->toBe("Polish");
}); */
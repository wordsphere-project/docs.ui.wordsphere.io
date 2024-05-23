<?php

namespace App\Livewire\Components;

use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layouts.docs')]
class Button extends Component
{
    public string $size = 'md';

    public string $label = 'Button';

    public array $sizeOptions = [
        'sm',
        'md',
        'lg',
        'xl'
    ];

    public function render()
    {
        return view('livewire.components.button');
    }
}

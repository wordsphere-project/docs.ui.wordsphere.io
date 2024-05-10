<?php

namespace App\Livewire\Pages\Docs;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.docs')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.docs.index');
    }
}

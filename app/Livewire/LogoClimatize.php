<?php

namespace App\Livewire;

use Livewire\Component;

class LogoClimatize extends Component
{
    public $width;
    public $height;

    public function render()
    {
        return view('livewire.logo-climatize', ['width' => $this->width, 'height' => $this->height]);
    }
}


<?php

namespace App\Livewire;

use Livewire\Component;

class SelectComponent extends Component
{
    public $selectedOption;
    public $label;
    public $filterType;

    public function mount($label, $filterType)
    {
        $this->label = $label;
        $this->filterType = $filterType;
    }

    public function render()
    {
        if ($this->filterType === 'empty') {
            $options = [
                'option1' => 'Opção 1',
                'option2' => 'Opção 2',
                'option3' => 'Opção 3',
            ];
        } else {
        }

        return view('livewire.select-component', [
            'options' => $options,
            'label' => $this->label,
            'filterType' => $this->filterType,
        ]);
    }
}

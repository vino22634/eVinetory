<?php

namespace App\View\Components;
namespace App\View\Components\bouteilles;


use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BouteilleComponent extends Component
{
    public $bouteille;

    public function __construct($bouteille)
    {
        $this->bouteille = $bouteille;
        //$this->bouteille->nom = 'test';
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bouteilles.bouteille-component');

    }
}

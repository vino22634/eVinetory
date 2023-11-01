<?php

namespace App\View\Components;
namespace App\View\Components\bouteilles;


use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BouteilleLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public $bouteille;

    public function __construct($bouteille)
    {
        $this->bouteille = $bouteille;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bouteilles.bouteille-component');
    }
}

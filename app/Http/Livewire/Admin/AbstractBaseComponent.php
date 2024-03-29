<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

abstract class AbstractBaseComponent extends Component
{
    abstract public function rules(): array;

    abstract public function store();

    abstract public function render();
}

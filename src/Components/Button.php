<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Pages\Actions\Concerns\HasAction;

class Button extends Field
{
    use HasAction;

    protected string $view = 'forms.components.button';
}

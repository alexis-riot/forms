<?php

namespace Filament\Forms2\Components;

use Illuminate\Support\Str;

class Section extends Component implements Contracts\CanConcealComponents
{
    protected string $view = 'forms2::components.section';

    protected $isCollapsed = false;

    protected $isCollapsible = false;

    protected $description = null;

    protected $heading;

    final public function __construct(string | callable $heading)
    {
        $this->heading($heading);
    }

    public static function make(string | callable $heading): static
    {
        $static = new static($heading);
        $static->setUp();

        return $static;
    }

    protected function setUp(): void
    {
        $this->columnSpan('full');
    }

    public function collapsed(bool | callable $condition = true): static
    {
        $this->isCollapsed = $condition;
        $this->collapsible($condition);

        return $this;
    }

    public function collapsible(bool | callable $condition = true): static
    {
        $this->isCollapsible = $condition;

        return $this;
    }

    public function description(string | callable | null $description = null): static
    {
        $this->description = $description;

        return $this;
    }

    public function heading(string | callable $heading): static
    {
        $this->heading = $heading;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->evaluate($this->description);
    }

    public function getHeading(): string
    {
        return $this->evaluate($this->heading);
    }

    public function getId(): ?string
    {
        if (! ($id = parent::getId())) {
            $id = Str::slug($this->getHeading());

            if ($statePath = $this->getStatePath()) {
                $id = "{$statePath}.{$id}";
            }
        }

        return $id;
    }

    public function isCollapsed(): bool
    {
        return (bool) $this->evaluate($this->isCollapsed);
    }

    public function isCollapsible(): bool
    {
        return (bool) $this->evaluate($this->isCollapsible);
    }
}

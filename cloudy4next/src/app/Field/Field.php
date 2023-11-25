<?php

namespace Cloudy4next\NativeCloud\App\Field;

class Field
{
    public string $name;
    public ?string $label;
    public ?string $type;
    public mixed $value;
    public ?string $placeHolder;
    public ?string $component;
    public ?array $componentData;

    public function __construct(string $name, ?string $label, ?string $type = "text", mixed $value = null, ?string $placeHolder = null, ?string $component = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->value = $value;
        $this->placeHolder = $placeHolder;
        $this->component = $component;
    }

    public static function init(string $name, ?string $label = null, ?string $type = "text", mixed $value = null, ?string $component = null): self
    {
        $newPlaceHolder = self::humnize($name) . '...';

        return new static($name, $label ?? self::humnize($name), $type ?? 'text', $value, $newPlaceHolder, $component);
    }

    private static function humnize(string $needle): string
    {
        return ucwords(str_replace('_', ' ', $needle));
    }

    public function setComponentData(?array $componentData): self
    {
        $this->componentData = $componentData;
        return $this;
    }
}

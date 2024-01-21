<?php

namespace IceAxe\NativeCloud\App\Field;


class Button
{
    public ?string $name;
    public ?string $label;
    public ?string $routeName;
    public const NEW = 'new';
    public const VIEW = 'view';
    public const EDIT = 'edit';
    public const DELETE = 'delete';
    public const CUSTOM = 'custom';

    public function __construct(string $name, ?string $label)
    {
        $this->name = $name;
        $this->label = $label;
    }

    public static function init(string $name, ?string $label = null): self
    {
        return new static($name, $label ?? self::humnize($name));
    }
    private static function humnize(string $needle): string
    {
        return ucwords(str_replace('_', ' ', $needle));
    }

    public function setRoute($route): self
    {
        $this->routeName = $route;
        return $this;
    }
}

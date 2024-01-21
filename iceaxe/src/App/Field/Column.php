<?php

namespace IceAxe\NativeCloud\App\Field;


class Column
{
    public string $name;
    public ?string $label;


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
}

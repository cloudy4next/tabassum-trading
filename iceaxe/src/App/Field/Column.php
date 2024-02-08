<?php

namespace IceAxe\NativeCloud\App\Field;


class Column extends TypeGenerators
{
    public string $name;
    public ?string $label;


    public static function init(string $name, ?string $label = null): self
    {

        return new static($name, $label ?? self::humanize($name));
    }

}

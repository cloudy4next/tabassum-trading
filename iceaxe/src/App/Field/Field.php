<?php

namespace IceAxe\NativeCloud\App\Field;


/**
 * @author IceAxe <jahngir7200@live.com>
 * @
 */
class Field
{
    public string $name;
    public ?string $label;
    public ?string $type;
    public mixed $value;
    public ?string $placeHolder;
    public ?string $component;


    /**
     * @param string $name
     * @param string|null $label
     * @param string|null $type
     * @param string|null $placeHolder
     * @param string|null $component
     */
    public function __construct(string $name, ?string $label, ?string $type = "text", ?string $placeHolder = null, ?string $component = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->placeHolder = $placeHolder;
    }

    public static function init(string $name, ?string $label = null, ?string $type = "text", ?string $component = null): self
    {
        $newPlaceHolder = self::humnize($name) . '...';

        return new static($name, $label ?? self::humnize($name), $type ?? 'text', $newPlaceHolder);
    }

    private static function humnize(string $needle): string
    {
        return ucwords(str_replace('_', ' ', $needle));
    }

    public function setData(mixed $value): self
    {
        $this->value = $value;
        return $this;
    }
    public function setComponent(String $component)
    {
        $this->component = $component;
        return $this;
    }

    public function getComponentName()
    {
        return $this->component;
    }
}

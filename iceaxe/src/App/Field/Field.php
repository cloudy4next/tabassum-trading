<?php

namespace IceAxe\NativeCloud\App\Field;



use IceAxe\NativeCloud\App\Constants\TypeConstants;

/**
 * @author IceAxe <jahngir7200@live.com>
 */
class Field extends TypeGenerators
{


    public static function init(string $name, ?string $label = null, ?string $type = TypeConstants::TEXT,?array $params= null ): self
    {
        $newPlaceHolder = self::humanize($name) . '...';

        return new static($name, $label ?? self::humanize($name), $type ?? TypeConstants::TEXT, $newPlaceHolder, $params);
    }


    public function setData(mixed $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function setComponent(string $component): static
    {
        $this->component = $component;
        return $this;
    }

    public function getComponentName(): ?string
    {
        return $this->component;
    }

}

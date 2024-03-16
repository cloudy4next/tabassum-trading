<?php

namespace IceAxe\NativeCloud\App\Field;


use IceAxe\NativeCloud\App\Constants\TypeConstants;

/**
 * @author IceAxe <jahngir7200@live.com>
 */
class Field extends TypeGenerators
{

    public string $classAttribute = 'col-md-6';


    public function getClassAttribute(): string
    {
        return $this->classAttribute;
    }

    public function setClassAttribute(string $classAttribute): self
    {
        $this->classAttribute = $classAttribute;
        return $this;
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

<?php

namespace IceAxe\NativeCloud\App\Field;

use IceAxe\NativeCloud\App\Constants\TypeConstants;
use IceAxe\NativeCloud\App\Services\Generators\FeatureBuilder;

abstract class TypeGenerators
{
    public string $name;
    public ?string $label;
    public ?string $type;
    public mixed $value;
    public ?string $placeHolder;
    public ?string $component;
    public ?array $params;
    public ?array $options;
    public FeatureBuilder $featureBuilder;


    /**
     * @param string $name
     * @param string|null $label
     * @param string|null $type
     * @param string|null $placeHolder
     * @param array|null $params
     */
    public function __construct(string $name, ?string $label, string $type = TypeConstants::TEXT, ?string $placeHolder = null, ?array $params = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->placeHolder = $placeHolder;
        $this->featureBuilder = new FeatureBuilder($type, $params ?? []);

    }

    public static function init(string $name, ?string $label = null, ?string $type = TypeConstants::TEXT, ?array $params = null): self
    {
        $newPlaceHolder = ($label != null) ? self::humanize($label) : self::humanize($name);
        $newPlaceHolder = $newPlaceHolder . '...';
        return new static($name, $label ?? self::humanize($name), $type ?? TypeConstants::TEXT, $newPlaceHolder, $params);
    }


    protected static function humanize(string $needle): string
    {
        return ucwords(str_replace('_', ' ', $needle));
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getFeatureBuilder(): ?FeatureBuilder
    {
        return $this->featureBuilder;
    }


}

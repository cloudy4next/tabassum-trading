<?php

namespace IceAxe\NativeCloud\App\Services\Generators;

use IceAxe\NativeCloud\App\Constants\TypeConstants;
use IceAxe\NativeCloud\App\Traits\HelperTrait;

final class FeatureBuilder
{
    use HelperTrait;

    private ?string $entity;
    private ?string $model;
    private ?string $foreign_key;
    private ?bool $pivot;

    public array $select2;

    public array $select;

    public mixed $options;

    public function __construct($type, $params)
    {
        $this->options = $params[TypeConstants::OPTIONS] ?? [];
        $this->pivot = $params[TypeConstants::PIVOT] ?? false;
        $this->entity = $params[TypeConstants::ENTITY] ?? null;
        $this->model = $params[TypeConstants::MODEL] ?? null;
        $this->foreign_key = $params[TypeConstants::FOREIGN_KEY] ?? null;
        $this->select2 = $this->getSelect2();
        $this->select = $this->getSelect();
    }


    public function getEntity(): ?string
    {
        return $this->entity;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function getForeignKey(): ?string
    {
        return $this->foreign_key;
    }

    public function getSelect2(): ?array
    {
        $this->select2 = [
            'entity' => $this->entity,
            'model' => $this->model,
            'foreign_key' => $this->foreign_key,
            'pivot' => $this->pivot
        ];
        return $this->select2;
    }

    private function getSelect(): array
    {
        return $this->options;
    }


}

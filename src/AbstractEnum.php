<?php

namespace Sfiolka\SfiolkaLib;

abstract class AbstractEnum
{
    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function instance(string $value)
    {
        $instance = new static($value);

        if (!in_array($value, $instance->possibleValues())) {
            throw new \Exception(
                sprintf(
                    '%s is not one of %s',
                    $value,
                    implode(', ', $instance->possibleValues())
                )
            );
        }

        return $instance;
    }

    public function string(): string
    {
        return $this->value;
    }

    public function equals(AbstractEnum $other): bool
    {
        return $this->string() === $other->string();
    }

    public function implodedValues(): string
    {
        return implode(
            ', ',
            array_map(
                function (string $value): string {
                    return "'{$value}'";
                },
                $this->possibleValues()
            )
        );
    }

    /**
     * @return string[]
     */
    abstract protected function possibleValues(): array;
}
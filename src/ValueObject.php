<?php

declare(strict_types=1);

namespace MichaelRubel\ValueObjects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;

abstract class ValueObject implements Arrayable
{
    use Macroable, Conditionable;

    /**
     * Get the object value.
     *
     * @return mixed
     */
    abstract public function value();

    /**
     * Convenient method to create a value object statically.
     *
     * @param  mixed  $values
     *
     * @return static
     */
    public static function make(mixed ...$values): static
    {
        return new static(...$values);
    }

    /**
     * Check if objects are instances of same class
     * and share the same properties and values.
     *
     * @param  ValueObject  $object
     *
     * @return bool
     */
    public function equals(ValueObject $object): bool
    {
        return $this == $object;
    }

    /**
     * Inversion for `equals` method.
     *
     * @param  ValueObject  $object
     *
     * @return bool
     */
    public function notEquals(ValueObject $object): bool
    {
        return ! $this->equals($object);
    }

    /**
     * Get the length of the value.
     *
     * @return int
     */
    public function length(): int
    {
        return strlen((string) $this->value());
    }

    /**
     * Get an array representation of the value object.
     *
     * @return array
     */
    public function toArray(): array
    {
        return (array) $this->value();
    }

    /**
     * Get string representation of the value object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->value();
    }

    /**
     * Make sure value object is immutable.
     *
     * @param  string  $name
     * @param  mixed  $value
     *
     * @return void
     */
    public function __set(string $name, mixed $value): void
    {
        throw new \InvalidArgumentException('Value objects are immutable. You cannot modify properties. Create a new object instead.');
    }
}

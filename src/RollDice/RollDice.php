<?php
declare(strict_types=1);

namespace Dsantang\DiceRoller\RollDice;

use JMS\Serializer\Annotation as Serializer;

final class RollDice
{
    /**
     * @Serializer\Type("int")
     */
    private int $faces;

    /**
     * @Serializer\Type("int")
     */
    private int $multiplier = 1;

    /**
     * @Serializer\Type("int")
     */
    private int $bonus = 0;

    public function __construct(int $faces, int $multiplier, int $additional)
    {
        $this->faces      = $faces;
        $this->multiplier = $multiplier;
        $this->bonus      = $additional;
    }

    public function getFaces(): int
    {
        return $this->faces;
    }

    public function getMultiplier(): int
    {
        return $this->multiplier;
    }

    public function getBonus(): int
    {
        return $this->bonus;
    }
}
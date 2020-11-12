<?php
declare(strict_types=1);

namespace Dsantang\DiceRoller\Dices;

/**
 * A deterministic dice.
 */
final class JackLuckyCharm implements Dice
{
    public function roll(): int
    {
        return 1;
    }

    public function rollMultiple(int $times): array
    {
        return array_fill(0, $times, 1);
    }
}
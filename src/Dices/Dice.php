<?php
declare(strict_types=1);

namespace Dsantang\DiceRoller\Dices;

interface Dice
{
    public function roll(): int;

    /**
     * @return int[]
     */
    public function rollMultiple(int $times): array;
}
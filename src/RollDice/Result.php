<?php
declare(strict_types=1);

namespace Dsantang\DiceRoller\RollDice;

final class Result
{
    public int $total;

    /**
     * @var int[]
     */
    public array $individualRolls;

    public int $bonus;

    public int $totalWithBonus;

    public function __construct(int $total, array $individualRolls, int $bonus, int $totalWithBonus)
    {
        $this->total           = $total;
        $this->individualRolls = $individualRolls;
        $this->bonus           = $bonus;
        $this->totalWithBonus  = $totalWithBonus;
    }
}
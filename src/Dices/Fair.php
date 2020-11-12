<?php
declare(strict_types=1);

namespace Dsantang\DiceRoller\Dices;

final class Fair implements Dice
{
    public const SUPPORTED_FACES = ['4', '6', '8', '12', '20'];

    private int $faces;

    public function __construct(int $faces)
    {
        $this->faces = $faces;
    }

    public function roll(): int
    {
        return rand(1, $this->faces);
    }

    /**
     * @return int[]
     */
    public function rollMultiple(int $times): array
    {
        $results = [];

        for ($i = 0; $i < $times; $i ++) {
            $results[] = rand(1, $this->faces);
        }

        return $results;
    }

    public function faces(): int
    {
        return $this->faces;
    }
}
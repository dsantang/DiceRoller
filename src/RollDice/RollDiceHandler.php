<?php
declare(strict_types=1);

namespace Dsantang\DiceRoller\RollDice;

use Dsantang\DiceRoller\Dices\Fair;

final class RollDiceHandler
{
    public function handle(RollDice $command)
    {
        $dice = new Fair($command->getFaces());

        $rolls = $dice->rollMultiple($command->getMultiplier());

        $total = array_sum($rolls);

        return new Result(
            $total,
            $rolls,
            $command->getBonus(),
            $total + $command->getMultiplier() * $command->getBonus()
        );
    }
}
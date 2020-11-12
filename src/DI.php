<?php
declare(strict_types=1);

namespace Dsantang\DiceRoller;

use Dsantang\DiceRoller\RollDice\RollDice;
use Dsantang\DiceRoller\RollDice\RollDiceHandler;
use JMS\Serializer\SerializerBuilder;

final class DI
{
    private const COMMAND = 'command';

    private const HANDLER = 'handler';

    public function buildContainer()
    {
        $arrayTransformer = SerializerBuilder::create()->build();

        $actionsMap = ['roll-dice' => [self::COMMAND => RollDice::class, self::HANDLER => RollDiceHandler::class]];

        $router = new Router($arrayTransformer, $actionsMap);

        return $router;
    }
}
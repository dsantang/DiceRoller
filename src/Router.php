<?php
declare(strict_types=1);

namespace Dsantang\DiceRoller;

use JMS\Serializer\ArrayTransformerInterface;
use Throwable;

final class Router
{
    private ArrayTransformerInterface $serializer;

    /**
     * @var array<string, <string, string>>
     */
    private array $actionsMap;

    public function __construct(ArrayTransformerInterface $serializer, array $actionsMap)
    {
        $this->serializer = $serializer;
        $this->actionsMap = $actionsMap;
    }

    /**
     * @return mixed|null
     */
    public function route(string $action)
    {
        try {
            $deserializedAction = json_decode($action, true);
        } catch (Throwable $exception) {
            return sprintf('Error handling request with content: %s', $action);
        }

        $actionName    = $deserializedAction['action'] ?? null;
        $actionContent = $deserializedAction['content'] ?? null;

        if ($actionName === null) {
            return 'Dude, this is not a valid request WTF. The "action" parameter is missing';
        }

        if ($actionContent === null) {
            return 'Dude, this is not a valid request WTF. The "content" parameter is missing';
        }

        $commandName = $this->actionsMap[$actionName]['command'];
        $handler     = $this->actionsMap[$actionName]['handler'];

        $command = $this->serializer->fromArray($actionContent, $commandName);
        $handler = new $handler();

        return json_encode($handler->handle($command));
    }
}
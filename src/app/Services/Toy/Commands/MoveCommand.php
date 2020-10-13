<?php

namespace App\Services\Toy\Commands;

use App\Services\Toy\Position;
use App\Services\Toy\Robot;
use App\Services\Toy\Table;

/**
 * class MoveCommand
 */
class MoveCommand implements CommandInterface
{
    /** executeCommand
     *  This function will execute command
     *  @param Table $table
     *  @param Robot $robot
     *  @param array $arguments
     *  @return bool
     */
    public function execute(Table $table, Robot $robot, array $arguments = []): bool {
        /** @var Position $position */
        $position = null;
        switch ($robot->getCurrentDirection()) {
            case "NORTH":
                $position = new Position(0, 1);
            break;
            case "SOUTH":
                $position = new Position(0, -1);
            break;
            case "EAST":
                $position = new Position(1, 0);
                break;
            case "WEST":
                $position = new Position(-1, 0);
                break;
        }

        if ($position instanceof Position) {
            $table->updatePositionCoordinates($position);
            return true;
        }
        return false;
    }
}

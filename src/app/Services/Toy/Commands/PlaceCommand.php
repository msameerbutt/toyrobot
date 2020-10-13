<?php

namespace App\Services\Toy\Commands;

use App\Services\Toy\Position;
use App\Services\Toy\Robot;
use App\Services\Toy\Table;

/**
 * class PlaceCommand
 */
class PlaceCommand implements CommandInterface
{
    /** executeCommand
     *  This function will execute command
     *  @param Table $table
     *  @param Robot $robot
     *  @param array $arguments
     *  @return bool
     */
    public function execute(Table $table, Robot $robot, array $arguments = []): bool {
        if (empty($arguments)) {
            return false;
        }

        if (count($arguments) < 3) {
            return false;
        }

        list ($x, $y, $direction) = $arguments;
        $table->place(new Position($x, $y));
        $robot->setCurrentDirection($direction);
        return $table->isPlaced();
    }
}

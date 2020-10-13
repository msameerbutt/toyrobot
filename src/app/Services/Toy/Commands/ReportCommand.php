<?php

namespace App\Services\Toy\Commands;

use App\Services\Toy\Robot;
use App\Services\Toy\Table;

/**
 * class ReportCommand
 */
class ReportCommand implements CommandInterface
{
    /** @var string */
    public $result;

    /** executeCommand
     *  This function will execute command
     *  @param Table $table
     *  @param Robot $robot
     *  @param array $arguments
     *  @return bool
     */
    public function execute(Table $table, Robot $robot, array $arguments = []): bool {
        $this->result = $table->getPositionCoordinates();
        $this->result[] = $robot->getCurrentDirection();
        return true;
    }
}

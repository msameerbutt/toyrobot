<?php
namespace App\Services\Toy;

use App\Services\Toy\Commands\CommandInterface;
use App\Services\Toy\Commands\PlaceCommand;
use App\Services\Toy\Commands\LeftCommand;
use App\Services\Toy\Commands\MoveCommand;
use App\Services\Toy\Commands\ReportCommand;
use App\Services\Toy\Commands\RightCommand;

/**
 * Class Play
 */
class Play
{
    /** @var Table */
    private $table;

    /** @var Robot */
    private $robot;

    /** @var array */
    private $commands = ['PLACE', 'MOVE', 'REPORT','LEFT','RIGHT'];

    /** @var array of Commands execute objects */
    private $executers = [];

    /**
     * Play Constructor.
     * Add dependencies here
     * @return void
     */
    public function __construct() {

    }

    /**
    * Initialize a Game
    * @param int $x
    * @param int $y
    * @return void
    */
    public function initialize(int $x, int $y) {
        $this->table = new Table($x, $y);
        $this->robot = new Robot();
    }

    /**
     * Execute a command
     * @param array $commands
     * @return mixed
     */
    public function  executeCommands(array $commands) {
        $reports = [];
        foreach($commands as $item) {
            $temp = (explode(' ', $item));
            $command = $temp[0];
            $args = isset($temp[1]) ? explode(',', $temp[1]) : [];
            $output = $this->executeCommand($command, $args);
            if (!empty($output) && is_array($output)) {
                $reports[] = $output;
            }
        }
        return $reports;
    }

    /**
     * Create or a command object based on command
     * @param string $command
     * @return void
     */
    private function  createCommand(string $command) {
        if (!isset($this->executers[$command])) {
            switch ($command) {
                case "PLACE" :
                    $this->executers[$command] = new PlaceCommand();
                    break;
                case "MOVE" :
                    $this->executers[$command] = new MoveCommand();
                    break;
                case "REPORT" :
                    $this->executers[$command] = new ReportCommand();
                    break;
                case "LEFT" :
                    $this->executers[$command] = new LeftCommand();
                    break;
                case "RIGHT" :
                    $this->executers[$command] = new RightCommand();
                    break;
            }
        }
    }

    /**
     * Get a command object based on command
     * @param string $command
     * @return CommandInterface
     */
    private function  getCommand(string $command): ? CommandInterface {
        if (!isset($this->executers[$command])) {
            return null;
        }
        return $this->executers[$command];
    }

    /**
     * Execute a command
     * @param string $command
     * @param array $arguments
     * @return mixeds
     */
    private function  executeCommand(string $command, array $arguments = []) {
        $command = trim($command);
        $this->createCommand($command);
        /** @var CommandInterface $commandInterface */
        $commandInterface = $this->getCommand($command);
        if ($commandInterface instanceof CommandInterface) {
            $commandInterface->execute($this->table, $this->robot, $arguments);
            if (property_exists($commandInterface, 'result')) {
                return $commandInterface->result;
            }
        }
        return null;
    }
}

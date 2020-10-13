<?php
namespace App\Services\Toy;

/**
 * Class Robot
 */
class Robot
{
    // All Possible directions
    private $directions = ['NORTH', 'EAST', 'SOUTH', 'WEST'];

    // All Possible directions
    private $currentDirection;

    /**
    * Change face of Robot to turn left
    * @return void
    */
    public function turnLeft() {
        if (!empty($this->currentDirection)) {
            $index = array_search($this->currentDirection, $this->directions);
            $newDirectionIndex = $index === 0 ? count($this->directions)-1 : $index-1;
            $this->setCurrentDirection($this->directions[$newDirectionIndex]);
        }
    }

    /**
    * Change face of Robot to turn left
    * @return void
    */
    public function turnRight() {
        if (!empty($this->currentDirection)) {
            $index = array_search($this->currentDirection, $this->directions);
            $newDirectionIndex = $index === count($this->directions)-1 ? 0 : $index+1;
            $this->setCurrentDirection($this->directions[$newDirectionIndex]);
        }
    }

    /**
    * Set current direction for the Robot
    * @param string $direction
    * @return void
    */
    public function setCurrentDirection(string $direction) {
        if (in_array(trim($direction), $this->directions)) {
            $this->currentDirection = trim($direction);
        }
    }

    /**
     * Set current direction for the Robot
     * @return string
     */
    public function getCurrentDirection(): string {
        return $this->currentDirection;
    }
}

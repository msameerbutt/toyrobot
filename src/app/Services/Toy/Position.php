<?php
namespace App\Services\Toy;

/**
 * Class Position
 */
class Position
{
    /** @var int */
    private $coordinateX;

    /** @var int */
    private $coordinateY;

    /**
     * Position Constructor.
     * Add dependencies here
     *
     * @param int $coordinateX
     * @param int $coordinateY
     * @return void
     */
    public function __construct(int $coordinateX, int $coordinateY) {
        $this->coordinateX = $coordinateX;
        $this->coordinateY = $coordinateY;
    }

    /**
     * Set Current Coordinates
     *
     * @param int $x
     * @param int $y
     * @return void
     */
    public function setCoordinates(int $x, int $y) {
        $this->coordinateX = $x;
        $this->coordinateY = $y;
    }

    /**
     * Get Current Coordinates
     *
     * @return array
     */
    public function getCoordinates():array {
        return [$this->coordinateX, $this->coordinateY];
    }
}

<?php
namespace App\Services\Toy;

/**
 * Class Table
 */
class Table
{
    /** @var Position */
    private $position;

    /** @var int */
    private $maxRows;

    /** @var int */
    private $maxCols;

    /**
     * Table Constructor.
     * Add dependencies here
     *
     * @param int $rows
     * @param int $cols
     * @return void
     */
    public function __construct(int $rows, int $cols) {
        $this->maxRows = $rows;
        $this->maxCols = $cols;
        $this->position = null;
    }

    /**
     * Check if Robot is placed on the table
     *
     * @return bool
     */
    public function isPlaced(): bool {
        return ($this->position instanceof Position) ? true : false;
    }

    /**
     * Place Robot on table at Position
     * @param Position $position
     *
     * @return void
     */
    public function place(Position $position) {
        if ($this->isValidPosition($position)) {
            $this->position = $position;
        }
    }

    /**
     * get Robot Position array
     * @param Position $position
     * @return void
     */
    public function updatePositionCoordinates(Position $position) {
        if ($this->isValidPosition($position)) {
            [$newX, $newY] = $position->getCoordinates();
            [$x, $y] = $this->getPositionCoordinates();
            $this->position->setCoordinates(($x+$newX), ($y+$newY));
        }
    }

    /**
     * get Robot Position array
     *
     * @return array
     */
    public function getPositionCoordinates(): array {
        return $this->position->getCoordinates();
    }

    /**
     * Check if Robot is placed on the table
     * @param Position $position
     *
     * @return bool
     */
    private function isValidPosition(Position $position): bool {
        [$x, $y] = $position->getCoordinates();
        if ($x < 0 || $x > $this->maxRows || $y < 0 || $y > $this->maxCols) {
            return false;
        }
        return true;
    }
}

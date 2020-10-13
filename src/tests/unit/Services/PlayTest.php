<?php namespace Services;

use App\Services\Toy\Play;

class PlayTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var Play
     */
    protected $play;

    /**
     * This Function will be used for dependency injection
     * @param Play $play
     *
     * @return void
     */
    protected function _inject(Play $play) {
        $this->play = $play;
    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testExecute()
    {
        # Simple Scenario expected output is 3,3,NORTH
        $commands = [
            'PLACE 1,2,EAST',
            'MOVE',
            'MOVE',
            'LEFT',
            'MOVE',
            'REPORT'
        ];

        $this->play->initialize(5, 5);
        $output = $this->play->executeCommands($commands);
        $output = $output[0];
        $this->assertIsArray($output);
        $this->assertEquals(3, count($output));
        list($x, $y, $face) = $output;
        $this->assertEquals('3,3,NORTH', sprintf('%s,%s,%s', $x, $y, $face));


        # Simple Scenario expected output is 0,0,WEST
        $commands = [
            'PLACE 0,0,NORTH',
            'LEFT',
            'REPORT'
        ];

        $output = $this->play->executeCommands($commands);
        $output = $output[0];
        $this->assertIsArray($output);
        $this->assertEquals(3, count($output));
        list($x, $y, $face) = $output;
        $this->assertEquals('0,0,WEST', sprintf('%s,%s,%s', $x, $y, $face));

        # SCENARIO: IGNORE COMMAND BEFORE A FIRST VALID PLACE COMMAND
        $commands = [
            'MOVE',
            'MOVE',
            'LEFT',
            'PLACE 0,0,NORTH',
            'LEFT',
            'REPORT'
        ];

        $output = $this->play->executeCommands($commands);
        $output = $output[0];
        $this->assertIsArray($output);
        $this->assertEquals(3, count($output));
        list($x, $y, $face) = $output;
        $this->assertEquals('0,0,WEST', sprintf('%s,%s,%s', $x, $y, $face));


        # SCENARIO: IGNORE COMMAND UNTIL A FIRST VALID PLACE COMMAND
        $commands = [
            'MOVE',
            'MOVE',
            'LEFT',
            'PLACE 4,6,SOUTH',
            'LEFT',
            'MOVE',
            'MOVE',
            'PLACE 0,0,NORTH',
            'LEFT',
            'RIGHT',
            'REPORT'
        ];

        $output = $this->play->executeCommands($commands);
        $output = $output[0];
        $this->assertIsArray($output);
        $this->assertEquals(3, count($output));
        list($x, $y, $face) = $output;
        $this->assertEquals('0,0,NORTH', sprintf('%s,%s,%s', $x, $y, $face));
    }
}

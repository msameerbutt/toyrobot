<?php
namespace App\Http\Controllers;

use App\Services\Toy\Play;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * This ToyRobotController class
 */
class ToyRobotController extends Controller
{
    /**
     * This function is remote-method-invoke on V2 by API
     *
     * @param Request $request
     * @param Play $play
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function html(Request $request, Play $play)
    {
        $param = $request->all();
        $commands = isset($param['commands']) ? $param['commands']: null;
        $view['commands'] = $commands;
        $view['result'] = [];
        if (!empty($commands)) {
            $commands = explode("\n", $commands);
            $commands = array_filter($commands, 'trim');

            $play->initialize(5, 5);
            $view['result'] = $play->executeCommands($commands);
        }

        $view['result'] = isset($view['result'][0]) ? $view['result'][0] : [];
        return view('toyrobot', $view);
    }
}

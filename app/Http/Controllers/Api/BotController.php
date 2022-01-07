<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BotCreateFormRequest;
use App\Services\BotService;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function get(Request $request) {
        $bots = $request->user()->bots()->orderBy('id', 'DESC')->get();
        if ($sort = $request->get('sort')) {
            $bots = $request->user()->bots()->orderBy($sort['field'], $sort['case'])->get();
        }

        return response()->json(['list' => $bots]);
    }

    public function create(BotCreateFormRequest $request, BotService $botService) {
        $botService->createBot($request->user(), [
            'api_key' => $request->get('api_key'),
            'local_name' => $request->get('local_name')
        ]);

        return response()->json([], 201);
    }
}

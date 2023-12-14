<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BotCreateFormRequest;
use App\Http\Resources\BotResource;
use App\Models\Bot;
use App\Services\BotService;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Bot::class, 'bot');
    }

    public function index(Request $request)
    {
        $field = 'id';
        $case = 'DESC';

        if ($sort = $request->get('sort')) {
            $field = $sort['field'];
            $case = $sort['case'];
        }

        $bots = Bot::forUser($request->user())
            ->orderBy($field, $case)
            ->get();

        return BotResource::collection($bots);
    }

    public function store(BotCreateFormRequest $request, BotService $botService)
    {
        $botService->createBot($request->user(), [
            'api_key' => $request->get('api_key'),
            'local_name' => $request->get('local_name')
        ]);

        return response()->json([], 201);
    }
}

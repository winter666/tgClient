<?php

namespace App\Http\Controllers\Api;

use App\Actions\Bot\CreateBotAction;
use App\Actions\Bot\UpdateBotAction;
use App\DataObjects\Bot\CreateBotData;
use App\DataObjects\Bot\UpdateBotData;
use App\Exceptions\User\ReachedBotLimitException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bot\CreateBotFormRequest;
use App\Http\Requests\Bot\UpdateBotFormRequest;
use App\Http\Resources\BotResource;
use App\Models\Bot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BotController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Bot::class, 'bot');
    }

    public function index(Request $request): JsonResource
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

    public function store(CreateBotFormRequest $request, CreateBotAction $action): JsonResponse
    {
        try {
            $action->handle(
                CreateBotData::fromRequest($request)
            );

            return response()->json([], 201);
        } catch (ReachedBotLimitException $e) {
            return response()->json([], 403);
        }
    }

    public function show(Bot $bot): JsonResource
    {
        return BotResource::make($bot);
    }

    public function update(
        Bot $bot,
        UpdateBotFormRequest $request,
        UpdateBotAction $action
    ): JsonResource
    {
        $updatedBot = $action->handle(
            $bot,
            UpdateBotData::fromRequest($request),
        );

        return BotResource::make($updatedBot);
    }

    public function destroy(Bot $bot): JsonResponse
    {
        $bot->delete();

        return response()->json([], 204);
    }
}

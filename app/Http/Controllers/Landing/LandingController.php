<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index() {
        $pricingArr = [
            [
                'id' => 1,
                'name' => 'Trial',
                'description' => 'Get free trial plan with only one telegram bot!',
                'price' => 'FREE',
                'bot_count' => 1
            ],
            [
                'id' => 2,
                'name' => 'Standard',
                'description' => 'Get standard plan with three telegram bots!',
                'price' => '7$/month',
                'bot_count' => 3
            ],
            [
                'id' => 3,
                'name' => 'Premium',
                'description' => 'Get premium plan with seven telegram bot!',
                'price' => '10$/month',
                'bot_count' => 7
            ]
        ];
        $pricing = [];
        foreach ($pricingArr as $price) {
            $obj = new \stdClass;
            $obj->id = $price['id'];
            $obj->name = $price['name'];
            $obj->description = $price['description'];
            $obj->price = $price['price'];
            $obj->bot_count = $price['bot_count'];
            $pricing[] = $obj;
        }

        $pricing = collect($pricing);
        return view('landing.main.index', compact('pricing'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Subscribers;
use Illuminate\Http\Request;
use App\Http\Requests\SubscribeWebsiteRequest;

class SubscribersController extends Controller
{
    public function subscribeToWebsite(SubscribeWebsiteRequest $request) {
        $subscribeData = $request->validated();
        $subscriberId = $subscribeData['user_id'];
        $websiteId = $subscribeData['website_id'];
        
        $isSubscribed = Subscribers::where(['subscriber_id' => $subscriberId, 'website_id' => $websiteId])->first();

        if($isSubscribed) {
            return response()->json([
                "message" => "You've already subscribed to this website",
                "data" => $isSubscribed
            ], 400);
        }

        $createSubscriber = Subscribers::create([
            "website_id" => $websiteId,
            "subscriber_id" => $subscriberId
        ]);

        if(!$createSubscriber) {
            return response()->json([
                "message" => "Error adding user to website subscribers list",
                "data" => []
            ], 400);
        }
        
        return response()->json([
            "message" => "User added to website subscribers list",
            "data" => $createSubscriber
        ], 200);
    }
}

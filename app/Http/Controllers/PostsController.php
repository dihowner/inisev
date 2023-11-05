<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Posts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\AddWebPostRequest;
use App\Models\SubscribedUserNotify;
use App\Models\Subscribers;

class PostsController extends Controller
{
    public function createWebsitePost(AddWebPostRequest $request) {
        try {
            $webPostData =  $request->validated();

            $websiteId = $webPostData['website_id'];
            
            DB::beginTransaction();
            $createPost = Posts::create([
                "website_id" => $websiteId,
                "post_topic" => $webPostData['post_title'],
                "post_content" => $webPostData['post_content'],
            ]);

            if($createPost) {
                // Get the list of all subscribers for this websites, create a log for them inorder to mail them of the new topic...
                $allSubscribers = Subscribers::where(['website_id' => $websiteId])->get();
                $totalSubscribers = $allSubscribers->count();

                $notifierCounts = 0;

                foreach($allSubscribers as $subscriberIndex => $subscriberInfo) {
                    $subscriberId = $subscriberInfo['subscriber_id'];

                    $createNotifiers = SubscribedUserNotify::create([
                        "subscriber_id" => $subscriberId,
                        "website_id" => $websiteId,
                        "post_id" => $createPost->id,
                        "status" => "new"
                    ]);
                    if($createNotifiers) { $notifierCounts++; }
                }

                if($notifierCounts == $totalSubscribers) {
                    DB::commit();
                    return response()->json([
                        "message" => "Post created successfully",
                        "data" => $createPost
                    ], 200); 
                }
                DB::rollBack();
                return response()->json([
                    "message" => "Error creating notification for subscribers. Please try creating post again",
                    "data" => []
                ], 400); 
            }

            DB::rollBack();
            return response()->json([
                "message" => "Error creating website post",
                "data" => []
            ], 400);

        }
        catch(Exception $e) {
            Log::channel('daily')->info($e->getMessage());
        }
    }
}

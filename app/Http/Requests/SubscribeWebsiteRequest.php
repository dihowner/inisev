<?php

namespace App\Http\Requests;

class SubscribeWebsiteRequest extends AuthorizeRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "website_id" => "numeric|required|exists:websites,id",
            "user_id" => "numeric|required|exists:users,id",
        ];
    }
}

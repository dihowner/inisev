<?php

namespace App\Http\Requests;

class AddWebPostRequest extends AuthorizeRequest
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
            "post_title" => "string|required|unique:posts,post_topic",
            "post_content" => "string|required"
        ];
    }
}

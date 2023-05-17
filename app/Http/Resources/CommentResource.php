<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'post_id' => $this->post_id,
            'comment_content' => $this->comment_content,
            'user_id' => $this->user_id,
            'comentator' => $this->whenLoaded('commentator'),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d')
        ];
    }
}

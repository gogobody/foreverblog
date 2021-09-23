<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Blogs extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'avatar' => $this->avatar,
            'name' => $this->name,
            'date' => $this->created_at->format('Y-m-d'),
            'message' => $this->message,
            'link' => $this->link,
            'feed_link' => $this->feed_link,
            'url' => url("/blog/{$this->id}.html")
        ];
        if($request->input('feed')){
            $data['feed_content'] = $this->feedsource();
        }
        return $data;
    }
}

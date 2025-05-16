<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'author' => $this->author,
            'price' => $this->price,
            'image_path' => $this->when('image_path', function () {
                if (!$this->image_path) {
                    return null;
                }
                return Storage::disk('public')->url($this->image_path);
            })
        ];
    }
}

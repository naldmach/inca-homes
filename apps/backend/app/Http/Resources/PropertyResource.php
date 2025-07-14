<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'property_type' => $this->property_type,
            'address' => $this->address,
            'city' => $this->city,
            'province' => $this->province,
            'country' => $this->country,
            'location' => [
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ],
            'capacity' => [
                'max_guests' => $this->max_guests,
                'bedrooms' => $this->bedrooms,
                'bathrooms' => $this->bathrooms,
            ],
            'pricing' => [
                'price_per_night' => $this->price_per_night,
                'cleaning_fee' => $this->cleaning_fee,
                'security_deposit' => $this->security_deposit,
            ],
            'amenities' => $this->amenities,
            'is_active' => $this->is_active,
            'images' => PropertyImageResource::collection($this->whenLoaded('images')),
            'host' => new UserResource($this->whenLoaded('user')),
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')),
            'average_rating' => $this->reviews->avg('rating'),
            'total_reviews' => $this->reviews->count(),
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
        ];
    }
}

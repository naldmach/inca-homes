<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $properties = QueryBuilder::for(Property::class)
            ->with(['user', 'images'])
            ->allowedFilters(['city', 'property_type', 'max_guests'])
            ->allowedSorts(['price_per_night', 'created_at'])
            ->where('is_active', true)
            ->paginate(20);

        return PropertyResource::collection($properties);
    }

    public function store(StorePropertyRequest $request)
    {
        $property = Property::create([
            'user_id' => auth()->id(),
            ...$request->validated()
        ]);

        return new PropertyResource($property->load('user', 'images', 'reviews.user'));
    }

    public function update(StorePropertyRequest $request, Property $property)
    {
        $this->authorize('update', $property);

        $property->update($request->validated());

        return new PropertyResource($property->load('user', 'images'));
    }

    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);

        $property->delete();

        return response()->json(['message' => 'Property deleted successfully']);
    }
}

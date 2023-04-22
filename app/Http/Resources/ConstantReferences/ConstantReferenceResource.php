<?php

namespace App\Http\Resources\ConstantReferences;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConstantReferenceResource extends JsonResource
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
            'temperatureMin' => $this->temperatureMin,
            'temperatureMax' => $this->temperatureMax,
            'rate' => $this->rate
        ];
    }
}

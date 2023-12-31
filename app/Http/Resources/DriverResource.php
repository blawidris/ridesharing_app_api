<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
{
    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public $preserveKeys = false;
    public static $wrap = 'drivers';

    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "year" => $this->year,
            "make" => $this->make,
            "model" => $this->model,
            "color" => $this->color,
            "license_plate" => $this->license_plate,
            'user' => new UserResource($this->user)
        ];
    }
}

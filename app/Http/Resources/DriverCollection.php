<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DriverCollection extends ResourceCollection
{
    // public $collects = Member::class;

    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection
        ];
    }
}
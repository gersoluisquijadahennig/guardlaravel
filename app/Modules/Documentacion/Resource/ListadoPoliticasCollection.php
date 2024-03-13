<?php

namespace App\Modules\Documentacion\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ListadoPoliticasCollection extends ResourceCollection
{
    public function toCollection($request)
    {
        return $this->collection->map(function ($request){
            return [
                'politica_id' => $request->politica_id,
            ];
        });
    }
}

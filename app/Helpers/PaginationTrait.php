<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;

trait PaginationTrait
{
    public function paginate(LengthAwarePaginator $paginator, string $resource)
    {
        return [
            'paginator' => [
                'links' => $paginator->linkCollection(),
                'meta' => [
                    'pages' => [
                        'current' => $paginator->currentPage(),
                        'total' => $paginator->lastPage(),
                    ],
                    'items' => [
                        'per_page' => $paginator->perPage(),
                        'total' => $paginator->total(),
                        'displayed' => $paginator->count(),
                    ]
                ]
            ],
            'items' => $resource ? $resource::collection($paginator->items()) : $paginator->items()
        ];
    }
}

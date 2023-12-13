<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Data as BaseData;

abstract class Data extends BaseData
{
    protected static string $_collectionClass = DataCollection::class;

    protected static string $_paginatedCollectionClass = PaginatedDataCollection::class;

    protected static string $_cursorPaginatedCollectionClass = CursorPaginatedDataCollection::class;
}

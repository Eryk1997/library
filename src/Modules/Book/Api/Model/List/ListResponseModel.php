<?php

declare(strict_types=1);

namespace App\Modules\Book\Api\Model\List;

use App\Modules\Book\Domain\ValueObject\QueryResult\ListBookQueryResultVO;
use App\Shared\Application\ValueObject\PaginatorVO;

final readonly class ListResponseModel
{
    public function __construct(
        public string $title,
        public string $author,
        public int $isbn,
        public int $yearPublished,
    ) {
    }

    /**
     * @param PaginatorVO<ListBookQueryResultVO> $paginatorVO
     *
     * @return self[]
     */
    public static function fromPaginatorVO(PaginatorVO $paginatorVO): array
    {
        return array_map(self::fromListBookQueryResultVO(...), $paginatorVO->data);
    }

    public static function fromListBookQueryResultVO(ListBookQueryResultVO $data): self
    {
        return new self(
            title: $data->title,
            author: $data->author,
            isbn: $data->isbn,
            yearPublished: $data->yearPublished,
        );
    }
}

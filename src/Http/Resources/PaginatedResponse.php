<?php declare(strict_types = 1);

namespace LastDragon_ru\LaraASP\Spa\Http\Resources;

use Illuminate\Http\Resources\Json\PaginatedResourceResponse;

/**
 * @internal
 */
class PaginatedResponse extends PaginatedResourceResponse {
    /**
     * @inheritdoc
     *
     * @return array<mixed>
     */
    protected function paginationInformation($request): array {
        return [
            'meta' => parent::paginationInformation($request)['meta'],
        ];
    }

    /**
     * @inheritdoc
     *
     * @param array<mixed> $paginated
     *
     * @return array<mixed>
     */
    protected function meta($paginated): array {
        return [
            'current_page' => (int) $paginated['current_page'],
            'last_page'    => isset($paginated['last_page'])
                ? (int) $paginated['last_page']
                : null,
            'per_page'     => (int) $paginated['per_page'],
            'total'        => isset($paginated['total'])
                ? (int) $paginated['total']
                : null,
            'from'         => (int) $paginated['from'],
            'to'           => (int) $paginated['to'],
        ];
    }

    /**
     * @inheritdoc
     *
     * @param array<mixed> $data
     */
    protected function haveDefaultWrapperAndDataIsUnwrapped($data): bool {
        // Our Resources always unwrapped and we always need a wrapper for
        // paginated results.
        return true;
    }

    /**
     * @inheritdoc
     */
    protected function wrapper() {
        return 'items';
    }
}

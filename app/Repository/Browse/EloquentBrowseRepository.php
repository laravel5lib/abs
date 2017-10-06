<?php

namespace App\Repository\Browse;

use App\Model\Browse;

class EloquentBrowseRepository implements BrowseRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function listAll($paginate = 100)
    {
        $cache_key = 'browse.list.all.' . request()->input('page', 1);

        $lists = cache()->remember($cache_key, 60, function () use ($paginate) {
            return $this->browse->withCount('browseItems')
                                ->orderBy('browse_items_count', 'desc')
                                ->paginate($paginate);
        });

        return $lists;
    }

    /**
     * @var Browse
     */
    protected $browse;

    /**
     *
     * @param Browse $browse
     */
    public function __construct(Browse $browse)
    {
        $this->browse = $browse;
    }

    /**
     * @inheritDoc
     */
    public function exportCursor(
        string $category,
        string $order = 'updated_at',
        string $sort = 'desc',
        int $limit = 1000
    ) {
        return $this->browse->findOrFail($category)
                            ->items()
                            ->orderBy($order, $sort)
                            ->take($limit)
                            ->cursor();
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return $this->browse->count('id');
    }

    /**
     * @inheritDoc
     */
    public function findOrFail(int $id)
    {
        return $this->browse->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->browse->updateOrCreate($attributes, $values);
    }
}
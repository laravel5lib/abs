<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Browse extends Model
{
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
    ];

    public function browseWatches()
    {
        return $this->hasMany(BrowseWatch::class);
    }
}

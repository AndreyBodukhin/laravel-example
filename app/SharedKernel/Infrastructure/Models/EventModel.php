<?php

namespace App\SharedKernel\Infrastructure\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * App\SharedKernel\Infrastructure\Models\EventModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel query()
 * @mixin Eloquent
 */
final class EventModel extends Model
{
    protected $table = 'events';
    public $timestamps = true;
}

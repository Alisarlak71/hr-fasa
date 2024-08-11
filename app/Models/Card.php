<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property string $orderable_type
 * @property int $orderable_id
 * @property int $count
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Card newModelQuery()
 * @method static Builder|Card newQuery()
 * @method static Builder|Card query()
 * @method static Builder|Card whereCount($value)
 * @method static Builder|Card whereCreatedAt($value)
 * @method static Builder|Card whereId($value)
 * @method static Builder|Card whereOrderableId($value)
 * @method static Builder|Card whereOrderableType($value)
 * @method static Builder|Card whereUpdatedAt($value)
 * @method static Builder|Card whereUserId($value)
 * @mixin Eloquent
 */
class Card extends Model
{
    use HasFactory;

    public function orderable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }


}

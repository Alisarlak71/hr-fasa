<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $body
 * @property int $user_id
 * @property int $ticket_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|TicketMessage newModelQuery()
 * @method static Builder|TicketMessage newQuery()
 * @method static Builder|TicketMessage query()
 * @method static Builder|TicketMessage whereBody($value)
 * @method static Builder|TicketMessage whereCreatedAt($value)
 * @method static Builder|TicketMessage whereId($value)
 * @method static Builder|TicketMessage whereTicketId($value)
 * @method static Builder|TicketMessage whereUpdatedAt($value)
 * @method static Builder|TicketMessage whereUserId($value)
 * @property int|null $is_read
 * @method static Builder|TicketMessage whereIsRead($value)
 * @mixin Eloquent
 */
class TicketMessage extends Model
{
    use HasFactory;
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'form');
    }
}

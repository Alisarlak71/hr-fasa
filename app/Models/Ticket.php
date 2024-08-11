<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use React\Dns\Model\Message;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $subject_id
 * @property string $title
 * @property int $priority
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $status
 * @method static Builder|Ticket newModelQuery()
 * @method static Builder|Ticket newQuery()
 * @method static Builder|Ticket query()
 * @method static Builder|Ticket whereCreatedAt($value)
 * @method static Builder|Ticket whereId($value)
 * @method static Builder|Ticket wherePriority($value)
 * @method static Builder|Ticket whereStatus($value)
 * @method static Builder|Ticket whereSubjectId($value)
 * @method static Builder|Ticket whereTitle($value)
 * @method static Builder|Ticket whereUpdatedAt($value)
 * @method static Builder|Ticket whereUserId($value)
 * @mixin Eloquent
 */
class Ticket extends Model
{
    use HasFactory;

    public function messages(): HasMany
    {
        return $this->hasMany(TicketMessage::class,'ticket_id');
    }

    public function unreadMessages(): HasMany
    {
        return $this->hasMany(TicketMessage::class,'ticket_id')->where('is_read',false);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(User::class,'subject_id');
    }
}

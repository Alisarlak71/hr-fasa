<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;


/**
 *
 *
 * @property int $id
 * @property string|null $ip
 * @property string|null $user_agent
 * @property string $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User|null $user
 * @method static Builder|SignIn newModelQuery()
 * @method static Builder|SignIn newQuery()
 * @method static Builder|SignIn query()
 * @method static Builder|SignIn whereCreatedAt($value)
 * @method static Builder|SignIn whereId($value)
 * @method static Builder|SignIn whereIp($value)
 * @method static Builder|SignIn whereUpdatedAt($value)
 * @method static Builder|SignIn whereUserAgent($value)
 * @method static Builder|SignIn whereUserId($value)
 * @mixin Eloquent
 */
class SignIn extends Model
{
    use HasFactory;
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

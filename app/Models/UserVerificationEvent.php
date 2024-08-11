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
 * @property int $user_verification_request_id
 * @property string|null $description
 * @property string|null $details
 * @property int $user_id
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|UserVerificationEvent newModelQuery()
 * @method static Builder|UserVerificationEvent newQuery()
 * @method static Builder|UserVerificationEvent query()
 * @method static Builder|UserVerificationEvent whereCreatedAt($value)
 * @method static Builder|UserVerificationEvent whereDescription($value)
 * @method static Builder|UserVerificationEvent whereDetails($value)
 * @method static Builder|UserVerificationEvent whereId($value)
 * @method static Builder|UserVerificationEvent whereStatus($value)
 * @method static Builder|UserVerificationEvent whereUpdatedAt($value)
 * @method static Builder|UserVerificationEvent whereUserId($value)
 * @method static Builder|UserVerificationEvent whereUserVerificationRequestId($value)
 * @mixin Eloquent
 */
class UserVerificationEvent extends Model
{
    use HasFactory;

    public function verifyRequest(): BelongsTo
    {
        return $this->belongsTo(UserVerificationRequest::class,'user_verification_request_id');
    }
}

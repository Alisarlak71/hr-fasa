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
 * @property string|null $username
 * @property string|null $kernel_order_no
 * @property string|null $order_no
 * @property string|null $time
 * @property string|null $symbol
 * @property string|null $date
 * @property string|null $post
 * @property string|null $international_id
 * @property string|null $trader_code
 * @property string|null $burse_code
 * @property string|null $volume
 * @property string|null $price
 * @property string|null $done_volume
 * @property int|null $status
 * @property string|null $error
 * @property string|null $accounting
 * @property string|null $name
 * @property int $user_id
 * @property int $company_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Report newModelQuery()
 * @method static Builder|Report newQuery()
 * @method static Builder|Report query()
 * @method static Builder|Report whereAccounting($value)
 * @method static Builder|Report whereBurseCode($value)
 * @method static Builder|Report whereCompanyId($value)
 * @method static Builder|Report whereCreatedAt($value)
 * @method static Builder|Report whereDate($value)
 * @method static Builder|Report whereDoneVolume($value)
 * @method static Builder|Report whereError($value)
 * @method static Builder|Report whereId($value)
 * @method static Builder|Report whereInternationalId($value)
 * @method static Builder|Report whereKernelOrderNo($value)
 * @method static Builder|Report whereName($value)
 * @method static Builder|Report whereOrderNo($value)
 * @method static Builder|Report wherePost($value)
 * @method static Builder|Report wherePrice($value)
 * @method static Builder|Report whereStatus($value)
 * @method static Builder|Report whereSymbol($value)
 * @method static Builder|Report whereTime($value)
 * @method static Builder|Report whereTraderCode($value)
 * @method static Builder|Report whereUpdatedAt($value)
 * @method static Builder|Report whereUserId($value)
 * @method static Builder|Report whereUsername($value)
 * @method static Builder|Report whereVolume($value)
 * @mixin Eloquent
 */
class Report extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

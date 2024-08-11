<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property int $order_item
 * @property string $orderable_type
 * @property int $order_id
 * @property int $orderable_id
 * @property float $unit_price
 * @property float $total_price
 * @property float $total_price_after_discount
 * @property float|null $discount
 * @property string|null $details
 * @property int $count
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|OrderItem newModelQuery()
 * @method static Builder|OrderItem newQuery()
 * @method static Builder|OrderItem query()
 * @method static Builder|OrderItem whereCount($value)
 * @method static Builder|OrderItem whereCreatedAt($value)
 * @method static Builder|OrderItem whereDetails($value)
 * @method static Builder|OrderItem whereDiscount($value)
 * @method static Builder|OrderItem whereId($value)
 * @method static Builder|OrderItem whereOrderId($value)
 * @method static Builder|OrderItem whereOrderItem($value)
 * @method static Builder|OrderItem whereOrderableId($value)
 * @method static Builder|OrderItem whereOrderableType($value)
 * @method static Builder|OrderItem whereTotalPrice($value)
 * @method static Builder|OrderItem whereTotalPriceAfterDiscount($value)
 * @method static Builder|OrderItem whereUnitPrice($value)
 * @method static Builder|OrderItem whereUpdatedAt($value)
 * @mixin Eloquent
 */
class OrderItem extends Model
{
    use HasFactory;

    public function orderable(): MorphTo
    {
        return $this->morphTo();
    }
}

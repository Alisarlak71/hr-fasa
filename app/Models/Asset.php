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
 * @property string|null $symbol
 * @property int|null $sent_order
 * @property string|null $percent_of_portfolio
 * @property int|null $retained_asset
 * @property int|null $break_even_price
 * @property int|null $stock_price
 * @property int|null $percentage_change
 * @property int|null $pure_sell_price
 * @property int|null $profit_loss
 * @property int|null $retained_profit_loss
 * @property int|null $percentage_retained_profit_loss
 * @property int $user_id
 * @property int $company_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Asset newModelQuery()
 * @method static Builder|Asset newQuery()
 * @method static Builder|Asset query()
 * @method static Builder|Asset whereBreak_even_price($value)
 * @method static Builder|Asset whereCompanyId($value)
 * @method static Builder|Asset whereCreatedAt($value)
 * @method static Builder|Asset whereId($value)
 * @method static Builder|Asset wherePercentOfPortfolio($value)
 * @method static Builder|Asset wherePercentageRetainedProfitLoss($value)
 * @method static Builder|Asset wherePercentageChange($value)
 * @method static Builder|Asset whereProfitLoss($value)
 * @method static Builder|Asset wherePureSellPrice($value)
 * @method static Builder|Asset whereRetainedAsset($value)
 * @method static Builder|Asset whereRetainedProfitLoss($value)
 * @method static Builder|Asset whereSentOrder($value)
 * @method static Builder|Asset whereStockPrice($value)
 * @method static Builder|Asset whereSymbol($value)
 * @method static Builder|Asset whereUpdatedAt($value)
 * @method static Builder|Asset whereUserId($value)
 * @mixin Eloquent
 */
class Asset extends Model
{
    use HasFactory;
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

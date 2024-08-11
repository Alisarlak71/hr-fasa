<?php

namespace App\Models;

use Database\Factories\SubscriptionFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $time
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Subscription newModelQuery()
 * @method static Builder|Subscription newQuery()
 * @method static Builder|Subscription query()
 * @method static Builder|Subscription whereCreatedAt($value)
 * @method static Builder|Subscription whereDeletedAt($value)
 * @method static Builder|Subscription whereDescription($value)
 * @method static Builder|Subscription whereId($value)
 * @method static Builder|Subscription whereStatus($value)
 * @method static Builder|Subscription whereTime($value)
 * @method static Builder|Subscription whereTitle($value)
 * @method static Builder|Subscription whereUpdatedAt($value)
 * @property float|null $price
 * @method static SubscriptionFactory factory($count = null, $state = [])
 * @method static Builder|Subscription wherePrice($value)
 * @mixin Eloquent
 */
class Subscription extends Model
{
    use HasFactory, SoftDeletes;
}

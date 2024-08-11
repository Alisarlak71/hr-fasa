<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string|null $form_type
 * @property int|null $form_id
 * @property int $type
 * @property string $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|File newModelQuery()
 * @method static Builder|File newQuery()
 * @method static Builder|File query()
 * @method static Builder|File whereCreatedAt($value)
 * @method static Builder|File whereFormId($value)
 * @method static Builder|File whereFormType($value)
 * @method static Builder|File whereId($value)
 * @method static Builder|File wherePath($value)
 * @method static Builder|File whereType($value)
 * @method static Builder|File whereUpdatedAt($value)
 * @mixin Eloquent
 */
class File extends Model
{
    use HasFactory;
    protected $fillable = ['path', 'form_type', 'form_id', 'type'];
    protected $appends = ['download_link'];

    public static array $folders = [
        'users' => User::class,
        'tickets' => TicketMessage::class,
        'products' => Product::class,
    ];

    public static array $fileType = [
        'image' => 0,
        'file' => 1
    ];

    /**
     * @return MorphTo
     */
    public function form(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return string
     */
    public function getDownloadLinkAttribute(): string
    {
        return asset('storage/' . $this->path);
    }


}

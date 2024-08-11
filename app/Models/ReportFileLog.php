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
 * @property string $path
 * @property string $type
 * @property float $size
 * @property int $status
 * @property int|null $report_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $user_id
 * @property mixed|string|null $name
 * @property mixed|string|null $format
 * @method static Builder|ReportFileLog newModelQuery()
 * @method static Builder|ReportFileLog newQuery()
 * @method static Builder|ReportFileLog query()
 * @method static Builder|ReportFileLog whereCreatedAt($value)
 * @method static Builder|ReportFileLog whereId($value)
 * @method static Builder|ReportFileLog wherePath($value)
 * @method static Builder|ReportFileLog whereReportId($value)
 * @method static Builder|ReportFileLog whereSize($value)
 * @method static Builder|ReportFileLog whereStatus($value)
 * @method static Builder|ReportFileLog whereType($value)
 * @method static Builder|ReportFileLog whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ReportFileLog extends Model
{
    use HasFactory;

    protected $appends = ['download_link'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDownloadLinkAttribute(): string
    {
        return asset('storage/' . $this->path);
    }

    public static function getUniqueFilename($filename)
    {
        $baseName = pathinfo($filename, PATHINFO_FILENAME);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $suffix = 1;

        while (self::where('name', $filename)->exists()) {
            $filename = $baseName . '_v' . $suffix . '.' . $extension;
            $suffix++;
        }

        return $filename;
    }
}

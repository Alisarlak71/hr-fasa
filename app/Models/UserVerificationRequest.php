<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $statute_id
 * @property int $certificate_changes_id
 * @property int $official_newspaper_id
 * @property int $signature_certificate_id
 * @property int $official_letter_introduction_id
 * @property int $agent_national_card_id
 * @property int $agent_birth_certificate_id
 * @property int $ceo_national_card_id
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|UserVerificationRequest newModelQuery()
 * @method static Builder|UserVerificationRequest newQuery()
 * @method static Builder|UserVerificationRequest query()
 * @method static Builder|UserVerificationRequest whereAgentBirthCertificateId($value)
 * @method static Builder|UserVerificationRequest whereAgentNationalCardId($value)
 * @method static Builder|UserVerificationRequest whereCeoNationalCardId($value)
 * @method static Builder|UserVerificationRequest whereCertificateChangesId($value)
 * @method static Builder|UserVerificationRequest whereCreatedAt($value)
 * @method static Builder|UserVerificationRequest whereId($value)
 * @method static Builder|UserVerificationRequest whereOfficialLetterIntroductionId($value)
 * @method static Builder|UserVerificationRequest whereOfficialNewspaperId($value)
 * @method static Builder|UserVerificationRequest whereSignatureCertificateId($value)
 * @method static Builder|UserVerificationRequest whereStatus($value)
 * @method static Builder|UserVerificationRequest whereStatuteId($value)
 * @method static Builder|UserVerificationRequest whereUpdatedAt($value)
 * @method static Builder|UserVerificationRequest whereUserId($value)
 * @property int $added_value_certificate_id
 * @property string $name
 * @property int $type
 * @property string $establishment_date
 * @property string $address
 * @property string $national_code
 * @property string $postal_code
 * @property string $phone
 * @property-read Collection<int, UserVerificationEvent> $events
 * @property-read int|null $events_count
 * @property-read UserVerificationEvent|null $latestEvent
 * @method static Builder|UserVerificationRequest whereAddedValueCertificateId($value)
 * @method static Builder|UserVerificationRequest whereAddress($value)
 * @method static Builder|UserVerificationRequest whereEstablishmentDate($value)
 * @method static Builder|UserVerificationRequest whereName($value)
 * @method static Builder|UserVerificationRequest whereNationalCode($value)
 * @method static Builder|UserVerificationRequest wherePhone($value)
 * @method static Builder|UserVerificationRequest wherePostalCode($value)
 * @method static Builder|UserVerificationRequest whereType($value)
 * @mixin Eloquent
 */
class UserVerificationRequest extends Model
{
    use HasFactory;

    public function latestEvent(): HasOne
    {
        return $this->hasOne(UserVerificationEvent::class)->latest();
    }

    public function events(): HasMany
    {
        return $this->hasMany(UserVerificationEvent::class)->orderBy('created_at');
    }

    public function AgentBirthCertificate(): BelongsTo
    {
        return $this->belongsTo(File::class, 'agent_birth_certificate_id');
    }

    public function AddedValueCertificate(): BelongsTo
    {
        return $this->belongsTo(File::class, 'added_value_certificate_id');
    }

    public function AgentNationalCard(): BelongsTo
    {
        return $this->belongsTo(File::class, 'agent_national_card_id');
    }

    public function CeoNationalCard(): BelongsTo
    {
        return $this->belongsTo(File::class, 'ceo_national_card_id');
    }

    public function CertificateChanges(): BelongsTo
    {
        return $this->belongsTo(File::class, 'certificate_changes_id');
    }

    public function OfficialLetterIntroduction(): BelongsTo
    {
        return $this->belongsTo(File::class, 'official_letter_introduction_id');
    }

    public function OfficialNewspaper(): BelongsTo
    {
        return $this->belongsTo(File::class, 'official_newspaper_id');
    }

    public function SignatureCertificate(): BelongsTo
    {
        return $this->belongsTo(File::class, 'signature_certificate_id');
    }

    public function Statute(): BelongsTo
    {
        return $this->belongsTo(File::class, 'statute_id');
    }
}

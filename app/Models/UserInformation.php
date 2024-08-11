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
 * @method static Builder|UserInformation newModelQuery()
 * @method static Builder|UserInformation newQuery()
 * @method static Builder|UserInformation query()
 * @property int $id
 * @property int $user_id
 * @property int $user_verification_request_id
 * @property int $statute_id
 * @property int $certificate_changes_id
 * @property int $official_newspaper_id
 * @property int $signature_certificate_id
 * @property int $official_letter_introduction_id
 * @property int $agent_national_card_id
 * @property int $agent_birth_certificate_id
 * @property int $ceo_national_card_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|UserInformation whereAgentBirthCertificateId($value)
 * @method static Builder|UserInformation whereAgentNationalCardId($value)
 * @method static Builder|UserInformation whereCeoNationalCardId($value)
 * @method static Builder|UserInformation whereCertificateChangesId($value)
 * @method static Builder|UserInformation whereCreatedAt($value)
 * @method static Builder|UserInformation whereDeletedAt($value)
 * @method static Builder|UserInformation whereId($value)
 * @method static Builder|UserInformation whereOfficialLetterIntroductionId($value)
 * @method static Builder|UserInformation whereOfficialNewspaperId($value)
 * @method static Builder|UserInformation whereSignatureCertificateId($value)
 * @method static Builder|UserInformation whereStatuteId($value)
 * @method static Builder|UserInformation whereUpdatedAt($value)
 * @method static Builder|UserInformation whereUserId($value)
 * @method static Builder|UserInformation whereUserVerificationRequestId($value)
 * @property int $added_value_certificate_id
 * @property string $name
 * @property int $type
 * @property string $establishment_date
 * @property string $address
 * @property string $national_code
 * @property string $postal_code
 * @property string $phone
 * @property-read File|null $AgentBirthCertificate
 * @property-read File|null $AgentNationalCard
 * @property-read File|null $CeoNationalCard
 * @property-read File|null $CertificateChanges
 * @property-read File|null $OfficialLetterIntroduction
 * @property-read File|null $OfficialNewspaper
 * @property-read File|null $SignatureCertificate
 * @property-read File|null $Statute
 * @property-read UserVerificationRequest $UserVerificationRequest
 * @method static Builder|UserInformation whereAddedValueCertificateId($value)
 * @method static Builder|UserInformation whereAddress($value)
 * @method static Builder|UserInformation whereEstablishmentDate($value)
 * @method static Builder|UserInformation whereName($value)
 * @method static Builder|UserInformation whereNationalCode($value)
 * @method static Builder|UserInformation wherePhone($value)
 * @method static Builder|UserInformation wherePostalCode($value)
 * @method static Builder|UserInformation whereType($value)
 * @mixin Eloquent
 */
class UserInformation extends Model
{
    use HasFactory;

    protected $table = 'user_informations';

    public function AgentBirthCertificate(): BelongsTo
    {
        return $this->belongsTo(File::class, 'agent_birth_certificate_id');
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

    public function AddedValueCertificate(): BelongsTo
    {
        return $this->belongsTo(File::class, 'dded_value_certificate_id');
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

    public function UserVerificationRequest(): BelongsTo
    {
        return $this->belongsTo(UserVerificationRequest::class, 'user_verification_request_id');
    }

}

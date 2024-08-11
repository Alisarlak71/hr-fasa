<?php

namespace App\Services\UserVerificationRequest;

use App\Enums\VerificationStatuses;
use App\Models\UserVerificationEvent;
use App\Models\UserVerificationRequest;
use Auth;

class UserVerificationRequestService
{
    public UserVerificationRequest $verification_request;
    public int $status;

    public function __construct(UserVerificationRequest $verification_request,int $status)
    {
        $this->verification_request = $verification_request;
        $this->status = $status;
    }

    public function store(array $validated_data): void
    {
        $this->verification_request->name = $validated_data['name']??$this->verification_request->name;
        $this->verification_request->type = $validated_data['type']??$this->verification_request->type;
        $this->verification_request->establishment_date = $validated_data['establishment_date']??$this->verification_request->establishment_date;
        $this->verification_request->address = $validated_data['address']??$this->verification_request->address;
        $this->verification_request->national_code = $validated_data['national_code']?? $this->verification_request->national_code;
        $this->verification_request->postal_code = $validated_data['postal_code']??$this->verification_request->postal_code;
        $this->verification_request->phone = $validated_data['phone']??$this->verification_request->phone;
        $this->verification_request->statute_id = $validated_data['statute_id']??$this->verification_request->statute_id;
        $this->verification_request->certificate_changes_id = $validated_data['certificate_changes_id']??$this->verification_request->certificate_changes_id;
        $this->verification_request->official_newspaper_id = $validated_data['official_newspaper_id']??$this->verification_request->official_newspaper_id;
        $this->verification_request->signature_certificate_id = $validated_data['signature_certificate_id']??$this->verification_request->signature_certificate_id ;
        $this->verification_request->official_letter_introduction_id = $validated_data['official_letter_introduction_id']??$this->verification_request->official_letter_introduction_id;
        $this->verification_request->agent_national_card_id = $validated_data['agent_national_card_id']??$this->verification_request->agent_national_card_id;
        $this->verification_request->agent_birth_certificate_id = $validated_data['agent_birth_certificate_id']??$this->verification_request->agent_birth_certificate_id;
        $this->verification_request->ceo_national_card_id = $validated_data['ceo_national_card_id']??$this->verification_request->ceo_national_card_id;
        $this->verification_request->added_value_certificate_id = $validated_data['added_value_certificate_id']??$this->verification_request->added_value_certificate_id;
        $this->verification_request->user_id = Auth::id();
        $this->verification_request->status = $this->status;
        $this->verification_request->save();
    }

    public function storeEvent($details, string $description): void
    {
        $verification_event = new UserVerificationEvent();
        $verification_event->user_verification_request_id = $this->verification_request->id;
        $verification_event->user_id = Auth::id();
        $verification_event->details = $details;
        $verification_event->description = $description;
        $verification_event->status = $this->status;
        $verification_event->save();
    }
}

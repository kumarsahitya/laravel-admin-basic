<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Rules\Phone;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Profile extends Component
{
    public Model $customer;

    public int $customer_id;

    public string $firstName;

    public string $lastName;

    public string $email;

    public ?string $birthDate = null;

    public ?string $phoneNumber = null;

    public string $birthDateFormatted = '';

    public ?string $gender = '';

    public ?string $otherGender = '';

    public bool $firstNameUpdate = false;

    public bool $lastNameUpdate = false;

    public bool $emailUpdate = false;

    public bool $genderUpdate = false;

    public bool $birthDateUpdate = false;

    public bool $phoneNumberUpdate = false;

    public bool $optIn;

    public bool $hasEnabledTwoFactor;

    public function mount($customer): void
    {
        $this->customer = $customer;
        $this->customer_id = $customer->id;
        $this->firstName = $customer->first_name;
        $this->lastName = $customer->last_name;
        $this->email = $customer->email;
        $this->gender = in_array($customer->gender, ['male', 'female']) ? $customer->gender : 'other';
        $this->otherGender = ! in_array($customer->gender, ['male', 'female', 'other']) ? $customer->gender : '';
        $this->birthDate = $customer->birth_date;
        $this->phoneNumber = $customer->phone_number;
        $this->birthDateFormatted = $customer->birth_date_formatted;
        $this->optIn = (bool) $customer->opt_in;
        $this->hasEnabledTwoFactor = (bool) $customer->two_factor_secret;
    }

    public function saveFirstName(): void
    {
        $this->validate(['firstName' => 'sometimes|required']);

        $this->updateValue(
            'first_name',
            $this->firstName,
            __('Customer First name updated successfully.')
        );

        $this->firstNameUpdate = false;
        $this->emit('profileUpdate');
    }

    public function saveLastName(): void
    {
        $this->validate(['lastName' => 'sometimes|required']);

        $this->updateValue(
            'last_name',
            $this->lastName,
            __('Customer Last name updated successfully.')
        );

        $this->lastNameUpdate = false;
        $this->emit('profileUpdate');
    }

    public function saveEmail(): void
    {
        $this->validate([
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->customer_id),
            ],
        ]);

        $this->updateValue(
            'email',
            $this->email,
            __('Customer Email address updated successfully.')
        );

        $this->emailUpdate = false;
        $this->emit('profileUpdate');
    }

    public function cancelEmail(): void
    {
        $this->emailUpdate = false;
        $this->email = $this->customer->email;
    }

    public function saveBirthDate(): void
    {
        $this->updateValue(
            'birth_date',
            $this->birthDate,
            __('Customer birth date updated successfully.')
        );

        $this->birthDateUpdate = false;
        $this->birthDateFormatted = $this->customer->birth_date_formatted;
    }

    public function savePhoneNumber(): void
    {
        $this->validate([
            'phoneNumber' => ['nullable', new Phone()],
        ]);

        $this->updateValue(
            'phone_number',
            $this->phoneNumber,
            __('Customer phone number updated successfully.')
        );

        $this->phoneNumberUpdate = false;
    }

    public function saveGender(): void
    {
        $this->updateValue(
            'gender',
            in_array($this->gender, ['male', 'female']) ? $this->gender : $this->otherGender,
            __('Customer gender updated successfully.')
        );

        $this->genderUpdate = false;
    }

    public function updatedOptIn(): void
    {
        $this->updateValue(
            'opt_in',
            $this->optIn,
            __("You have updated the customer's marketing email subscription.")
        );
    }

    public function render(): View
    {
        return view('admin.livewire.customers.profile');
    }

    private function updateValue(string $field, mixed $value, string $message): void
    {
        $emailChanged = false;
        if ($field == 'email' && $this->customer->email != $value) {
            $emailChanged = true;
            $this->customer->email_verified_at = null;
        }
        $isUpdated = $this->customer->update([$field => $value]);
        if (! $this->customer->email_verified_at && $emailChanged && $isUpdated) {
            $this->customer->update(['email_verified_at' => null]);
            $this->customer->sendEmailVerificationNotification();
        }

        Notification::make()
            ->title(__('layout.status.updated'))
            ->body($message)
            ->success()
            ->send();
    }
}

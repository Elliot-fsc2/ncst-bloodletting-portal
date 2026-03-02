<?php

use App\Jobs\SendEacmedDonorPdfEmail;
use App\Models\Hospital;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

new class extends Component {
    public int $step = 1;

    public bool $submitted = false;

    public bool $consent = false;

    public bool $is_representative = false;

    public string $preferred_date = '';

    public array $representative = [
        'first_name' => '',
        'surname' => '',
        'student_employee_id' => '',
    ];

    public array $personal = [
        'surname' => '',
        'first_name' => '',
        'middle_name' => '',
        'birthdate' => '',
        'age' => '',
        'gender' => '',
        'civil_status' => '',
        'contact_no' => '',
        'email' => '',
        'nationality' => '',
        'occupation' => '',
        'street_address' => '',
        'barangay' => '',
        'town_district' => '',
        'city' => '',
        'province' => '',
        'zip_code' => '',
    ];

    public function updatedPersonalBirthdate(string $value): void
    {
        if ($value) {
            try {
                $this->personal['age'] = Carbon::parse($value)->age;
            } catch (\Exception $e) {
                $this->personal['age'] = '';
            }
        }
    }

    protected function rulesForStep(int $step): array
    {
        return match ($step) {
            1 => [
                'personal.surname' => 'required|string',
                'personal.first_name' => 'required|string',
                'personal.birthdate' => 'required|date',
                'personal.gender' => 'required|in:Male,Female',
                'personal.contact_no' => 'required|string',
                'personal.middle_name' => 'nullable|string',
                'personal.civil_status' => 'nullable|string',
                'personal.email' => 'required|email',
                'personal.nationality' => 'nullable|string',
                'personal.occupation' => 'nullable|string',
                'personal.street_address' => 'nullable|string',
                'personal.barangay' => 'nullable|string',
                'personal.town_district' => 'nullable|string',
                'personal.city' => 'nullable|string',
                'personal.province' => 'nullable|string',
                'personal.zip_code' => 'nullable|string',
                'preferred_date' => 'required|in:2026-03-13,2026-03-20',
                'representative.first_name' => [Rule::requiredIf(fn() => $this->is_representative), 'nullable', 'string'],
                'representative.surname' => [Rule::requiredIf(fn() => $this->is_representative), 'nullable', 'string'],
                'representative.student_employee_id' => [Rule::requiredIf(fn() => $this->is_representative), 'nullable', 'string'],
            ],
            default => [],
        };
    }

    protected function messagesForStep(int $step): array
    {
        return match ($step) {
            1 => [
                'personal.surname.required' => 'Surname is required.',
                'personal.first_name.required' => 'First name is required.',
                'personal.birthdate.required' => 'Date of birth is required.',
                'personal.birthdate.date' => 'Please enter a valid date.',
                'personal.gender.required' => 'Gender is required.',
                'personal.contact_no.required' => 'Contact number is required.',
                'personal.email.required' => 'Email address is required.',
                'personal.email.email' => 'Please enter a valid email address.',
                'representative.first_name.required' => 'First name of the person being represented is required.',
                'representative.surname.required' => 'Surname of the person being represented is required.',
                'representative.student_employee_id.required' => 'Student/Employee ID of the person being represented is required.',
            ],
            default => [],
        };
    }

    public function nextStep(): void
    {
        $this->validate($this->rulesForStep($this->step), $this->messagesForStep($this->step));

        if ($this->step === 1 && \App\Models\Form::where('donor_email', $this->personal['email'] ?? '')->exists()) {
            $this->addError('personal.email', 'This email has already been used to register for a blood donation.');
            return;
        }

        $this->step++;
        $this->js('window.scrollTo({top: 0, behavior: "smooth"})');
    }

    public function prevStep(): void
    {
        $this->step--;
        $this->js('window.scrollTo({top: 0, behavior: "smooth"})');
    }

    public function submit(): void
    {
        $this->validate(['consent' => 'accepted'], ['consent.accepted' => 'You must accept the consent statement to submit.']);

        $hospital = Hospital::where('name', 'LIKE', '%Emilio Aguinaldo%')->firstOrFail();

        if (
            $hospital
                ->forms()
                ->where('donor_email', $this->personal['email'] ?? '')
                ->where('form_data->preferred_date', $this->preferred_date)
                ->exists()
        ) {
            $this->addError('personal.email', 'This email is already registered for the selected donation date.');
            $this->step = 1;
            $this->js('window.scrollTo({top: 0, behavior: "smooth"})');
            return;
        }

        $existingCount = $hospital->forms()->where('form_data->preferred_date', $this->preferred_date)->count();

        if ($existingCount >= 250) {
            $this->addError('preferred_date', 'Registration for this date is now full. The maximum of 250 registrations has been reached.');
            $this->step = 1;
            $this->js('window.scrollTo({top: 0, behavior: "smooth"})');
            return;
        }

        $queueNumber = 'EAC' . str_pad($existingCount + 1, 4, '0', STR_PAD_LEFT);

        $pdfData = [
            'personal' => $this->personal,
            'representative' => $this->is_representative ? $this->representative : null,
            'preferred_date' => $this->preferred_date,
            'queue_number' => $queueNumber,
        ];

        $hospital->forms()->create([
            'donor_name' => trim($this->personal['surname'] . ', ' . $this->personal['first_name'] . ' ' . $this->personal['middle_name']),
            'donor_email' => $this->personal['email'] ?? '',
            'form_data' => $pdfData,
        ]);

        $surname = strtoupper($this->personal['surname'] ?? 'donor');
        $firstName = strtoupper($this->personal['first_name'] ?? '');
        $filename = str_replace(' ', '_', "EACMed-BloodDonor-{$surname}-{$firstName}.pdf");
        $donorName = trim($firstName . ' ' . $surname);

        SendEacmedDonorPdfEmail::dispatch($donorName, $this->personal['email'] ?? '', $filename, $pdfData);

        $this->submitted = true;
        $this->js('window.scrollTo({top: 0, behavior: "smooth"})');
    }
}; ?>

<div>
    {{-- Success State --}}
    @if ($submitted)
        <flux:card class="shadow-sm">
            <div class="text-center py-12 px-6">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-green-100 mx-auto mb-5">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">Form Submitted Successfully!</h2>
                <p class="text-sm text-gray-600 mb-1">Thank you for registering as a blood donor.</p>
                <p class="text-sm text-gray-600 mb-6">Please <strong>check your email</strong> &mdash; your completed
                    donor form has been sent to your inbox.</p>
                <flux:button onclick="window.location.reload()" variant="primary" icon="arrow-path">
                    Submit Another Response
                </flux:button>
            </div>
        </flux:card>
    @else
        {{-- Step Tracker --}}
        <div class="mb-6">
            <div class="flex items-center justify-between relative max-w-lg mx-auto">
                <div class="absolute top-5 left-0 right-0 h-0.5 bg-red-100 z-0 mx-6"></div>
                <div class="absolute top-5 left-0 h-0.5 bg-red-500 z-0 mx-6 transition-all duration-500"
                    style="width: calc({{ ($step - 1) / 1 }} * (100% - 3rem))"></div>

                @foreach ([['label' => 'Personal'], ['label' => 'Confirm']] as $i => $s)
                    @php $n = $i + 1; @endphp
                    <div class="flex flex-col items-center z-10 gap-1.5 bg-gray-50 px-2">
                        <div @class([
                            'flex items-center justify-center w-10 h-10 rounded-full text-sm font-bold border-2 transition-all duration-300',
                            'bg-red-600 border-red-600 text-white shadow-md shadow-red-200' =>
                                $step === $n,
                            'bg-red-500 border-red-500 text-white' => $step > $n,
                            'bg-white border-red-200 text-red-300' => $step < $n,
                        ])>
                            @if ($step > $n)
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            @else
                                {{ $n }}
                            @endif
                        </div>
                        <span @class([
                            'text-[0.65rem] font-medium hidden sm:block transition-colors duration-300',
                            'text-red-600' => $step >= $n,
                            'text-gray-400' => $step < $n,
                        ])>{{ $s['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <flux:card class="shadow-sm">

            {{-- ── STEP 1: Personal Information ── --}}
            @if ($step === 1)
                <div wire:transition>
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-red-100">
                        <div
                            class="flex items-center justify-center w-9 h-9 rounded-full bg-red-50 text-red-600 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <flux:heading class="text-base! font-semibold!">Personal Information</flux:heading>
                            <p class="text-xs text-gray-500 mt-0.5">Fields marked <span class="text-red-500">*</span>
                                are
                                required.</p>
                        </div>
                    </div>

                    {{-- Representative Donor --}}
                    <div class="mb-5 rounded-xl border border-amber-200 bg-amber-50/40 p-4">
                        <flux:checkbox wire:model.live="is_representative" label="I am donating as a Representative" />
                        @if ($is_representative)
                            <div class="mt-4 space-y-3" wire:transition>
                                <p class="text-xs font-semibold text-amber-700 uppercase tracking-wider">Representative
                                    For:</p>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <flux:input wire:model="representative.first_name" label="First Name"
                                        placeholder="e.g. Juan" />
                                    <flux:input wire:model="representative.surname" label="Surname"
                                        placeholder="e.g. Dela Cruz" />
                                    <flux:input wire:model="representative.student_employee_id"
                                        label="Student / Employee ID" placeholder="e.g. 2024-00123" />
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-5">
                        {{-- Name --}}
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <flux:input wire:model="personal.surname" label="Last Name *"
                                placeholder="e.g. Dela Cruz" />
                            <flux:input wire:model="personal.first_name" label="First Name *" placeholder="e.g. Juan" />
                            <flux:input wire:model="personal.middle_name" label="Middle Name"
                                placeholder="e.g. Santos" />
                        </div>

                        {{-- Birthdate / Age / Gender / Civil Status --}}
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <flux:input wire:model.live="personal.birthdate" type="date" label="Birthdate *" />
                            <flux:input wire:model="personal.age" label="Age" placeholder="Auto" readonly
                                class="bg-gray-50!" />
                            <flux:select wire:model="personal.gender" label="Gender *">
                                <flux:select.option value="">Select...</flux:select.option>
                                <flux:select.option value="Male">Male</flux:select.option>
                                <flux:select.option value="Female">Female</flux:select.option>
                            </flux:select>
                            <flux:select wire:model="personal.civil_status" label="Civil Status">
                                <flux:select.option value="">Select...</flux:select.option>
                                <flux:select.option value="Single">Single</flux:select.option>
                                <flux:select.option value="Married">Married</flux:select.option>
                                <flux:select.option value="Widowed">Widowed</flux:select.option>
                                <flux:select.option value="Separated">Separated</flux:select.option>
                            </flux:select>
                        </div>

                        {{-- Contact / Email / Nationality / Occupation --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <flux:input wire:model="personal.contact_no" label="Contact No. *"
                                placeholder="09XX XXX XXXX" />
                            <flux:input wire:model="personal.email" type="email" label="E-mail Address"
                                placeholder="e.g. juan@email.com" />
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <flux:input wire:model="personal.nationality" label="Nationality"
                                placeholder="e.g. Filipino" />
                            <flux:input wire:model="personal.occupation" label="Occupation"
                                placeholder="e.g. Student, Nurse" />
                        </div>

                        {{-- Preferred Mailing Address --}}
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-2">Preferred Mailing Address</p>
                            <div class="space-y-3">
                                <flux:input wire:model="personal.street_address" label="Number, Street, Subdivision"
                                    placeholder="e.g. 123 Rizal St., Villa Verde" />
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <flux:input wire:model="personal.barangay" label="Barangay"
                                        placeholder="e.g. Salitran II" />
                                    <flux:input wire:model="personal.town_district" label="Town / District"
                                        placeholder="e.g. Dasmariñas" />
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <flux:input wire:model="personal.city" label="City"
                                        placeholder="e.g. Dasmariñas" />
                                    <flux:input wire:model="personal.province" label="Province"
                                        placeholder="e.g. Cavite" />
                                    <flux:input wire:model="personal.zip_code" label="Zip Code"
                                        placeholder="e.g. 4114" />
                                </div>
                            </div>
                        </div>

                        {{-- Preferred Donation Date --}}
                        <flux:select wire:model="preferred_date" label="Preferred Donation Date *">
                            <flux:select.option value="">Select a date...</flux:select.option>
                            <flux:select.option value="2026-03-13">March 13, 2026</flux:select.option>
                            <flux:select.option value="2026-03-20">March 20, 2026</flux:select.option>
                        </flux:select>

                    </div>
                </div>
            @endif

            {{-- ── STEP 2: Review & Confirm ── --}}
            @if ($step === 2)
                <div wire:transition>
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-red-100">
                        <div
                            class="flex items-center justify-center w-9 h-9 rounded-full bg-red-50 text-red-600 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <flux:heading class="text-base! font-semibold! text-gray-800!">Review & Confirm
                            </flux:heading>
                            <p class="text-xs text-gray-500 mt-0.5">Please review all your answers carefully before
                                submitting.</p>
                        </div>
                    </div>

                    <div class="space-y-5 text-sm">
                        {{-- Personal Data --}}
                        <div class="rounded-xl border border-gray-200 overflow-hidden">
                            <div class="flex items-center gap-2 bg-red-50 px-4 py-2.5 border-b border-red-100">
                                <span>👤</span>
                                <p class="text-xs font-bold text-red-700 uppercase tracking-wider">Personal Information
                                </p>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-px bg-gray-100">
                                @foreach ([
        'Last Name' => $personal['surname'],
        'First Name' => $personal['first_name'],
        'Middle Name' => $personal['middle_name'] ?: '—',
        'Birthdate' => $personal['birthdate'],
        'Age' => $personal['age'] ?: '—',
        'Gender' => $personal['gender'],
        'Civil Status' => $personal['civil_status'] ?: '—',
        'Contact No.' => $personal['contact_no'],
        'E-mail' => $personal['email'] ?: '—',
        'Nationality' => $personal['nationality'] ?: '—',
        'Occupation' => $personal['occupation'] ?: '—',
        'Street Address' => $personal['street_address'] ?: '—',
        'Barangay' => $personal['barangay'] ?: '—',
        'Town / District' => $personal['town_district'] ?: '—',
        'City' => $personal['city'] ?: '—',
        'Province' => $personal['province'] ?: '—',
        'Zip Code' => $personal['zip_code'] ?: '—',
    ] as $label => $val)
                                    <div class="bg-white px-3 py-2">
                                        <p class="text-[0.65rem] text-gray-400 uppercase tracking-wide mb-0.5">
                                            {{ $label }}</p>
                                        <p class="font-medium text-gray-800">{{ $val }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Consent --}}
                    <div class="mt-5 rounded-xl border border-red-200 bg-red-50/40 p-4">
                        <div class="flex gap-3 mb-4">
                            <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-xs text-gray-600 italic leading-relaxed">
                                "I certify that I am the person referred to in all the entries, which were read and well
                                understood by me.
                                It is my free and voluntary act to donate my blood, aware of its risks during and after
                                extraction.
                                I certify that I have to do the best of my knowledge, truthfully answered the above
                                questions."
                            </p>
                        </div>
                        <flux:checkbox wire:model.live="consent"
                            label="I have read and I agree to the consent statement." />
                        @error('consent')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            @endif

            {{-- Navigation --}}
            <div class="flex items-center justify-between gap-3 mt-8 pt-5 border-t border-gray-100">
                @if ($step > 1)
                    <flux:button wire:click="prevStep" variant="ghost" icon="chevron-left">Back</flux:button>
                @else
                    <div></div>
                @endif

                <div class="flex items-center gap-3">
                    <span class="text-xs text-gray-400 hidden sm:block">Step {{ $step }} of 2</span>
                    @if ($step < 2)
                        <flux:button wire:click="nextStep" variant="primary" icon-trailing="chevron-right"
                            class="bg-red-600! hover:bg-red-700! border-red-600!">Next</flux:button>
                    @else
                        <flux:button wire:click="submit" variant="primary" icon="check" :disabled="!$consent"
                            class="bg-red-600! hover:bg-red-700! border-red-600!">Submit & Generate PDF</flux:button>
                    @endif
                </div>
            </div>

        </flux:card>
    @endif
</div>

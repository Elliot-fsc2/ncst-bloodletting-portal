<?php

use App\Jobs\SendDonorPdfEmail;
use App\Mail\FormSubmitted;
use App\Models\Form;
use App\Models\Hospital;
use Livewire\Component;

new class extends Component {
    public $step = 1;

    // PERSONAL DATA
    public array $personal = [
        'surname' => '',
        'given_name' => '',
        'middle_name' => '',
        'birthdate' => '',
        'sex' => '',
        'civil_status' => '',
        'occupation' => '',
        'house_no' => '',
        'street' => '',
        'subdivision' => '',
        'barangay' => '',
        'city_province' => '',
        'email' => '',
        'contact_number' => '',
    ];

    // GENERAL MEDICAL HISTORY
    public array $history = [
        'donated_before' => '',
        'last_donation_info' => '',
        'used_different_name' => '',
        'deferred_before' => '',
    ];

    // SECTION A — Past 18 Months
    public array $section_a = [
        'symptoms' => '',
    ];

    // SECTION B — Past 12 Months
    public array $section_b = [
        'diseases' => '', // B1 conditions list
        'doctor_care' => '', // B2
        'dental' => '', // B3
        'drugs' => '', // B4
        'transplant' => '', // B5
        'tattoo' => '', // B6
        'sex_multi' => '', // B7
        'sex_unsupervised' => '', // B8
        'hepatitis_contact' => '', // B9
        'sex_money' => '', // B10
        'sex_bisexual' => '', // B11
        'malaria_area' => '', // B12
        'jail' => '', // B13
    ];

    // SECTION C — Past 4 Weeks / 24 Hours
    public array $section_c = [
        'meds' => '', // C1
        'growth_hormone' => '', // C2
        'alcohol' => '', // C3
        'pilot_driver' => '', // C4
        'illness' => '', // C5
    ];

    // SECTION D — COVID-19
    public array $section_d = [
        'travel_intl' => '', // D1
        'travel_countries' => '', // D1 follow-up
        'covid_contact' => '', // D2
        'symptoms_contact' => '', // D3
        'vaccine_received' => '', // D4 yes/no
        'vaccine_details' => '', // D4 date & type
    ];

    // SECTION E — Female Donors Only
    public array $section_e = [
        'delivery' => '',
        'menstruation' => '',
    ];

    public bool $consent = false;

    // ── Per-step validation ───────────────────────────────────────────────
    protected function rulesForStep(int $step): array
    {
        return match ($step) {
            1 => [
                'personal.surname' => 'required|string',
                'personal.given_name' => 'required|string',
                'personal.birthdate' => 'required|date',
                'personal.sex' => 'required|in:Male,Female',
                'personal.civil_status' => 'required|string',
                'personal.occupation' => 'required|string',
                'personal.barangay' => 'required|string',
                'personal.city_province' => 'required|string',
                'personal.contact_number' => 'required|string',
                'personal.email' => 'required|email',
            ],
            2 => [
                'history.donated_before' => 'required|in:yes,no',
                'history.used_different_name' => 'required|in:yes,no',
                'history.deferred_before' => 'required|in:yes,no',
            ],
            3 => [
                'section_a.symptoms' => 'required|in:yes,no',
                'section_b.diseases' => 'required|in:yes,no',
                'section_b.doctor_care' => 'required|in:yes,no',
                'section_b.dental' => 'required|in:yes,no',
                'section_b.drugs' => 'required|in:yes,no',
                'section_b.transplant' => 'required|in:yes,no',
                'section_b.tattoo' => 'required|in:yes,no',
                'section_b.sex_multi' => 'required|in:yes,no',
                'section_b.sex_unsupervised' => 'required|in:yes,no',
                'section_b.hepatitis_contact' => 'required|in:yes,no',
                'section_b.sex_money' => 'required|in:yes,no',
                'section_b.sex_bisexual' => 'required|in:yes,no',
                'section_b.malaria_area' => 'required|in:yes,no',
                'section_b.jail' => 'required|in:yes,no',
            ],
            4 => [
                'section_c.meds' => 'required|in:yes,no',
                'section_c.growth_hormone' => 'required|in:yes,no',
                'section_c.alcohol' => 'required|in:yes,no',
                'section_c.pilot_driver' => 'required|in:yes,no',
                'section_c.illness' => 'required|in:yes,no',
                'section_d.travel_intl' => 'required|in:yes,no',
                'section_d.covid_contact' => 'required|in:yes,no',
                'section_d.symptoms_contact' => 'required|in:yes,no',
                'section_d.vaccine_details' => 'required_if:section_d.vaccine_received,yes|string',
                'section_d.vaccine_date' => 'required_if:section_d.vaccine_received,yes|date',
            ],
            default => [],
        };
    }

    protected function messagesForStep(int $step): array
    {
        $msgs = [];
        foreach (array_keys($this->rulesForStep($step)) as $field) {
            $msgs["{$field}.required"] = 'This field is required.';
            $msgs["{$field}.in"] = 'Please select a valid answer.';
            $msgs["{$field}.email"] = 'Please enter a valid email.';
            $msgs["{$field}.date"] = 'Please enter a valid date.';
            $msgs["{$field}.string"] = 'This field is required.';
        }

        return $msgs;
    }

    public function nextStep(): void
    {
        $this->validate($this->rulesForStep($this->step), $this->messagesForStep($this->step));
        $this->step++;
    }

    public function prevStep(): void
    {
        $this->step--;
    }

    public function submit()
    {
        $this->validate(
            [
                'consent' => 'accepted',
                'section_e.delivery' => 'nullable|date',
                'section_e.menstruation' => 'required_if:personal.sex,Female|nullable|date',
            ],
            [
                'consent.accepted' => 'You must accept the consent statement to submit.',
                'section_e.menstruation.required_if' => 'Last menstruation date is required for female donors.',
            ],
        );

        $vmmc = Hospital::where('name', 'Veterans Memorial Medical Center')->firstOrFail();

        $vmmc->forms()->create([
            'donor_name' => trim($this->personal['surname'] . ', ' . $this->personal['given_name'] . ' ' . $this->personal['middle_name']),
            'donor_email' => $this->personal['email'],
            'form_data' => [
                'personal' => $this->personal,
                'history' => $this->history,
                'section_a' => $this->section_a,
                'section_b' => $this->section_b,
                'section_c' => $this->section_c,
                'section_d' => $this->section_d,
                'section_e' => $this->section_e,
            ],
        ]);

        $surname = strtoupper($this->personal['surname'] ?? 'donor');
        $givenName = strtoupper($this->personal['given_name'] ?? '');
        $filename = str_replace(' ', '_', "VMMC-BloodDonor-{$surname}-{$givenName}.pdf");
        $donorName = trim($givenName . ' ' . $surname);
        $email = $this->personal['email'];
        $pdfData = [
            'personal' => $this->personal,
            'history' => $this->history,
            'section_a' => $this->section_a,
            'section_b' => $this->section_b,
            'section_c' => $this->section_c,
            'section_d' => $this->section_d,
            'section_e' => $this->section_e,
        ];

        SendDonorPdfEmail::dispatch($donorName, $email, $filename, $pdfData);
    }

    public function yesNo(?string $val): string
    {
        return match ($val) {
            'yes' => 'Yes',
            'no' => 'No',
            default => '—',
        };
    }
}; ?>

<div>
    {{-- Step Tracker --}}
    <div class="mb-6">
        <div class="flex items-center justify-between relative">
            <div class="absolute top-5 left-0 right-0 h-0.5 bg-red-100 z-0 mx-6"></div>
            <div class="absolute top-5 left-0 h-0.5 bg-red-500 z-0 mx-6 transition-all duration-500"
                style="width: calc({{ ($step - 1) / 4 }} * (100% - 3rem))"></div>

            @foreach ([['icon' => '👤', 'label' => 'Personal'], ['icon' => '🩺', 'label' => 'History'], ['icon' => '📋', 'label' => 'Conditions'], ['icon' => '🦠', 'label' => 'Recent'], ['icon' => '✅', 'label' => 'Confirm']] as $i => $s)
                @php $n = $i + 1; @endphp
                <div class="flex flex-col items-center z-10 gap-1.5">
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

        {{-- ── STEP 1: Personal Data ── --}}
        @if ($step === 1)
            <div wire:transition>
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-red-100">
                    <div class="flex items-center justify-center w-9 h-9 rounded-full bg-red-50 text-red-600 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <flux:heading class="text-base! font-semibold!">Personal Data</flux:heading>
                        <p class="text-xs text-gray-500 mt-0.5">Fields marked <span class="text-red-500">*</span> are
                            required.</p>
                    </div>
                </div>

                <div class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <flux:input wire:model="personal.surname" label="Surname *" placeholder="e.g. Dela Cruz" />
                        <flux:input wire:model="personal.given_name" label="Given Name *" placeholder="e.g. Juan" />
                        <flux:input wire:model="personal.middle_name" label="Middle Name" placeholder="e.g. Santos" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <flux:input wire:model="personal.birthdate" type="date" label="Date of Birth *" />
                        <flux:select wire:model="personal.sex" label="Sex *">
                            <flux:select.option value="">Select...</flux:select.option>
                            <flux:select.option value="Male">Male</flux:select.option>
                            <flux:select.option value="Female">Female</flux:select.option>
                        </flux:select>
                        <flux:select wire:model="personal.civil_status" label="Civil Status *">
                            <flux:select.option value="">Select...</flux:select.option>
                            <flux:select.option value="Single">Single</flux:select.option>
                            <flux:select.option value="Married">Married</flux:select.option>
                            <flux:select.option value="Separated">Separated</flux:select.option>
                            <flux:select.option value="Widowed">Widowed</flux:select.option>
                        </flux:select>
                    </div>

                    <flux:input wire:model="personal.occupation" label="Occupation *"
                        placeholder="e.g. Student, Engineer..." />

                    <div class="pt-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Address</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <flux:input wire:model="personal.house_no" label="House No / Street"
                                placeholder="123 Rizal St." />
                            <flux:input wire:model="personal.subdivision" label="Subdivision / Village" />
                            <flux:input wire:model="personal.barangay" label="Barangay *" />
                            <flux:input wire:model="personal.city_province" label="City / Province *" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <flux:input wire:model="personal.email" type="email" label="Email Address *"
                            placeholder="you@example.com" />
                        <flux:input wire:model="personal.contact_number" label="Contact Number *"
                            placeholder="09XX XXX XXXX" />
                    </div>
                </div>
            </div>
        @endif

        {{-- ── STEP 2: General Medical History ── --}}
        @if ($step === 2)
            <div wire:transition>
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-red-100">
                    <div class="flex items-center justify-center w-9 h-9 rounded-full bg-red-50 text-red-600 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <flux:heading class="text-base! font-semibold! text-gray-800!">General Medical History
                        </flux:heading>
                        <p class="text-xs text-gray-500 mt-0.5">Answer all questions honestly.</p>
                    </div>
                </div>

                <div class="space-y-4">
                    {{-- Q1 --}}
                    <div class="rounded-xl border border-gray-100 bg-gray-50/60 p-4 space-y-3">
                        <flux:radio.group wire:model="history.donated_before"
                            label="1. Have you donated blood before? If yes, indicate the date and place of last donation.">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>
                        @if ($history['donated_before'] === 'yes')
                            <div wire:transition>
                                <flux:input wire:model="history.last_donation_info"
                                    label="Date and place of last donation"
                                    placeholder="e.g. Jan 15, 2024 — VMMC Blood Bank" />
                            </div>
                        @endif
                    </div>

                    {{-- Q2 --}}
                    <div class="rounded-xl border border-gray-100 bg-gray-50/60 p-4">
                        <flux:radio.group wire:model="history.used_different_name"
                            label="2. Have you ever donated or attempted to donate blood using a different (or another) name here or elsewhere?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>
                    </div>

                    {{-- Q3 --}}
                    <div class="rounded-xl border border-gray-100 bg-gray-50/60 p-4">
                        <flux:radio.group wire:model="history.deferred_before"
                            label="3. Have you for any reason been deferred as a blood donor or told not to donate blood?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>
                    </div>
                </div>
            </div>
        @endif

        {{-- ── STEP 3: Conditions (Section A & B) ── --}}
        @if ($step === 3)
            <div wire:transition>
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-red-100">
                    <div class="flex items-center justify-center w-9 h-9 rounded-full bg-red-50 text-red-600 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <div>
                        <flux:heading class="text-base! font-semibold! text-gray-800!">Health Conditions</flux:heading>
                        <p class="text-xs text-gray-500 mt-0.5">Past 12–18 months. Answer all questions.</p>
                    </div>
                </div>

                <div class="space-y-4">
                    {{-- Section A --}}
                    <div class="rounded-xl border border-amber-100 bg-amber-50/60 p-4">
                        <p class="text-xs font-bold text-amber-700 uppercase tracking-wider mb-3">Section A — Past 18
                            Months</p>
                        <flux:radio.group wire:model="section_a.symptoms"
                            label="A1. Have you had any of the following: high blood pressure, night sweats, unexplained fevers, unexplained weight loss, persistent diarrhea, or enlarged lymph node?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>
                    </div>

                    {{-- Section B --}}
                    <div class="rounded-xl border border-gray-100 bg-gray-50/60 p-4 space-y-5">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Section B — Past 12 Months
                        </p>

                        {{-- B1 --}}
                        <div class="space-y-2">
                            <flux:radio.group wire:model="section_b.diseases"
                                label="B1. Have you had any of the following conditions?">
                                <flux:radio value="yes" label="Yes" />
                                <flux:radio value="no" label="No" />
                            </flux:radio.group>
                            <p class="text-[0.7rem] text-gray-500 italic leading-relaxed pl-1">
                                Malaria, hepatitis, jaundice, syphilis, chicken pox, shingles, cold sores, serious
                                accident, cancer, blood disease (e.g. leukemia), recent/severe respiratory disease,
                                cardiovascular disease, kidney disease, diabetes, asthma, epilepsy, tuberculosis.
                            </p>
                        </div>

                        {{-- B2 --}}
                        <flux:radio.group wire:model="section_b.doctor_care"
                            label="B2. Under a doctor's care or had a major illness or surgery?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- B3 --}}
                        <flux:radio.group wire:model="section_b.dental"
                            label="B3. Had dental surgery in the past 12 months or tooth extraction in the past 6 months?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- B4 --}}
                        <flux:radio.group wire:model="section_b.drugs"
                            label="B4. Taken prohibited drugs? (orally, by nose, or by injection)">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- B5 --}}
                        <flux:radio.group wire:model="section_b.transplant"
                            label="B5. Received blood or clotting factor concentrates for a bleeding problem (e.g. hemophilia), or had an organ/tissue transplant or graft?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- B6 --}}
                        <flux:radio.group wire:model="section_b.tattoo"
                            label="B6. Had a tattoo applied, ear piercing, acupuncture, accidental needle stick, or came in contact with someone else's blood?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- B7 --}}
                        <flux:radio.group wire:model="section_b.sex_multi"
                            label="B7. Engaged in sexual activity with the same sex or with multiple sexual partners?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- B8 --}}
                        <flux:radio.group wire:model="section_b.sex_unsupervised"
                            label="B8. Engaged in sexual activity with an individual who received an injection without proper medical supervision?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- B9 --}}
                        <flux:radio.group wire:model="section_b.hepatitis_contact"
                            label="B9. Been in personal contact with anyone who had hepatitis?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- B10 --}}
                        <flux:radio.group wire:model="section_b.sex_money"
                            label="B10. Given money or drugs to anyone to have sex with you, or had sex with anyone who has taken money or drugs for sex?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- B11 --}}
                        <flux:radio.group wire:model="section_b.sex_bisexual"
                            label="B11. Had a sexual partner who is bisexual, a medically unsupervised IV drug user, has taken clotting factor concentrates for bleeding, has HIV, or tested positive for HIV?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- B12 --}}
                        <flux:radio.group wire:model="section_b.malaria_area"
                            label="B12. Travelled to malaria endemic areas (e.g. Palawan, Mindoro)?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- B13 --}}
                        <flux:radio.group wire:model="section_b.jail" label="B13. Been in jail or prison?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>
                    </div>
                </div>
            </div>
        @endif

        {{-- ── STEP 4: Recent Status (Section C & D) ── --}}
        @if ($step === 4)
            <div wire:transition>
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-red-100">
                    <div class="flex items-center justify-center w-9 h-9 rounded-full bg-red-50 text-red-600 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <flux:heading class="text-base! font-semibold! text-gray-800!">Recent Status & COVID-19
                        </flux:heading>
                        <p class="text-xs text-gray-500 mt-0.5">Past 4 weeks / 24 hours & COVID-19 assessment.</p>
                    </div>
                </div>

                <div class="space-y-4">
                    {{-- Section C --}}
                    <div class="rounded-xl border border-gray-100 bg-gray-50/60 p-4 space-y-5">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Section C — Past 4 Weeks /
                            24 Hours</p>

                        {{-- C1 --}}
                        <flux:radio.group wire:model="section_c.meds"
                            label="C1. In the past four weeks, have you taken any medications such as Isotretinoin (Accutane), Finasteride (Proscar/Propecia), Etretinate (Tegison) for psoriasis, Feldene, aspirin, or other medicines?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- C2 --}}
                        <flux:radio.group wire:model="section_c.growth_hormone"
                            label="C2. Have you ever received human pituitary-derived growth hormone or had a brain covering (dura mater) graft?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- C3 --}}
                        <flux:radio.group wire:model="section_c.alcohol"
                            label="C3. Have you within the last 24 hours had an intake of alcohol?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- C4 --}}
                        <flux:radio.group wire:model="section_c.pilot_driver"
                            label="C4. Do you intend to ride/pilot an airplane within the next 24 hours or drive a heavy/any transport vehicle within the next 12 hours?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- C5 --}}
                        <flux:radio.group wire:model="section_c.illness"
                            label="C5. Are you currently suffering from an illness, allergy, or any infectious disease?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>
                    </div>

                    {{-- Section D --}}
                    <div class="rounded-xl border border-blue-100 bg-blue-50/50 p-4 space-y-5">
                        <p class="text-xs font-bold text-blue-700 uppercase tracking-wider">Section D — COVID-19 (Past
                            28 Days)</p>

                        {{-- D1 --}}
                        <div class="space-y-2">
                            <flux:radio.group wire:model="section_d.travel_intl"
                                label="D1. In the past 28 days, have you travelled outside the Philippines?">
                                <flux:radio value="yes" label="Yes" />
                                <flux:radio value="no" label="No" />
                            </flux:radio.group>
                            @if ($section_d['travel_intl'] === 'yes')
                                <div wire:transition>
                                    <flux:input wire:model="section_d.travel_countries"
                                        label="Indicate the country/ies visited" placeholder="e.g. Japan, USA" />
                                </div>
                            @endif
                        </div>

                        {{-- D2 --}}
                        <flux:radio.group wire:model="section_d.covid_contact"
                            label="D2. In the past 28 days, have you had close contact (lived with, worked with, travelled with, or cared for) a confirmed COVID-19 patient?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- D3 --}}
                        <flux:radio.group wire:model="section_d.symptoms_contact"
                            label="D3. Have you had close contact with a person exhibiting symptoms of acute respiratory illness?">
                            <flux:radio value="yes" label="Yes" />
                            <flux:radio value="no" label="No" />
                        </flux:radio.group>

                        {{-- D4 --}}
                        <div class="space-y-2">
                            <flux:radio.group wire:model.live="section_d.vaccine_received"
                                label="D4. Have you received a vaccine against COVID-19?">
                                <flux:radio value="yes" label="Yes" />
                                <flux:radio value="no" label="No" />
                            </flux:radio.group>
                            @if ($section_d['vaccine_received'] === 'yes')
                                <div wire:transition>
                                    <flux:input wire:model="section_d.vaccine_details"
                                        label="Indicate the type of vaccine" placeholder="e.g. Pfizer" />
                                    <flux:input type="date" wire:model="section_d.vaccine_date"
                                        label="Indicate the date vaccine" />
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- ── STEP 5: Review & Confirm ── --}}
        @if ($step === 5)
            <div wire:transition>
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-red-100">
                    <div class="flex items-center justify-center w-9 h-9 rounded-full bg-red-50 text-red-600 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <flux:heading class="text-base! font-semibold! text-gray-800!">Review & Confirm</flux:heading>
                        <p class="text-xs text-gray-500 mt-0.5">Please review all your answers carefully before
                            submitting.</p>
                    </div>
                </div>

                <div class="space-y-5 text-sm">

                    {{-- Personal Data --}}
                    <div class="rounded-xl border border-gray-200 overflow-hidden">
                        <div class="flex items-center gap-2 bg-red-50 px-4 py-2.5 border-b border-red-100">
                            <span>👤</span>
                            <p class="text-xs font-bold text-red-700 uppercase tracking-wider">Personal Data</p>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-px bg-gray-100">
                            @foreach ([
        'Surname' => $personal['surname'],
        'Given Name' => $personal['given_name'],
        'Middle Name' => $personal['middle_name'] ?: '—',
        'Date of Birth' => $personal['birthdate'],
        'Sex' => $personal['sex'],
        'Civil Status' => $personal['civil_status'],
        'Occupation' => $personal['occupation'],
        'House No/Street' => $personal['house_no'] ?: '—',
        'Subdivision' => $personal['subdivision'] ?: '—',
        'Barangay' => $personal['barangay'],
        'City/Province' => $personal['city_province'],
        'Email' => $personal['email'],
        'Contact No.' => $personal['contact_number'],
    ] as $label => $val)
                                <div class="bg-white px-3 py-2">
                                    <p class="text-[0.65rem] text-gray-400 uppercase tracking-wide mb-0.5">
                                        {{ $label }}</p>
                                    <p class="font-medium text-gray-800">{{ $val }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Medical History --}}
                    <div class="rounded-xl border border-gray-200 overflow-hidden">
                        <div class="flex items-center gap-2 bg-red-50 px-4 py-2.5 border-b border-red-100">
                            <span>🩺</span>
                            <p class="text-xs font-bold text-red-700 uppercase tracking-wider">General Medical History
                            </p>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @foreach ([['label' => 'Donated before?', 'val' => $history['donated_before']], ['label' => 'Last donation info', 'val' => $history['last_donation_info'] ?: '—', 'skip' => $history['donated_before'] !== 'yes'], ['label' => 'Used different name?', 'val' => $history['used_different_name']], ['label' => 'Deferred before?', 'val' => $history['deferred_before']]] as $row)
                                @if (empty($row['skip']))
                                    <div class="flex items-center justify-between px-4 py-2.5 bg-white">
                                        <p class="text-xs text-gray-600">{{ $row['label'] }}</p>
                                        <span
                                            @class([
                                                'text-xs font-semibold px-2 py-0.5 rounded-full',
                                                'bg-red-100 text-red-700' => $row['val'] === 'yes',
                                                'bg-green-100 text-green-700' => $row['val'] === 'no',
                                                'bg-gray-100 text-gray-500' => !in_array($row['val'], ['yes', 'no']),
                                            ])>{{ in_array($row['val'], ['yes', 'no']) ? $this->yesNo($row['val']) : $row['val'] }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    {{-- Section A --}}
                    <div class="rounded-xl border border-amber-200 overflow-hidden">
                        <div class="flex items-center gap-2 bg-amber-50 px-4 py-2.5 border-b border-amber-100">
                            <span>📋</span>
                            <p class="text-xs font-bold text-amber-700 uppercase tracking-wider">Section A — Past 18
                                Months</p>
                        </div>
                        <div class="divide-y divide-gray-100">
                            <div class="flex items-center justify-between px-4 py-2.5 bg-white">
                                <p class="text-xs text-gray-600 pr-4">High blood pressure, night sweats, unexplained
                                    fevers/weight loss, persistent diarrhea, or enlarged lymph node?</p>
                                <span @class([
                                    'text-xs font-semibold px-2 py-0.5 rounded-full shrink-0',
                                    'bg-red-100 text-red-700' => $section_a['symptoms'] === 'yes',
                                    'bg-green-100 text-green-700' => $section_a['symptoms'] === 'no',
                                    'bg-gray-100 text-gray-500' => !$section_a['symptoms'],
                                ])>{{ $this->yesNo($section_a['symptoms']) }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Section B --}}
                    <div class="rounded-xl border border-gray-200 overflow-hidden">
                        <div class="flex items-center gap-2 bg-red-50 px-4 py-2.5 border-b border-red-100">
                            <span>📋</span>
                            <p class="text-xs font-bold text-red-700 uppercase tracking-wider">Section B — Past 12
                                Months</p>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @foreach ([
        'B1. Had listed conditions (malaria, hepatitis, cancer, etc.)?' => $section_b['diseases'],
        'B2. Under doctor\'s care or had major illness/surgery?' => $section_b['doctor_care'],
        'B3. Dental surgery (12 mo) or tooth extraction (6 mo)?' => $section_b['dental'],
        'B4. Taken prohibited drugs?' => $section_b['drugs'],
        'B5. Received blood/clotting factors or organ transplant?' => $section_b['transplant'],
        'B6. Tattoo, piercing, acupuncture, or needle stick?' => $section_b['tattoo'],
        'B7. Same-sex or multiple sexual partners?' => $section_b['sex_multi'],
        'B8. Sex with unmedically-supervised injection user?' => $section_b['sex_unsupervised'],
        'B9. Contact with anyone who had hepatitis?' => $section_b['hepatitis_contact'],
        'B10. Paid or been paid for sex?' => $section_b['sex_money'],
        'B11. Partner who is bisexual, IV drug user, or HIV+?' => $section_b['sex_bisexual'],
        'B12. Travelled to malaria-endemic areas?' => $section_b['malaria_area'],
        'B13. Been in jail or prison?' => $section_b['jail'],
    ] as $label => $val)
                                <div class="flex items-center justify-between px-4 py-2.5 bg-white">
                                    <p class="text-xs text-gray-600 pr-4">{{ $label }}</p>
                                    <span @class([
                                        'text-xs font-semibold px-2 py-0.5 rounded-full shrink-0',
                                        'bg-red-100 text-red-700' => $val === 'yes',
                                        'bg-green-100 text-green-700' => $val === 'no',
                                        'bg-gray-100 text-gray-500' => !$val,
                                    ])>{{ $this->yesNo($val) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Section C --}}
                    <div class="rounded-xl border border-gray-200 overflow-hidden">
                        <div class="flex items-center gap-2 bg-red-50 px-4 py-2.5 border-b border-red-100">
                            <span>🕐</span>
                            <p class="text-xs font-bold text-red-700 uppercase tracking-wider">Section C — Past 4 Weeks
                                / 24 Hours</p>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @foreach ([
        'C1. Taken Accutane, Finasteride, or other listed medications?' => $section_c['meds'],
        'C2. Received growth hormone or brain covering graft?' => $section_c['growth_hormone'],
        'C3. Alcohol intake in the past 24 hours?' => $section_c['alcohol'],
        'C4. Intend to pilot/drive heavy vehicle after donating?' => $section_c['pilot_driver'],
        'C5. Currently ill, allergic, or with infectious disease?' => $section_c['illness'],
    ] as $label => $val)
                                <div class="flex items-center justify-between px-4 py-2.5 bg-white">
                                    <p class="text-xs text-gray-600 pr-4">{{ $label }}</p>
                                    <span @class([
                                        'text-xs font-semibold px-2 py-0.5 rounded-full shrink-0',
                                        'bg-red-100 text-red-700' => $val === 'yes',
                                        'bg-green-100 text-green-700' => $val === 'no',
                                        'bg-gray-100 text-gray-500' => !$val,
                                    ])>{{ $this->yesNo($val) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Section D --}}
                    <div class="rounded-xl border border-blue-200 overflow-hidden">
                        <div class="flex items-center gap-2 bg-blue-50 px-4 py-2.5 border-b border-blue-100">
                            <span>🦠</span>
                            <p class="text-xs font-bold text-blue-700 uppercase tracking-wider">Section D — COVID-19
                                (Past 28 Days)</p>
                        </div>
                        <div class="divide-y divide-gray-100">
                            <div class="flex items-center justify-between px-4 py-2.5 bg-white">
                                <p class="text-xs text-gray-600 pr-4">D1. Travelled outside the Philippines?
                                    @if ($section_d['travel_intl'] === 'yes' && $section_d['travel_countries'])
                                        <span class="text-gray-400">({{ $section_d['travel_countries'] }})</span>
                                    @endif
                                </p>
                                <span @class([
                                    'text-xs font-semibold px-2 py-0.5 rounded-full shrink-0',
                                    'bg-red-100 text-red-700' => $section_d['travel_intl'] === 'yes',
                                    'bg-green-100 text-green-700' => $section_d['travel_intl'] === 'no',
                                    'bg-gray-100 text-gray-500' => !$section_d['travel_intl'],
                                ])>{{ $this->yesNo($section_d['travel_intl']) }}</span>
                            </div>
                            @foreach ([
        'D2. Close contact with confirmed COVID-19 patient?' => $section_d['covid_contact'],
        'D3. Contact with person with acute respiratory symptoms?' => $section_d['symptoms_contact'],
    ] as $label => $val)
                                <div class="flex items-center justify-between px-4 py-2.5 bg-white">
                                    <p class="text-xs text-gray-600 pr-4">{{ $label }}</p>
                                    <span @class([
                                        'text-xs font-semibold px-2 py-0.5 rounded-full shrink-0',
                                        'bg-red-100 text-red-700' => $val === 'yes',
                                        'bg-green-100 text-green-700' => $val === 'no',
                                        'bg-gray-100 text-gray-500' => !$val,
                                    ])>{{ $this->yesNo($val) }}</span>
                                </div>
                            @endforeach
                            <div class="flex items-center justify-between px-4 py-2.5 bg-white">
                                <p class="text-xs text-gray-600 pr-4">D4. Vaccinated against COVID-19?
                                    @if ($section_d['vaccine_received'] === 'yes' && $section_d['vaccine_details'])
                                        <span class="text-gray-400">({{ $section_d['vaccine_details'] }})</span>
                                    @endif
                                </p>
                                <span
                                    @class([
                                        'text-xs font-semibold px-2 py-0.5 rounded-full shrink-0',
                                        'bg-red-100 text-red-700' => $section_d['vaccine_received'] === 'yes',
                                        'bg-green-100 text-green-700' => $section_d['vaccine_received'] === 'no',
                                        'bg-gray-100 text-gray-500' => !$section_d['vaccine_received'],
                                    ])>{{ $this->yesNo($section_d['vaccine_received']) }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Section E — Female Only --}}
                    @if ($personal['sex'] === 'Female')
                        <div class="rounded-xl border border-pink-200 overflow-hidden">
                            <div class="flex items-center gap-2 bg-pink-50 px-4 py-2.5 border-b border-pink-100">
                                <span>🌸</span>
                                <p class="text-xs font-bold text-pink-700 uppercase tracking-wider">Section E — Female
                                    Donors</p>
                            </div>
                            <div class="p-4 grid grid-cols-1 sm:grid-cols-2 gap-4 bg-white">
                                <flux:input wire:model="section_e.delivery" label="E1. Last Delivery Date"
                                    type="date" />
                                <flux:input wire:model="section_e.menstruation" label="E2. Last Menstruation Date"
                                    type="date" />
                            </div>
                        </div>
                    @endif

                    {{-- Consent --}}
                    <div class="rounded-xl border border-red-200 bg-red-50/40 p-4">
                        <div class="flex gap-3 mb-4">
                            <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-xs text-gray-600 italic leading-relaxed">
                                "I voluntarily give my consent for the collection, use, and processing of my personal
                                data to <strong class="not-italic font-semibold text-red-700">OPERATION LIFELINE –
                                    VMMC</strong>. I declare that I have truthfully answered all of the above
                                questions."
                            </p>
                        </div>
                        <flux:checkbox wire:model.live="consent"
                            label="I have read and understand the consent terms." />
                        @error('consent')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

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
                <span class="text-xs text-gray-400 hidden sm:block">Step {{ $step }} of 5</span>
                @if ($step < 5)
                    <flux:button wire:click="nextStep" variant="primary" icon:trailing="chevron-right">Next
                    </flux:button>
                @else
                    <flux:button wire:click="submit" variant="primary" :disabled="!$consent" icon="check">Submit
                    </flux:button>
                @endif
            </div>
        </div>

    </flux:card>
</div>

@script
    <script>
        $wire.on('open-pdf', ({
            data
        }) => {
            fetch('{{ route('vmmc.pdf') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify(data),
                })
                .then(res => {
                    if (!res.ok) throw new Error('PDF generation failed: ' + res.status);
                    return res.blob();
                })
                .then(blob => {
                    const blobUrl = URL.createObjectURL(blob);
                    window.open(blobUrl, '_blank');
                })
                .catch(err => alert(err.message));
        });
    </script>
@endscript

<?php

use App\Jobs\SendRedCrossDonorPdfEmail;
use App\Models\Hospital;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

new class extends Component {
    public int $step = 1;

    public bool $submitted = false;

    public bool $registrationFull = false;

    public bool $consent = false;

    public bool $is_representative = false;

    public string $preferred_date = '';

    public array $representative = [
        'first_name' => '',
        'surname' => '',
        'student_employee_id' => '',
        'house_heroes' => '',
    ];

    public array $personal = [
        // Name Row
        'surname' => '',
        'first_name' => '',
        'middle_name' => '',

        // Demographics Row
        'birthdate' => '',
        'age' => '',
        'civil_status' => '',
        'sex' => '',

        // Permanent Address Row
        'address_street' => '',
        'address_barangay' => '',
        'address_town' => '',
        'address_province' => '',
        'address_zip' => '',

        // Additional Info
        'nationality' => '',
        'religion' => '',
        'education' => '',
        'occupation' => '',

        // Contact Info
        'mobile_no' => '',
        'telephone_no' => '',
        'email' => '',
        'bloodtype' => '',
        'house_heroes' => '',
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
                'personal.sex' => 'required|in:Male,Female',
                'personal.mobile_no' => 'required|string',
                'personal.address_town' => 'required|string',
                'personal.address_province' => 'required|string',
                'personal.email' => 'required|email',
                'personal.middle_name' => 'nullable|string',
                'personal.civil_status' => 'nullable|string',
                'personal.nationality' => 'nullable|string',
                'personal.religion' => 'nullable|string',
                'preferred_date' => 'required|in:2026-03-13,2026-03-20',
                'representative.first_name' => [Rule::requiredIf(fn() => $this->is_representative), 'nullable', 'string'],
                'representative.surname' => [Rule::requiredIf(fn() => $this->is_representative), 'nullable', 'string'],
                'representative.student_employee_id' => [Rule::requiredIf(fn() => $this->is_representative), 'nullable', 'string'],
                'personal.bloodtype' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-,Unknown',
                'personal.house_heroes' => [Rule::requiredIf(fn() => !$this->is_representative), 'nullable', 'string', 'in:Makadiyos,Makabayan,Makakalikasan,Makatao'],
                'representative.house_heroes' => [Rule::requiredIf(fn() => $this->is_representative), 'nullable', 'string', 'in:Makadiyos,Makabayan,Makakalikasan,Makatao'],
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
                'personal.birthdate.required' => 'Birthdate is required.',
                'personal.sex.required' => 'Sex is required.',
                'personal.mobile_no.required' => 'Mobile number is required.',
                'personal.address_town.required' => 'Town/Municipality is required.',
                'personal.address_province.required' => 'Province is required.',
                'personal.email.required' => 'Email address is required.',
                'personal.email.email' => 'Please enter a valid email address.',
                'representative.first_name.required' => 'First name of the person being represented is required.',
                'representative.surname.required' => 'Surname of the person being represented is required.',
                'representative.student_employee_id.required' => 'Student/Employee ID of the person being represented is required.',
            ],
            default => [],
        };
    }

    public function mount(): void
    {
        $hospital = Hospital::where('name', 'Red Cross')->first();

        if ($hospital) {
            $this->registrationFull = $hospital->forms()->count() >= 250;
        }
    }

    public function nextStep(): void
    {
        $this->validate($this->rulesForStep($this->step), $this->messagesForStep($this->step));

        if ($this->step === 1 && \App\Models\Form::where('donor_email', $this->personal['email'] ?? '')->exists()) {
            $this->addError('personal.email', 'This email has already been used to register.');
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

        $redCross = Hospital::where('name', 'Red Cross')->firstOrFail();

        $totalCount = $redCross->forms()->count();

        if ($totalCount >= 250) {
            $this->registrationFull = true;
            $this->addError('preferred_date', 'Registration is now full.');
            $this->step = 1;
            $this->js('window.scrollTo({top: 0, behavior: "smooth"})');
            return;
        }

        $existingCount = $redCross->forms()->where('form_data->preferred_date', $this->preferred_date)->count();

        $queueNumber = 'RDC' . str_pad($existingCount + 1, 4, '0', STR_PAD_LEFT);

        $redCross->forms()->create([
            'donor_name' => trim($this->personal['surname'] . ', ' . $this->personal['first_name'] . ' ' . $this->personal['middle_name']),
            'donor_email' => $this->personal['email'] ?? '',
            'form_data' => [
                'personal' => $this->personal,
                'representative' => $this->is_representative ? $this->representative : null,
                'preferred_date' => $this->preferred_date,
                'queue_number' => $queueNumber,
            ],
        ]);

        $surname = strtoupper($this->personal['surname'] ?? 'donor');
        $firstName = strtoupper($this->personal['first_name'] ?? '');
        $filename = str_replace(' ', '_', "RedCross-BloodDonor-{$surname}-{$firstName}.pdf");
        $donorName = trim($firstName . ' ' . $surname);
        $email = $this->personal['email'] ?? '';
        $pdfData = [
            'personal' => $this->personal,
            'representative' => $this->is_representative ? $this->representative : null,
            'preferred_date' => $this->preferred_date,
            'queue_number' => $queueNumber,
        ];

        SendRedCrossDonorPdfEmail::dispatch($donorName, $email, $filename, $pdfData);

        $this->submitted = true;
        $this->js('window.scrollTo({top: 0, behavior: "smooth"})');
    }
}; ?>

<div>
    {{-- Registration Full Banner --}}
    @if ($registrationFull)
        <flux:card class="shadow-sm border-red-200!">
            <div class="text-center py-10 px-6">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-red-100 mx-auto mb-5">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-red-700 mb-2">Registration is Now Full</h2>
                <p class="text-sm text-gray-600 mb-1">We have reached the maximum registration for this blood donation
                    drive.</p>
                <p class="text-sm text-gray-600">If you believe this is a mistake or need further assistance, please
                    <strong>contact the admin</strong>.</p>
            </div>
        </flux:card>
    @elseif ($submitted)
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
            <div class="flex items-center justify-between relative max-w-md mx-auto">
                <div class="absolute top-5 left-0 right-0 h-0.5 bg-red-100 z-0 mx-6"></div>
                <div class="absolute top-5 left-0 h-0.5 bg-red-500 z-0 mx-6 transition-all duration-500"
                    style="width: calc({{ ($step - 1) / 1 }} * (100% - 3rem))"></div>

                @foreach ([['label' => 'Donor Data'], ['label' => 'Review']] as $i => $s)
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
                            <flux:heading class="text-base! font-semibold!">Personal Data (Donor)</flux:heading>
                            <p class="text-xs text-gray-500 mt-0.5">Please fill in all information accurately.</p>
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
                                <flux:select wire:model="representative.house_heroes" label="House of Heroes *">
                                    <flux:select.option value="">Select...</flux:select.option>
                                    <flux:select.option value="Makadiyos">Makadiyos</flux:select.option>
                                    <flux:select.option value="Makabayan">Makabayan</flux:select.option>
                                    <flux:select.option value="Makakalikasan">Makakalikasan</flux:select.option>
                                    <flux:select.option value="Makatao">Makatao</flux:select.option>
                                </flux:select>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-6">
                        {{-- Section 1: Name --}}
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <flux:input wire:model="personal.surname" label="Surname *" placeholder="Surname" />
                            <flux:input wire:model="personal.first_name" label="First Name *"
                                placeholder="First Name" />
                            <flux:input wire:model="personal.middle_name" label="Middle Name"
                                placeholder="Middle Name" />
                        </div>

                        {{-- Section 2: Demographics --}}
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <flux:input wire:model.live="personal.birthdate" type="date" label="Birthdate *" />
                            <flux:input wire:model="personal.age" label="Age" readonly class="bg-gray-50!" />
                            <flux:select wire:model="personal.civil_status" label="Civil Status">
                                <flux:select.option value="">Select...</flux:select.option>
                                <flux:select.option value="Single">Single</flux:select.option>
                                <flux:select.option value="Married">Married</flux:select.option>
                                <flux:select.option value="Separated">Separated</flux:select.option>
                                <flux:select.option value="Widowed">Widowed</flux:select.option>
                            </flux:select>
                            <flux:select wire:model="personal.sex" label="Sex *">
                                <flux:select.option value="">Select...</flux:select.option>
                                <flux:select.option value="Male">Male</flux:select.option>
                                <flux:select.option value="Female">Female</flux:select.option>
                            </flux:select>
                            <flux:select wire:model="personal.bloodtype" label="Blood Type *">
                                <flux:select.option value="">Select...</flux:select.option>
                                <flux:select.option value="A+">A+</flux:select.option>
                                <flux:select.option value="A-">A-</flux:select.option>
                                <flux:select.option value="B+">B+</flux:select.option>
                                <flux:select.option value="B-">B-</flux:select.option>
                                <flux:select.option value="AB+">AB+</flux:select.option>
                                <flux:select.option value="AB-">AB-</flux:select.option>
                                <flux:select.option value="O+">O+</flux:select.option>
                                <flux:select.option value="O-">O-</flux:select.option>
                                <flux:select.option value="Unknown">I don't know</flux:select.option>
                            </flux:select>
                        </div>

                        {{-- Section 3: Permanent Address --}}
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Permanent Address
                            </p>
                            <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                                <flux:input wire:model="personal.address_street" label="No. / Street"
                                    class="sm:col-span-1" />
                                <flux:input wire:model="personal.address_barangay" label="Barangay"
                                    class="sm:col-span-1" />
                                <flux:input wire:model="personal.address_town" label="Town/Municipality *"
                                    class="sm:col-span-1" />
                                <flux:input wire:model="personal.address_province" label="Province/City *"
                                    class="sm:col-span-1" />
                                <flux:input wire:model="personal.address_zip" label="Zip Code"
                                    class="sm:col-span-1" />
                            </div>
                        </div>

                        {{-- Section 4: Other Info --}}
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 border-t border-gray-100 pt-5">
                            <flux:input wire:model="personal.nationality" label="Nationality" />
                            <flux:input wire:model="personal.religion" label="Religion" />
                            <flux:input wire:model="personal.education" label="Education" />
                            <flux:input wire:model="personal.occupation" label="Occupation" />
                        </div>

                        @if (!$is_representative)
                            <flux:select wire:model="personal.house_heroes" label="House of Heroes *">
                                <flux:select.option value="">Select...</flux:select.option>
                                <flux:select.option value="Makadiyos">Makadiyos</flux:select.option>
                                <flux:select.option value="Makabayan">Makabayan</flux:select.option>
                                <flux:select.option value="Makakalikasan">Makakalikasan</flux:select.option>
                                <flux:select.option value="Makatao">Makatao</flux:select.option>
                            </flux:select>
                        @endif

                        {{-- Section 5: Contact --}}
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <flux:input wire:model="personal.mobile_no" label="Mobile No. *"
                                placeholder="09XXXXXXXXX" />
                            <flux:input wire:model="personal.telephone_no" label="Telephone No." />
                            <flux:input wire:model="personal.email" type="email" label="E-mail Address" />
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
                            <flux:heading class="text-base! font-semibold!">Review Donor Information</flux:heading>
                            <p class="text-xs text-gray-500 mt-0.5">Please confirm all details are correct before
                                submission.</p>
                        </div>
                    </div>

                    <div class="rounded-xl border border-gray-200 overflow-hidden">
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-px bg-gray-100">
                            @foreach ([
        'Full Name' => $personal['first_name'] . ' ' . $personal['middle_name'] . ' ' . $personal['surname'],
        'Birthdate' => $personal['birthdate'],
        'Age / Sex' => ($personal['age'] ?? '—') . ' / ' . ($personal['sex'] ?? '—'),
        'Blood Type' => $personal['bloodtype'] ?: '—',
        'Civil Status' => $personal['civil_status'] ?: '—',
        'House of Heroes' => $is_representative ? ($representative['house_heroes'] ?: '—') : ($personal['house_heroes'] ?: '—'),
        'Address' => "{$personal['address_street']}, {$personal['address_barangay']}, {$personal['address_town']}, {$personal['address_province']} {$personal['address_zip']}",
        'Nationality' => $personal['nationality'] ?: '—',
        'Religion' => $personal['religion'] ?: '—',
        'Mobile' => $personal['mobile_no'],
        'Email' => $personal['email'] ?: '—',
    ] as $label => $val)
                                <div class="bg-white px-3 py-2">
                                    <p class="text-[0.65rem] text-gray-400 uppercase tracking-wide mb-0.5">
                                        {{ $label }}</p>
                                    <p class="font-medium text-gray-800 text-sm">{{ $val }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if ($is_representative)
                        <div class="mt-5 rounded-xl border border-amber-200 overflow-hidden">
                            <div class="flex items-center gap-2 bg-amber-50 px-4 py-2.5 border-b border-amber-100">
                                <span>🔁</span>
                                <p class="text-xs font-bold text-amber-700 uppercase tracking-wider">Donating as
                                    Representative For</p>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-px bg-gray-100">
                                @foreach ([
        'First Name' => $representative['first_name'],
        'Surname' => $representative['surname'],
        'Student/Employee ID' => $representative['student_employee_id'],
        'House of Heroes' => $representative['house_heroes'] ?: '—',
    ] as $label => $val)
                                    <div class="bg-white px-3 py-2">
                                        <p class="text-[0.65rem] text-gray-400 uppercase tracking-wide mb-0.5">
                                            {{ $label }}</p>
                                        <p class="font-medium text-gray-800 text-sm">{{ $val }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Consent --}}
                    <div class="mt-5 rounded-xl border border-red-200 bg-red-50/40 p-4">
                        <div class="flex gap-3 mb-4">
                            <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-xs text-gray-600 italic leading-relaxed">
                                "I voluntarily give my consent for the collection, use, and processing of my personal
                                data to <strong class="not-italic font-semibold text-red-700">Philippine Red
                                    Cross</strong>.
                                I declare that I have truthfully answered all of the above questions."
                            </p>
                        </div>
                        <flux:checkbox wire:model.live="consent"
                            label="I have read and understand the consent terms." />
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
                    @if ($step < 2)
                        <flux:button wire:click="nextStep" variant="primary" icon-trailing="chevron-right"
                            class="bg-red-600! hover:bg-red-700!">Next</flux:button>
                    @else
                        <flux:button wire:click="submit" variant="primary" icon="check" :disabled="!$consent"
                            class="bg-red-600! hover:bg-red-700!">Submit</flux:button>
                    @endif
                </div>
            </div>
        </flux:card>
    @endif
</div>

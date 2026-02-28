<?php

use Livewire\Component;
use Carbon\Carbon;

new class extends Component {
    public int $step = 1;

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
                'personal.email' => 'nullable|email',
                'personal.middle_name' => 'nullable|string',
                'personal.civil_status' => 'nullable|string',
                'personal.nationality' => 'nullable|string',
                'personal.religion' => 'nullable|string',
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
            ],
            default => [],
        };
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
        $this->dispatch(
            'open-pdf',
            data: [
                'personal' => $this->personal,
            ],
        );
    }
}; ?>

<div>
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
                    <div class="flex items-center justify-center w-9 h-9 rounded-full bg-red-50 text-red-600 shrink-0">
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

                <div class="space-y-6">
                    {{-- Section 1: Name --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <flux:input wire:model="personal.surname" label="Surname *" placeholder="Surname" />
                        <flux:input wire:model="personal.first_name" label="First Name *" placeholder="First Name" />
                        <flux:input wire:model="personal.middle_name" label="Middle Name" placeholder="Middle Name" />
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
                    </div>

                    {{-- Section 3: Permanent Address --}}
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Permanent Address</p>
                        <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                            <flux:input wire:model="personal.address_street" label="No. / Street"
                                class="sm:col-span-1" />
                            <flux:input wire:model="personal.address_barangay" label="Barangay" class="sm:col-span-1" />
                            <flux:input wire:model="personal.address_town" label="Town/Municipality *"
                                class="sm:col-span-1" />
                            <flux:input wire:model="personal.address_province" label="Province/City *"
                                class="sm:col-span-1" />
                            <flux:input wire:model="personal.address_zip" label="Zip Code" class="sm:col-span-1" />
                        </div>
                    </div>

                    {{-- Section 4: Other Info --}}
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 border-t border-gray-100 pt-5">
                        <flux:input wire:model="personal.nationality" label="Nationality" />
                        <flux:input wire:model="personal.religion" label="Religion" />
                        <flux:input wire:model="personal.education" label="Education" />
                        <flux:input wire:model="personal.occupation" label="Occupation" />
                    </div>

                    {{-- Section 5: Contact --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <flux:input wire:model="personal.mobile_no" label="Mobile No. *" placeholder="09XXXXXXXXX" />
                        <flux:input wire:model="personal.telephone_no" label="Telephone No." />
                        <flux:input wire:model="personal.email" type="email" label="E-mail Address" />
                    </div>
                </div>
            </div>
        @endif

        @if ($step === 2)
            <div wire:transition>
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-red-100">
                    <div class="flex items-center justify-center w-9 h-9 rounded-full bg-red-50 text-red-600 shrink-0">
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
        'Civil Status' => $personal['civil_status'] ?: '—',
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
                    <flux:button wire:click="submit" variant="primary" icon="check"
                        class="bg-red-600! hover:bg-red-700!">Submit & Generate PDF</flux:button>
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
            fetch('{{ route('redcross.pdf') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify(data),
                })
                .then(res => res.blob())
                .then(blob => window.open(URL.createObjectURL(blob), '_blank'))
                .catch(err => alert('Error generating PDF'));
        });
    </script>
@endscript

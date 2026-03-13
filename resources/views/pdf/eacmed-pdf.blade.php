<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="bg-white text-black font-sans text-[10px]">

    @php
        $personal = $data['personal'] ?? $data;

        $surname = strtoupper($personal['surname'] ?? ($personal['last_name'] ?? ''));
        $firstName = strtoupper($personal['first_name'] ?? '');
        $middleName = strtoupper($personal['middle_name'] ?? '');

        $rawBirthdate = $personal['birthdate'] ?? '';
        $birthdate = '';
        if ($rawBirthdate) {
            try {
                $birthdate = \Carbon\Carbon::parse($rawBirthdate)->format('m/d/Y');
            } catch (\Exception $e) {
                $birthdate = $rawBirthdate;
            }
        }

        $age = $personal['age'] ?? '';
        $gender = strtolower($personal['gender'] ?? ($personal['sex'] ?? ''));
        $civilStatus = $personal['civil_status'] ?? '';
        $contactNo = $personal['contact_no'] ?? ($personal['cellphone'] ?? '');
        $email = $personal['email'] ?? ($personal['email_address'] ?? '');
        $nationality = $personal['nationality'] ?? '';
        $occupation = $personal['occupation'] ?? '';

        $streetAddress = $personal['street_address'] ?? ($personal['address'] ?? '');
        $barangay = $personal['barangay'] ?? '';
        $townDistrict = $personal['town_district'] ?? '';
        $city = $personal['city'] ?? '';
        $province = $personal['province'] ?? '';
        $zipCode = $personal['zip_code'] ?? '';

        $donorType = strtolower($personal['donor_type'] ?? '');
        $donorStatus = strtolower($personal['donor_status'] ?? '');
        $collection = strtolower($personal['method_of_collection'] ?? '');

        $eacCheck = fn(bool $checked): string => $checked ? '&#10003;' : '';
    @endphp

    <div class="max-w-4xl mx-auto px-4 py-2">

        <div class="text-xs leading-snug mb-1">
            {{-- <p class="font-semibold">Queue No: {{ $queue_number ?? '' }} | NCST Blood Donation</p> --}}
            <p>NCST,
                {{ isset($preferred_date) && $preferred_date ? \Carbon\Carbon::parse($preferred_date)->format('F j, Y') : '' }},
                8:00 AM</p>
        </div>

        {{-- ===== HEADER ===== --}}
        <div class="flex items-center justify-center gap-4 mb-1">
            <img src="{{ asset('images/eacmed.png') }}" alt="EACMed Logo" class="h-14 w-auto object-contain" />
            <div class="text-center leading-tight">
                <p class="text-[13px] font-extrabold uppercase tracking-wide">EMILIO AGUINALDO COLLEGE MEDICAL CENTER
                    CAVITE</p>
                <p class="text-[9px]">Brgy. Salitran II, City of Dasmariñas, Cavite</p>
                <p class="text-[9px]">(046) 416 - 3010</p>
                <p class="text-[10px] font-bold mt-1">Department of Laboratory Medicine - Blood Bank Section</p>
            </div>
        </div>

        <p class="text-center text-[12px] font-extrabold uppercase tracking-widest mb-2">BLOOD DONOR HISTORY
            QUESTIONNAIRE</p>

        {{-- ===== PERSONAL DATA TABLE ===== --}}
        <table class="w-full border-collapse border border-black text-[10px]">

            {{-- Date row --}}
            <tr>
                <td colspan="6" class="border border-black text-right pr-1 py-0.5">
                    <span class="font-bold">Date</span>
                </td>
            </tr>

            {{-- Last Name | First Name | Middle Name --}}
            <tr>
                <td class="border border-black px-1 py-0 w-1/3">
                    <p class="font-bold text-[9px] leading-none mb-0.5">Last Name</p>
                    <p class="min-h-[14px]">{{ $surname }}</p>
                </td>
                <td class="border border-black px-1 py-0 w-1/3">
                    <p class="font-bold text-[9px] leading-none mb-0.5">First Name</p>
                    <p class="min-h-[14px]">{{ $firstName }}</p>
                </td>
                <td class="border border-black px-1 py-0 w-1/3">
                    <p class="font-bold text-[9px] leading-none mb-0.5">Middle Name</p>
                    <p class="min-h-[14px]">{{ $middleName }}</p>
                </td>
            </tr>

            {{-- Birthdate | Age | Gender | Civil Status | Contact No. --}}
            <tr>
                <td class="border border-black px-1 py-0">
                    <p class="font-bold text-[9px] leading-none mb-0.5">Birthdate <span
                            class="font-normal italic">(mm/dd/yyyy)</span></p>
                    <p class="min-h-[14px]">{{ $birthdate }}</p>
                </td>
                <td class="border border-black px-1 py-0 w-[6%]">
                    <p class="font-bold text-[9px] leading-none mb-0.5">Age</p>
                    <p class="min-h-[14px]">{{ $age }}</p>
                </td>
                <td class="border border-black px-1 py-0 w-[22%]">
                    <p class="font-bold text-[9px] leading-none mb-0.5">Gender</p>
                    <div class="flex gap-3 min-h-[14px] items-center">
                        <span>
                            <span
                                class="border border-black w-3 h-3 inline-flex items-center justify-center text-[8px]">{!! $eacCheck($gender === 'male') !!}</span>
                            Male
                        </span>
                        <span>
                            <span
                                class="border border-black w-3 h-3 inline-flex items-center justify-center text-[8px]">{!! $eacCheck($gender === 'female') !!}</span>
                            Female
                        </span>
                    </div>
                </td>
                <td class="border border-black px-1 py-0 w-[18%]">
                    <p class="font-bold text-[9px] leading-none mb-0.5">Civil Status</p>
                    <p class="min-h-[14px]">{{ $civilStatus }}</p>
                </td>
                <td class="border border-black px-1 py-0 w-[18%]">
                    <p class="font-bold text-[9px] leading-none mb-0.5">Contact No.</p>
                    <p class="min-h-[14px]">{{ $contactNo }}</p>
                </td>
            </tr>

            {{-- E-mail | Nationality | Occupation --}}
            <tr>
                <td class="border border-black px-1 py-0">
                    <p class="font-bold text-[9px] leading-none mb-0.5">E-mail address</p>
                    <p class="min-h-[14px]">{{ $email }}</p>
                </td>
                <td colspan="2" class="border border-black px-1 py-0">
                    <p class="font-bold text-[9px] leading-none mb-0.5">Nationality</p>
                    <p class="min-h-[14px]">{{ $nationality }}</p>
                </td>
                <td colspan="2" class="border border-black px-1 py-0">
                    <p class="font-bold text-[9px] leading-none mb-0.5">Occupation</p>
                    <p class="min-h-[14px]">{{ $occupation }}</p>
                </td>
            </tr>

            {{-- Preferred Mailing Address --}}
            <tr>
                <td colspan="5" class="border border-black px-1 pt-0.5 pb-0">
                    <p class="font-bold text-[9px] leading-none mb-1">Preferred Mailing Address</p>
                    <div class="grid grid-cols-3 gap-x-2 text-center">
                        <div>
                            <p class="border-b border-black min-h-[14px] px-1">{{ $streetAddress }}</p>
                            <p class="text-[8px] italic">Number, Street, Subdivision</p>
                        </div>
                        <div>
                            <p class="border-b border-black min-h-[14px] px-1">{{ $barangay }}</p>
                            <p class="text-[8px] italic">Barangay</p>
                        </div>
                        <div>
                            <p class="border-b border-black min-h-[14px] px-1">{{ $townDistrict }}</p>
                            <p class="text-[8px] italic">Town/District</p>
                        </div>
                    </div>
                </td>
            </tr>

            {{-- City | Province | Zip Code --}}
            <tr>
                <td colspan="2" class="border border-black px-1 py-0">
                    <p class="min-h-[14px]">{{ $city }}</p>
                    <p class="text-[8px] italic text-center">City</p>
                </td>
                <td colspan="2" class="border border-black px-1 py-0">
                    <p class="min-h-[14px]">{{ $province }}</p>
                    <p class="text-[8px] italic text-center">Province</p>
                </td>
                <td class="border border-black px-1 py-0">
                    <p class="min-h-[14px]">{{ $zipCode }}</p>
                    <p class="text-[8px] italic text-center">Zip Code</p>
                </td>
            </tr>

            {{-- Type of Donor --}}
            <tr>
                <td class="border border-black px-1 py-0.5 w-[18%]">
                    <span class="font-bold">Type of Donor:</span>
                </td>
                <td colspan="4" class="border border-black px-1 py-0.5">
                    <div class="flex flex-wrap gap-x-4 gap-y-0.5">
                        <span>
                            <span
                                class="border border-black w-3 h-3 inline-flex items-center justify-center text-[8px]">{!! $eacCheck(str_contains($donorType, 'walk') || str_contains($donorType, 'voluntary')) !!}</span>
                            Walk-in/Voluntary
                        </span>
                        <span>
                            <span
                                class="border border-black w-3 h-3 inline-flex items-center justify-center text-[8px]">{!! $eacCheck(str_contains($donorType, 'autologous')) !!}</span>
                            Autologous
                        </span>
                        <span>
                            <span
                                class="border border-black w-3 h-3 inline-flex items-center justify-center text-[8px]">{!! $eacCheck(str_contains($donorType, 'mbd')) !!}</span>
                            MBD
                        </span>
                    </div>
                    <div class="flex flex-wrap gap-x-4 gap-y-0.5 mt-0.5">
                        <span>
                            <span
                                class="border border-black w-3 h-3 inline-flex items-center justify-center text-[8px]">{!! $eacCheck(str_contains($donorStatus, 'new')) !!}</span>
                            New
                        </span>
                        <span>
                            <span
                                class="border border-black w-3 h-3 inline-flex items-center justify-center text-[8px]">{!! $eacCheck(str_contains($donorStatus, 'repeat')) !!}</span>
                            Repeat
                        </span>
                        <span>
                            <span
                                class="border border-black w-3 h-3 inline-flex items-center justify-center text-[8px]">{!! $eacCheck(str_contains($donorStatus, 'first')) !!}</span>
                            First Time
                        </span>
                        <span>
                            <span
                                class="border border-black w-3 h-3 inline-flex items-center justify-center text-[8px]">{!! $eacCheck(str_contains($donorStatus, 'lapsed')) !!}</span>
                            Lapsed
                        </span>
                        <span>
                            <span
                                class="border border-black w-3 h-3 inline-flex items-center justify-center text-[8px]">{!! $eacCheck(str_contains($donorStatus, 'retained')) !!}</span>
                            Retained
                        </span>
                    </div>
                </td>
            </tr>

            {{-- Method of Collection --}}
            <tr>
                <td class="border border-black px-1 py-0.5">
                    <span class="font-bold">Method of Collection:</span>
                </td>
                <td colspan="4" class="border border-black px-1 py-0.5">
                    <div class="flex gap-6">
                        <span>
                            <span
                                class="border border-black w-3 h-3 inline-flex items-center justify-center text-[8px]">{!! $eacCheck(str_contains($collection, 'whole') || str_contains($collection, 'conventional')) !!}</span>
                            Whole Blood (Conventional)
                        </span>
                        <span>
                            <span
                                class="border border-black w-3 h-3 inline-flex items-center justify-center text-[8px]">{!! $eacCheck(str_contains($collection, 'apheresis')) !!}</span>
                            Apheresis
                        </span>
                    </div>
                </td>
            </tr>

        </table>

        {{-- ===== QUESTIONNAIRE ===== --}}
        <p class="mt-2 mb-1 text-[9px]">
            <span class="font-bold italic">Instructions:</span>
            <span class="italic"> All donors must read the donor educational material provided by the Blood Service
                Facility staff before answering.</span>
        </p>

        @php
            $questions = [
                ['section', 'Are you'],
                ['q', '1.  Feeling healthy today?'],
                ['q', '2.  Currently taking medication?'],
                ['q', '3.  Have you taken any medication from the deferral list?'],
                ['q', '4.  Have you received any vaccination?'],
                ['section', 'In the past 3 days'],
                ['q', '5.  Have you taken aspirin or anything that has aspirin in it?'],
                ['female', null],
                ['q6', '6.  Have you been pregnant or are you pregnant now?'],
                ['section', 'In the past 12 weeks'],
                ['q', '7.  Have you donated blood, platelet or plasma?'],
                ['section', 'In the past 12 months'],
                ['q', '8.   Have you had a blood transfusion?'],
                ['q', '9.   Have you had surgical operation or dental extraction?'],
                [
                    'q',
                    '10.  Have you had a tattoo, ear or body piercing, accidental contact with blood, needle-stick injury, and acupuncture?',
                ],
                ['q', '11.  Have you had sexual contact with high risk individual?'],
                ['q', '12.  Have you had sexual contact with anyone in exchange for material or monetary gain?'],
                ['q', '13.  Have you had sexual contact with a person who has worked abroad?'],
                ['q', '14.  Have you engaged in casual sex?'],
                ['q', '15.  Have you lived with a person who has hepatitis?'],
                ['q', '16.  Have you been imprisoned?'],
                ['q', '17.  Have any of your relative had Creutzfeldt-Jacob (mAdCow) Disease?'],
                ['section', 'Have you ever'],
                ['q', '18.  Lived outside your place of residence?'],
                ['q', '19.  Lived outside the Philippines?'],
                ['q', '20.  Used needles to take drugs, steroids, or anything not prescribed by your doctor?'],
                ['q', '21.  Used a clotting factor concentrate?'],
                ['q', '22.  Have had a positive test for HIV virus, Hepatitis virus, Syphilis or Malaria?'],
                ['q', '23.  Had hepatitis?'],
                ['q', '24.  Had malaria?'],
                [
                    'q',
                    '25.  Been told to have or treated for genital wart, syphilis, gonorrhea, or other sexually transmitted infections?',
                ],
                ['q', '26.  Had any type of cancer (e.g. Leukemia)?'],
                ['q', '27.  Had any problems with your heart and lungs?'],
                ['q', '28.  Had a bleeding condition or a blood disease?'],
                ['q', '29.  Are you giving blood because you wanted to e testes for HIV or Hepatitis virus?'],
                [
                    'q',
                    '30.  Are you aware that if you have the HIV/Hepatitis virus, you can give it to someone else though you may feel well and have a negative HIV/Hepatitis test?',
                ],
            ];
        @endphp

        <table class="w-full border-collapse border border-black text-[10px]">
            <thead>
                <tr>
                    <th class="border border-black px-1 py-0.5 text-left w-[80%]"></th>
                    <th class="border border-black px-1 py-0.5 text-center w-[10%] font-bold">YES</th>
                    <th class="border border-black px-1 py-0.5 text-center w-[10%] font-bold">NO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as [$type, $label])
                    @if ($type === 'section')
                        <tr>
                            <td colspan="3" class="border border-black px-1 py-0.5 font-bold">{{ $label }}
                            </td>
                        </tr>
                    @elseif ($type === 'female')
                        <tr>
                            <td colspan="3" class="border border-black px-1 py-0.5">
                                <span class="font-bold">For FEMALE Donors only:</span><br>
                                <span class="font-bold">In the past 1 and ½ months (6 weeks)</span>
                            </td>
                        </tr>
                    @elseif ($type === 'q6')
                        <tr>
                            <td class="border border-black px-1 py-0.5">
                                {{ $label }}<br>
                                <span class="text-[9px]">Last menstrual period:
                                    <span class="border-b border-black inline-block w-32 align-bottom">&nbsp;</span>
                                </span>
                            </td>
                            <td class="border border-black px-1 py-0.5">&nbsp;</td>
                            <td class="border border-black px-1 py-0.5">&nbsp;</td>
                        </tr>
                    @else
                        <tr>
                            <td class="border border-black px-1 py-0.5">{{ $label }}</td>
                            <td class="border border-black px-1 py-0.5">&nbsp;</td>
                            <td class="border border-black px-1 py-0.5">&nbsp;</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        {{-- ===== DECLARATION ===== --}}
        <div class="mt-3 text-[10px] leading-relaxed space-y-2">
            <p>
                &ldquo;I certify that I am the person referred to in all the entries, which were read and well
                understood
                by me. it is my free and voluntary act to donate my blood, aware of its risks during and after
                extraction. The same have been explained to me in understandable language and dialect I speak.
            </p>
            <p>
                I am voluntarily giving my blood through
                <span class="border-b border-black inline-block w-48 align-bottom">&nbsp;</span>,
                I understand that my blood will be tested for blood type, hemoglobin, malaria, syphilis, Hepatitis B,
                Hepatitis C, and HIV and no official result will be released to me. If I found reactive, I agree to be
                referred to the appropriate facility for counselling and further management.
            </p>
            <p>
                I certify that I have to do the best of my knowledge, truthfully answered the above questions.&rdquo;
            </p>
        </div>

        {{-- ===== EMERGENCY CONTACT & SIGNATURE ===== --}}
        <div class="mt-3 flex items-end justify-between">

            {{-- Emergency contact box --}}
            <div class="border border-black p-2 text-[10px] min-w-[260px]">
                <p class="font-bold mb-1">IN CASE OF EMERGENCY</p>
                <div class="flex flex-col gap-1">
                    <div class="flex items-center gap-1">
                        <span class="w-32 text-right">Contact Person:</span>
                        <span class="flex-1 border-b border-black">&nbsp;</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="w-32 text-right">Address:</span>
                        <span class="flex-1 border-b border-black">&nbsp;</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="w-32 text-right">Contact Number:</span>
                        <span class="flex-1 border-b border-black">&nbsp;</span>
                    </div>
                </div>
            </div>

            {{-- Donor signature --}}
            <div class="text-center text-[10px] min-w-[200px]">
                <div class="border-b border-black mb-1 h-10">&nbsp;</div>
                <p>Donor&rsquo;s Signature</p>
            </div>

        </div>

        {{-- ===== FOR BLOOD BANK USE ONLY ===== --}}
        <div class="mt-4 text-[10px]">

            <p class="font-extrabold">FOR BLOOD BANK USE ONLY</p>
            <p class="font-bold mb-2">Physical Examination</p>

            {{-- Row 1: Body Weight | Blood Pressure | Pulse rate | Temperature --}}
            <div class="flex items-center gap-4 mb-1">
                <span class="font-bold" style="color:#8B6914;">Body Weight</span>
                <span class="border-b border-black w-24">&nbsp;</span>
                <span class="font-bold" style="color:#8B6914;">Blood Pressure</span>
                <span class="border-b border-black w-24">&nbsp;</span>
                <span style="color:#8B6914;">Pulse rate</span>
                <span class="border-b border-black w-24">&nbsp;</span>
                <span style="color:#8B6914;">Temperature</span>
                <span class="border-b border-black w-24">&nbsp;</span>
            </div>

            {{-- Row 2: General Appearance | Skin --}}
            <div class="flex items-center gap-4 mb-1">
                <span class="font-bold" style="color:#8B6914;">General Appearance</span>
                <span class="border-b border-black w-56">&nbsp;</span>
                <span class="ml-4 font-bold" style="color:#8B6914;">Skin</span>
                <span class="border-b border-black flex-1">&nbsp;</span>
            </div>

            {{-- Row 3: HEENT | Heart & Lungs --}}
            <div class="flex items-center gap-4 mb-3">
                <span class="font-extrabold" style="color:#8B6914;">HEENT</span>
                <span class="border-b border-black w-56">&nbsp;</span>
                <span class="ml-4 font-bold" style="color:#8B6914;">Heart&amp; Lungs</span>
                <span class="border-b border-black flex-1">&nbsp;</span>
            </div>

            {{-- Remarks --}}
            <p class="font-bold mb-1">Remarks:</p>
            <div class="flex flex-col gap-1 mb-2 ml-2">
                <div class="flex items-center gap-2">
                    <span class="border border-black w-4 h-4 inline-flex items-center justify-center">&nbsp;</span>
                    <span class="border border-black w-4 h-4 inline-flex items-center justify-center">&nbsp;</span>
                    <span>Accepted</span>
                </div>
                <div class="flex items-start gap-2">
                    <div class="flex items-center gap-2 mt-0.5">
                        <span class="border border-black w-4 h-4 inline-flex items-center justify-center">&nbsp;</span>
                        <span class="border border-black w-4 h-4 inline-flex items-center justify-center">&nbsp;</span>
                    </div>
                    <span class="font-bold" style="color:#8B6914;">Temporarily Deferred</span>
                    <span class="ml-4">Reason for Deferral:</span>
                    <span class="border-b border-black flex-1">&nbsp;</span>
                </div>
                <div class="flex items-center gap-2 ml-[calc(2*1rem+0.5rem)]">
                    <span class="border-b border-black w-full ml-[168px]">&nbsp;</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="border border-black w-4 h-4 inline-flex items-center justify-center">&nbsp;</span>
                    <span class="border border-black w-4 h-4 inline-flex items-center justify-center">&nbsp;</span>
                    <span class="font-bold" style="color:#8B6914;">Permanently Deferred</span>
                </div>
            </div>

            {{-- Blood Bank Officer signature --}}
            <div class="flex justify-end mt-3 mb-4">
                <div class="text-center min-w-[200px]">
                    <div class="border-b border-black mb-1 h-8">&nbsp;</div>
                    <p>Blood Bank Officer</p>
                </div>
            </div>

            {{-- Barcode sticker --}}
            <div class="flex items-center gap-4 mt-2">
                <p><span class="font-normal">Place Barcode Sticker of </span><span class="font-bold">Donation
                        ID</span></p>
                <div class="border border-black w-48 h-14">&nbsp;</div>
            </div>

        </div>

        {{-- ===== PHLEBOTOMY / SCREENING TWO-COLUMN ===== --}}
        <div class="flex gap-0 text-[10px]">

            {{-- LEFT: FOR PHLEBOTOMY USE ONLY --}}
            <div class="border border-black w-1/2 mr-2">
                <div class="border-b border-black px-2 py-0.5 font-bold">FOR PHLEBOTOMY USE ONLY</div>

                {{-- Blood bag --}}
                <div class="border-b border-black px-2 py-0.5 flex items-center gap-3">
                    <span>Blood bag:</span>
                    <span class="flex items-center gap-1">
                        <span class="border border-black w-3 h-3 inline-flex items-center justify-center">&nbsp;</span>
                        Single
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="border border-black w-3 h-3 inline-flex items-center justify-center">&nbsp;</span>
                        Double
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="border border-black w-3 h-3 inline-flex items-center justify-center">&nbsp;</span>
                        Triple
                    </span>
                </div>

                {{-- Fields --}}
                <div class="px-2 py-0.5 border-b border-black">Segment Number: <span
                        class="border-b border-black inline-block w-32">&nbsp;</span></div>
                <div class="px-2 py-0.5 border-b border-black">Time Started: <span
                        class="border-b border-black inline-block w-36">&nbsp;</span></div>
                <div class="px-2 py-0.5 border-b border-black">Time Finished: <span
                        class="border-b border-black inline-block w-32">&nbsp;</span></div>

                {{-- Phlebotomist signature --}}
                <div class="px-2 py-2 mt-4 text-center">
                    <div class="border-b border-black mb-1 h-8">&nbsp;</div>
                    <p>Phlebotomist</p>
                </div>
            </div>

            {{-- RIGHT: FOR SCREENING USE ONLY --}}
            <div class="border border-black w-1/2">
                <div class="border-b border-black px-2 py-0.5 font-bold">FOR SCREENING USE ONLY</div>
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="border border-black px-2 py-0.5 text-center font-bold w-1/2">TEST</th>
                            <th class="border border-black px-2 py-0.5 text-center font-bold w-1/2">RESULT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (['Blood Type', 'Hemoglobin', 'HBsAg', 'RPR', 'HIV', 'HCV', 'Malaria', 'Antibody Screening'] as $test)
                            <tr>
                                <td class="border border-black px-2 py-0.5" style="color:#8B6914;">
                                    {{ $test }}</td>
                                <td class="border border-black px-2 py-0.5">&nbsp;</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" class="border border-black px-2 py-0.5">
                                Screened by:<br>
                                <span class="border-b border-black inline-block w-full mt-3">&nbsp;</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        {{-- ===== SCISSORS CUT LINE ===== --}}
        <div class="relative my-4">
            <div class="border-t border-dashed border-black w-full"></div>
            <span class="absolute -top-3 left-0 text-lg leading-none select-none">✂</span>
        </div>

        {{-- ===== CONFIDENTIAL UNIT EXCLUSION (CUE) ===== --}}
        <div class="text-[10px] mt-2 mb-4">
            <p class="font-bold mb-1">CONFIDENTIAL UNIT EXCLUSION (CUE):</p>
            <p class="mb-3">
                If at any point during or after your blood donation, you realized that your blood may not be safe for
                transfusion, please inform the Blood Service Facility staff immediately. Please use your Blood Donation
                ID Number and the Segment Number written below in identifying you blood donation.
            </p>
            <div class="flex items-center gap-2 mb-3">
                <span>Contact Number of Blood Service Facility:</span>
                <span class="border-b border-black flex-1">&nbsp;</span>
            </div>
            <div class="flex items-center gap-2">
                <span>Segment Number:</span>
                <span class="border-b border-black w-56">&nbsp;</span>
            </div>
        </div>

        {{-- ===== SECOND SCISSORS CUT LINE ===== --}}
        <div class="relative my-4">
            <div class="border-t border-dashed border-black w-full"></div>
            <span class="absolute -top-3 left-0 text-lg leading-none select-none">✂</span>
        </div>

        {{-- ===== SECOND BARCODE STICKER ===== --}}
        <div class="flex items-center gap-4 mt-6">
            <p><span class="font-normal">Place Barcode Sticker of </span><span class="font-bold">Donation ID</span>
            </p>
            <div class="border border-black rounded w-64 h-14">&nbsp;</div>
        </div>

    </div>

</body>

</html>

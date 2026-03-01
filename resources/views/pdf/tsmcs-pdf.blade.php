<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="bg-white text-black font-sans text-[10px]">

    <div class="max-w-5xl mx-auto px-2">

        {{-- ===== HEADER ===== --}}
        <div class="flex items-center gap-2 mb-1">
            <img src="{{ asset('images/tsmc.png') }}" alt="TSMC Logo" class="h-10 w-auto object-contain" />
            <div class="flex flex-col leading-tight">
                <h1 class="text-lg font-extrabold tracking-widest uppercase" style="color: #8B0000;">
                    Tanza Specialists Medical Center
                </h1>
                <p class="text-[8px] text-center tracking-wide text-black">
                    Brgy. Daang Amaya III, Tanza, Cavite &nbsp;|&nbsp; (046) 484-7777 loc. 192 &nbsp;|&nbsp;
                    tsmcbloodbank@gmail.com
                </p>
                <p class="text-[8px] font-bold text-center tracking-widest uppercase text-black">
                    Department of Laboratories - Blood Service Facility
                </p>
            </div>
        </div>

        {{-- ===== DIVIDER ===== --}}
        <hr class="border-t-2 border-black mb-2">

        {{-- ===== THREE-COLUMN INFO SECTION ===== --}}
        <div class="grid grid-cols-3 gap-2">

            {{-- Left: Blood Bank Staff Fields --}}
            <div>
                <p class="italic font-bold text-[9px] mb-0.5">To be filled up by Blood Bank Staff</p>
                <div class="flex flex-col gap-0.5 text-[9px]">
                    <div class="flex items-center gap-1">
                        <span class="whitespace-nowrap" style="color: #8B0000; font-weight: bold;">Blood Type and
                            Rh:</span>
                        <span class="flex-1 border-b border-black"></span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="whitespace-nowrap" style="color: #8B0000; font-weight: bold;">Grading:</span>
                        <span class="flex-1 border-b border-black"></span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="whitespace-nowrap" style="color: #8B0000; font-weight: bold;">Medical
                            Technologist:</span>
                        <span class="flex-1 border-b border-black"></span>
                    </div>
                </div>
            </div>

            {{-- Middle: Date/Time Fields --}}
            <div class="flex flex-col gap-0.5 text-[9px] pt-2">
                <div class="flex items-center gap-1">
                    <span class="font-bold whitespace-nowrap">DATE:</span>
                    <span class="flex-1 border-b border-black"></span>
                </div>
                <div class="flex items-center gap-1">
                    <span class="font-bold whitespace-nowrap">Arrival:</span>
                    <span class="flex-1 border-b border-black"></span>
                </div>
                <div class="flex items-center gap-1">
                    <span class="font-bold whitespace-nowrap">Interview:</span>
                    <span class="flex-1 border-b border-black"></span>
                </div>
                <div class="flex items-center gap-1">
                    <span class="font-bold whitespace-nowrap">P.E.:</span>
                    <span class="flex-1 border-b border-black"></span>
                </div>
                <div class="flex items-center gap-1">
                    <span class="font-bold whitespace-nowrap">Bleed:</span>
                    <span class="flex-1 border-b border-black"></span>
                </div>
            </div>

            {{-- Right: Serial Number & Barcode Boxes --}}
            <div class="flex flex-col border border-black h-16">
                <div class="flex-1 border-b border-black px-1 pt-0.5">
                    <span class="text-[9px] font-bold">SERIAL NUMBER:</span>
                </div>
                <div class="flex items-center justify-center py-1">
                    <span class="text-[9px] italic text-gray-600">DOH NBBnets BARCODE</span>
                </div>
            </div>

        </div>

        {{-- ===== SECTION I: PERSONAL DATA ===== --}}
        <div class="mt-2">
            <p class="font-bold text-[9px] mb-0.5">I. PERSONAL DATA <span class="italic font-normal">(To be filled up by
                    donor)</span></p>
            <div class="border border-black">

                {{-- Row 1: Name fields --}}
                <div class="grid grid-cols-12 border-b border-black">
                    <div class="col-span-12 h-4"></div>
                </div>
                <div class="grid grid-cols-12 border-b border-black text-[8px] text-center uppercase font-bold">
                    <div class="col-span-4 border-r border-black px-1 py-0.5">{{ $data['surname'] ?? '' }}</div>
                    <div class="col-span-4 border-r border-black px-1 py-0.5">{{ $data['given_name'] ?? '' }}</div>
                    <div class="col-span-3 border-r border-black px-1 py-0.5">{{ $data['middle_name'] ?? '' }}</div>
                    <div class="col-span-1 px-1 py-0.5">{{ $data['suffix'] ?? '' }}</div>
                </div>
                <div class="grid grid-cols-12 border-b border-black text-[7px] text-center uppercase">
                    <div class="col-span-4 border-r border-black px-1 py-0.5">Surname</div>
                    <div class="col-span-4 border-r border-black px-1 py-0.5">Given Name</div>
                    <div class="col-span-3 border-r border-black px-1 py-0.5">Middle Name</div>
                    <div class="col-span-1 px-1 py-0.5">Suffix</div>
                </div>

                {{-- Row 2: Date/Age/Gender/Civil Status/Nationality/Religion/Occupation --}}
                <div class="grid grid-cols-12 border-b border-black text-[8px] text-center font-bold">
                    <div class="col-span-2 border-r border-black px-1 py-0.5">{{ $data['birthdate'] ?? '' }}</div>
                    <div class="col-span-1 border-r border-black px-1 py-0.5">{{ $data['age'] ?? '' }}</div>
                    <div class="col-span-1 border-r border-black px-1 py-0.5">{{ $data['gender'] ?? '' }}</div>
                    <div class="col-span-2 border-r border-black px-1 py-0.5">{{ $data['civil_status'] ?? '' }}</div>
                    <div class="col-span-2 border-r border-black px-1 py-0.5">{{ $data['nationality'] ?? '' }}</div>
                    <div class="col-span-2 border-r border-black px-1 py-0.5">{{ $data['religion'] ?? '' }}</div>
                    <div class="col-span-2 px-1 py-0.5">{{ $data['occupation'] ?? '' }}</div>
                </div>
                <div class="grid grid-cols-12 border-b border-black text-[7px] text-center uppercase">
                    <div class="col-span-2 border-r border-black px-1 py-0.5">Birthdate</div>
                    <div class="col-span-1 border-r border-black px-1 py-0.5">Age</div>
                    <div class="col-span-1 border-r border-black px-1 py-0.5">Gender</div>
                    <div class="col-span-2 border-r border-black px-1 py-0.5">Civil Status</div>
                    <div class="col-span-2 border-r border-black px-1 py-0.5">Nationality</div>
                    <div class="col-span-2 border-r border-black px-1 py-0.5">Religion</div>
                    <div class="col-span-2 px-1 py-0.5">Occupation</div>
                </div>

                {{-- Row 3: Address --}}
                <div class="border-b border-black text-[8px] px-1 py-0.5 font-bold">{{ $data['address'] ?? '' }}</div>
                <div class="border-b border-black text-[7px] text-center uppercase px-1 py-0.5">Address</div>

                {{-- Row 4: Contact/Email/ID --}}
                <div class="grid grid-cols-12 border-b border-black text-[8px] text-center font-bold">
                    <div class="col-span-3 border-r border-black px-1 py-0.5">{{ $data['contact_number'] ?? '' }}</div>
                    <div class="col-span-4 border-r border-black px-1 py-0.5">{{ $data['email'] ?? '' }}</div>
                    <div class="col-span-3 border-r border-black px-1 py-0.5">{{ $data['valid_id_type'] ?? '' }}</div>
                    <div class="col-span-2 px-1 py-0.5">{{ $data['id_no'] ?? '' }}</div>
                </div>
                <div class="grid grid-cols-12 text-[7px] text-center uppercase">
                    <div class="col-span-3 border-r border-black px-1 py-0.5">Contact Number</div>
                    <div class="col-span-4 border-r border-black px-1 py-0.5">Email Address</div>
                    <div class="col-span-3 border-r border-black px-1 py-0.5">Valid ID Type</div>
                    <div class="col-span-2 px-1 py-0.5">ID No.</div>
                </div>

            </div>
        </div>

        {{-- ===== SECTION II: MEDICAL HISTORY ===== --}}
        <div class="mt-2">
            <p class="font-bold text-[9px] mb-0.5">
                II. MEDICAL HISTORY
                <span class="italic font-normal">
                    (Please read carefully and answer all relevant question . Tick [&#10003;] the appropriate answer.)
                </span>
            </p>

            @php
                $questions = [
                    ['num' => 1, 'text' => 'Do you feel well and healthy today?', 'group' => null],
                    [
                        'num' => 2,
                        'text' =>
                            'Have you ever been refused as a blood donor or told not to donate blood for any reasons?',
                        'group' => null,
                    ],
                    [
                        'num' => 3,
                        'text' =>
                            'Are you giving blood only because you want to be tested for HIV or the AIDS virus, or Hepatitis virus?',
                        'group' => null,
                    ],
                    [
                        'num' => 4,
                        'text' =>
                            'Are you aware that an HIV/Hepatitis infected person can still transmit the virus despite a negative HIV/Hepatitis test?',
                        'group' => null,
                    ],
                    [
                        'num' => 5,
                        'text' =>
                            'Have you had taken liquor, beer, or any drinks with alcohol for the last <strong>12 HOURS</strong>?',
                        'group' => null,
                    ],
                    [
                        'num' => 6,
                        'text' => 'Have you taken any medication or vaccination for the past <strong>4 WEEKS</strong>?',
                        'group' => null,
                    ],
                    [
                        'num' => 7,
                        'text' =>
                            'Have you donated whole blood, platelets, or plasma, for the past <strong>12 WEEKS</strong>?',
                        'group' => null,
                    ],
                    [
                        'num' => 8,
                        'text' => 'Been to any places in the Philippines or countries infected with Zika Virus?',
                        'group' => 'IN THE PAST 6 MONTHS, HAVE YOU...',
                    ],
                    [
                        'num' => 9,
                        'text' => 'Had sexual contact with a person who was confirmed infected with Zika Virus?',
                        'group' => null,
                    ],
                    [
                        'num' => 10,
                        'text' =>
                            'Had sexual contact with a person who has been to any places in the Philippines or countries infected with Zika Virus?',
                        'group' => null,
                    ],
                    [
                        'num' => 11,
                        'text' => 'Received blood, blood products and/or had tissue/organ transplant or graft?',
                        'group' => 'IN THE PAST 12 MONTHS HAVE YOU:',
                    ],
                    ['num' => 12, 'text' => 'Had surgical operation or dental extraction?', 'group' => null],
                    [
                        'num' => 13,
                        'text' =>
                            'Had a tattoo applied, ear and body piercing, acupuncture, needle stick injury or accidental contact with blood?',
                        'group' => null,
                    ],
                    [
                        'num' => 14,
                        'text' =>
                            'Had sexual contact with high risks individuals or in exchange for material or monetary gain?',
                        'group' => null,
                    ],
                    ['num' => 15, 'text' => 'Engaged in unprotected, unsafe or casual sex?', 'group' => null],
                    [
                        'num' => 16,
                        'text' => 'Had jaundice/hepatitis/ personal contact with person who had hepatitis?',
                        'group' => null,
                    ],
                    ['num' => 17, 'text' => 'Been incarcerated, jailed or imprisoned?', 'group' => null],
                    [
                        'num' => 18,
                        'text' => 'Spent time or have relatives in the United Kingdom or Europe?',
                        'group' => null,
                    ],
                    [
                        'num' => 19,
                        'text' => 'Travelled or lived outside of your place of residence or outside the Philippines?',
                        'group' => 'HAVE YOU EVER:',
                    ],
                    [
                        'num' => 20,
                        'text' => 'Taken prohibited drugs (orally, by nose, or by injection)?',
                        'group' => null,
                    ],
                    ['num' => 21, 'text' => 'Used clotting factor concentrates?', 'group' => null],
                    [
                        'num' => 22,
                        'text' => 'Had a positive test for the HIV virus, Hepatitis virus, Syphilis or Malaria?',
                        'group' => null,
                    ],
                    ['num' => 23, 'text' => 'Had Malaria or Hepatitis in the past?', 'group' => null],
                    [
                        'num' => 24,
                        'text' =>
                            'Had or was treated for genital wart, syphilis, gonorrhea or other sexually transmitted diseases?',
                        'group' => null,
                    ],
                    [
                        'num' => 25,
                        'text' => 'Cancer, blood disease or bleeding disorder (haemophilia)?',
                        'group' => 'HAD ANY OF THE FOLLOWING:',
                    ],
                    ['num' => 26, 'text' => 'Heart disease/surgery, rheumatic fever or chest pains?', 'group' => null],
                    ['num' => 27, 'text' => 'Lung disease, Tuberculosis or Asthma?', 'group' => null],
                    ['num' => 28, 'text' => 'Kidney disease, Thyroid Disease, Diabetes, Epilepsy?', 'group' => null],
                    ['num' => 29, 'text' => 'Chicken pox and/or Cold Sores?', 'group' => null],
                    [
                        'num' => 30,
                        'text' => 'Any other chronic medical condition or surgical operations?',
                        'group' => null,
                    ],
                    [
                        'num' => 31,
                        'text' =>
                            'Have you recently had rash and/or fever? Were these also associated with arthralgia or arthritis or conjunctivitis?',
                        'group' => null,
                    ],
                    [
                        'num' => 32,
                        'text' => 'Are you currently pregnant or have you ever been pregnant?',
                        'group' => 'FOR FEMALE DONORS ONLY:',
                    ],
                    ['num' => 33, 'text' => 'When was your last childbirth?', 'group' => null],
                    [
                        'num' => 34,
                        'text' => 'In the past <strong>1 YEAR</strong>, did you have a miscarriage or abortion?',
                        'group' => null,
                    ],
                    ['num' => 35, 'text' => 'Are you currently breastfeeding?', 'group' => null],
                    ['num' => 36, 'text' => 'When was your last menstrual period?', 'group' => null, 'date' => true],
                ];
            @endphp

            <div class="text-[9px]">
                <div class="flex gap-4 font-bold mb-0.5 ml-16">
                    <span>YES</span><span>NO</span>
                </div>

                @foreach ($questions as $q)
                    @if ($q['group'])
                        <div class="font-bold ml-16 my-0.5">{{ $q['group'] }}</div>
                    @endif
                    <div class="flex items-start gap-1 mb-0.5">
                        <span class="w-16 flex-shrink-0 flex gap-4 pl-2">
                            <span class="w-3 h-3 border border-black inline-block"></span>
                            <span class="w-3 h-3 border border-black inline-block"></span>
                        </span>
                        <span class="flex-1">
                            {{ $q['num'] }}. {!! $q['text'] !!}
                            @if (!empty($q['date']))
                                &nbsp;&nbsp;<strong>DATE:</strong> <span
                                    class="inline-block w-24 border-b border-black">&nbsp;</span>
                            @endif
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        @pageBreak

        {{-- ===== CUE SECTION ===== --}}
        <div class="mt-3 border-2 border-dashed border-black p-2 text-[8px]">
            <p class="font-bold text-center text-[9px] mb-1">CONFIDENTIAL UNIT OF EXCLUSION (CUE)</p>
            <p class="mb-1">
                Please <strong>MARK</strong> one of the boxes below. If at one point <strong>DURING</strong> or
                <strong>AFTER</strong> donation blood is unsure of your initial answer, please inform our
                Blood Service staff immediately. If you have already left the venue, contact the <strong>TSMC Blood Bank
                    at telephone number (046) 484-7777
                    loc 192</strong> or cellphone number <strong>0908-812-7782</strong>
            </p>
            <p class="font-bold text-center mb-2">MARK ONE BOX ONLY. YOUR RESPONSE WILL BE KEPT CONFIDENTIALLY.</p>
            <div class="flex items-start gap-4">
                <div class="flex flex-col items-start flex-shrink-0">
                    <span class="font-bold">I BELIEVE THAT</span>
                    <span class="font-bold">MY BLOOD IS:</span>
                </div>
                <div class="flex gap-8 flex-1 items-center">
                    <div class="flex flex-col items-center gap-1">
                        <span class="font-bold text-[8px]">SAFE for transfusion</span>
                        <span class="w-10 h-10 border-2 border-black inline-block"></span>
                    </div>
                    <div class="flex flex-col items-center gap-1">
                        <span class="font-bold text-[8px]">NOT SAFE for transfusion</span>
                        <span class="w-10 h-10 border-2 border-black inline-block"></span>
                    </div>
                </div>
                <div class="border border-black p-1 flex-shrink-0 w-40">
                    <div class="border-b border-black pb-1 mb-1">
                        <span class="font-bold">UNIT SERIAL NO.:</span>
                        <span class="block border-b border-black mt-1 h-3"></span>
                    </div>
                    <div>
                        <span class="font-bold">DATE AND PLACE OF COLLECTION:</span>
                        <span class="block border-b border-black mt-1 h-3"></span>
                        <span class="block border-b border-black mt-1 h-3"></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== SECTION III: DONOR'S DECLARATION ===== --}}
        <div class="mt-2 border border-black p-2 text-[8px]">
            <p class="font-bold text-[9px] mb-1">III. DONOR'S DECLARATION</p>

            <p class="mb-1 text-justify">
                I, <span
                    class="font-bold">{{ trim(($data['given_name'] ?? '') . ' ' . ($data['middle_name'] ?? '') . ' ' . ($data['surname'] ?? '')) }}</span>,
                with the age of
                <span class="font-bold">{{ $data['age'] ?? '' }}</span> years old, certify that I am the
                person referred to
                above and that all the entries are read and well understood by me and to the best of my knowledge,
                truthfully answered all the
                questions in this Blood Donor Interview Sheet. I understand that all questions are pertinent for my
                safety and for the benefit of the
                patient who will undergo blood transfusion.
            </p>

            <p class="mb-1 text-justify">
                I am voluntarily giving my blood through Tanza Specialists Medical Center Blood Bank, without
                remuneration, for the use of
                persons in need of this vital fluid without regard to rank, race, color, creed, religion, or political
                persuasion. I also understand that my
                blood will be screened for diesease like Malaria, Syphilis, Hepatitis B, Hepatitis C and HIV. I am aware
                that the screening tests are not
                diagnostic and I may not have a copy of the result. But if any of the screening tests give a reactive
                result, I authorize Tanza Specialists
                Medical Center to inform me utilizing the information I have supplied, subject the results to
                confirmatory tests, offer counselling and to
                dispose of my donated blood in any way it may deem advisable for the safety of the majority of the
                populace.
            </p>

            <p class="mb-2 text-justify">
                I understand that all information hereinto is treated confidential in compliance with the <strong>Data
                    Privacy Act of 2012</strong>.
                I therefore <strong>authorize</strong> the Tanza Specialists Medical Center to utilize the information I
                supplied for purposes of research or studies for the benefit
            </p>

            {{-- For those ages 16 to 17 --}}
            <div class="border-t border-black pt-1 mb-1">
                <p class="font-bold text-[8px] mb-1">FOR THOSE AGES 16 TO 17 YEARS OLD</p>
                <div class="grid grid-cols-2 border border-black mb-2">
                    <div class="border-r border-black h-8"></div>
                    <div class="h-8"></div>
                </div>
            </div>

            {{-- Signature row --}}
            <div class="grid grid-cols-4 gap-2 text-center text-[7px]">
                <div>
                    <div class="border-t border-black mt-4 pt-0.5">Signature of Guardian</div>
                </div>
                <div>
                    <div class="border-t border-black mt-4 pt-0.5">Relationship to Donor</div>
                </div>
                <div>
                    <div class="border-t border-black mt-4 pt-0.5">Donor's Signature</div>
                </div>
                <div>
                    <div class="border-t border-black mt-4 pt-0.5">Donor's Thumbmark</div>
                </div>
            </div>
        </div>

        {{-- ===== SECTION IV: INITIAL SCREENING ===== --}}
        <div class="mt-2 text-[8px]">
            <p class="font-bold text-[9px] mb-1">
                IV. INTIAL SCREENING
                <span class="italic font-normal">(To be filled up by the interviewer)</span>
            </p>

            {{-- Type of Donation --}}
            <div class="flex gap-6 mb-2">
                <span class="font-bold whitespace-nowrap">TYPE OF DONATION:</span>
                <div class="flex gap-8">
                    <div>
                        <p class="font-bold mb-0.5">[] IN-HOUSE:</p>
                        <p class="ml-2">[] WALK-IN/VOLUNTARY</p>
                        <p class="ml-2">[] REPLACEMENT</p>
                        <p class="ml-2">[] PATIENT- DIRECTED</p>
                    </div>
                    <div>
                        <p class="font-bold mb-1">[] Mobile Blood Donation</p>
                        <div class="flex items-center gap-1 mb-0.5">
                            <span class="font-bold whitespace-nowrap">PLACE:</span>
                            <span class="flex-1 border-b border-black w-32">&nbsp;</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="font-bold whitespace-nowrap">ORGANIZER:</span>
                            <span class="flex-1 border-b border-black w-28">&nbsp;</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Patient/Hospital/BloodType row --}}
            <div class="border border-black mb-1">
                <div class="grid grid-cols-12 h-5"></div>
                <div class="grid grid-cols-12 border-t border-black text-[7px] text-center" style="color: #8B0000;">
                    <div class="col-span-4 border-r border-black px-1 py-0.5 font-bold">Patient Name</div>
                    <div class="col-span-3 border-r border-black px-1 py-0.5 font-bold">Hospital</div>
                    <div class="col-span-2 border-r border-black px-1 py-0.5 font-bold">Blood Type</div>
                    <div class="col-span-2 border-r border-black px-1 py-0.5 font-bold">Component</div>
                    <div class="col-span-1 px-1 py-0.5 font-bold">No. of units</div>
                </div>
            </div>

            {{-- History of previous donation --}}
            <div class="mb-1">
                <span class="font-bold">History of previous donation?</span>
                <span class="ml-4">[] <strong>YES</strong></span>
                <span class="ml-8">[] <strong>NO</strong></span>
            </div>
            <div class="mb-0.5 ml-4">
                <span>No. of times:</span>
                <span class="inline-block w-20 border-b border-black ml-1">&nbsp;</span>
            </div>
            <div class="mb-1 ml-4 flex items-center gap-1">
                <span>Date and Place of <strong>Last Donation:</strong></span>
                <span class="flex-1 border-b border-black">&nbsp;</span>
            </div>

            {{-- Interviewer signature --}}
            <div class="flex justify-end mt-4">
                <div class="text-center">
                    <div class="border-t border-black w-40 pt-0.5 text-[7px] font-bold">INTERVIEWER</div>
                </div>
            </div>
        </div>

        {{-- ===== SECTION V: PHYSICAL EXAMINATION ===== --}}
        <div class="mt-2 text-[8px]">
            <p class="font-bold text-[9px] mb-1">
                V. PHYSICAL EXAMINATION
                <span class="italic font-normal">( to be accomplished by Blood Bank Staff and Physician)</span>
            </p>

            <div class="grid grid-cols-3 gap-x-4 gap-y-1 mb-1">
                {{-- Col 1 --}}
                <div class="flex flex-col gap-1">
                    <div class="flex items-center gap-1">
                        <span class="whitespace-nowrap">Weight (kg):</span>
                        <span class="flex-1 border-b border-black">&nbsp;</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="whitespace-nowrap">Hemoglobin:</span>
                        <span class="flex-1 border-b border-black" style="background:#ffeeee">&nbsp;</span>
                    </div>
                </div>
                {{-- Col 2 --}}
                <div class="flex flex-col gap-1">
                    <div class="flex items-center gap-1">
                        <span class="whitespace-nowrap">Pulse rate:</span>
                        <span class="flex-1 border-b border-black">&nbsp;</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="whitespace-nowrap">Blood Pressure :</span>
                        <span class="flex-1 border-b border-black" style="background:#ffeeee">&nbsp;</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="whitespace-nowrap">Body temp. :</span>
                        <span class="flex-1 border-b border-black">&nbsp;</span>
                    </div>
                </div>
                {{-- Col 3 --}}
                <div class="flex flex-col gap-1">
                    <div class="flex items-center gap-1">
                        <span class="whitespace-nowrap">Gen. Appearance:</span>
                        <span class="flex-1 border-b border-black">&nbsp;</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="whitespace-nowrap">Heart and Lungs:</span>
                        <span class="flex-1 border-b border-black">&nbsp;</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="whitespace-nowrap">Skin and Extremities:</span>
                        <span class="flex-1 border-b border-black">&nbsp;</span>
                    </div>
                    <div class="flex items-center gap-1 justify-end">
                        <span class="whitespace-nowrap">HEENT:</span>
                        <span class="border-b border-black w-24">&nbsp;</span>
                    </div>
                </div>
            </div>

            {{-- Remarks --}}
            <div class="flex items-center gap-3 mb-1 flex-wrap">
                <span class="font-bold">REMARKS:</span>
                <span>[] Accepted</span>
                <span>[] Temporarily Deferred</span>
                <span>[] Permanently Deferred</span>
                <span>[] Refused</span>
            </div>
            <div class="flex items-center gap-1 mb-3 ml-2">
                <span class="italic">Reason for Deferral:</span>
                <span class="flex-1 border-b border-black">&nbsp;</span>
            </div>

            {{-- Staff / Physician signatures --}}
            <div class="flex justify-between mt-4">
                <div class="text-center">
                    <div class="border-t border-black w-40 pt-0.5 text-[7px] italic font-bold" style="color:#8B0000">
                        BLOOD BANK STAFF</div>
                </div>
                <div class="text-center">
                    <div class="border-t border-black w-40 pt-0.5 text-[7px] italic font-bold" style="color:#8B0000">
                        BLOOD BANK PHYSICIAN</div>
                </div>
            </div>
        </div>

        {{-- ===== SECTION VI: BLOOD COLLECTION ===== --}}
        <div class="mt-2 text-[8px]">
            <p class="font-bold text-[9px] mb-1">
                VI. BLOOD COLLECTION
                <span class="italic font-normal">(to be accomplished by phlebotomist)</span>
            </p>

            <div class="flex gap-6">
                <div class="flex-1 flex flex-col gap-1">
                    <div class="flex items-center gap-1">
                        <span class="whitespace-nowrap">Blood bag used:</span>
                        <span class="flex-1 border-b border-black">&nbsp;</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-1">
                            <span class="whitespace-nowrap">Amount of blood taken:</span>
                            <span class="border-b border-black w-16" style="background:#ffeeee">&nbsp;</span>
                        </div>
                        <span>Succesful:</span>
                        <span class="font-bold">[] YES</span>
                        <span class="font-bold">[] NO</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="whitespace-nowrap">Donor Reaction:</span>
                        <span class="border-b border-black w-24" style="background:#ffeeee">&nbsp;</span>
                        <span class="ml-2 whitespace-nowrap">Start time:</span>
                        <span class="border-b border-black w-20">&nbsp;</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="whitespace-nowrap">Management done:</span>
                        <span class="border-b border-black w-20" style="background:#ffeeee">&nbsp;</span>
                        <span class="ml-2 whitespace-nowrap">End time:</span>
                        <span class="border-b border-black w-20">&nbsp;</span>
                    </div>
                </div>

                {{-- Unit Serial Number box --}}
                <div class="border border-black flex items-center justify-center w-40 flex-shrink-0">
                    <span class="font-bold italic text-[8px] text-center px-2">UNIT SERIAL NUMBER</span>
                </div>
            </div>

            {{-- Phlebotomist signature --}}
            <div class="mt-4">
                <div class="border-t border-black w-40 pt-0.5 text-[7px] italic font-bold" style="color:#8B0000">
                    PHLEBOTOMIST</div>
            </div>
        </div>

        {{-- ===== SECTION VII: SEROLOGY ===== --}}
        <div class="mt-2 text-[8px]">
            <p class="font-bold text-[9px] mb-1">
                VII. SEROLOGY
                <span class="italic font-normal">(to accomplished by Medical Technologists)</span>
            </p>

            <div class="border border-black">
                <div class="grid grid-cols-5 border-b border-black h-6"></div>
                <div class="grid grid-cols-5 text-[7px] text-center" style="color:#8B0000">
                    <div class="border-r border-black px-1 py-0.5 font-bold">HBsAg</div>
                    <div class="border-r border-black px-1 py-0.5 font-bold">HCV</div>
                    <div class="border-r border-black px-1 py-0.5 font-bold">HIV</div>
                    <div class="border-r border-black px-1 py-0.5 font-bold">Syphilis</div>
                    <div class="px-1 py-0.5 font-bold">Malaria</div>
                </div>
            </div>

            {{-- Medical Technologist signature --}}
            <div class="flex justify-end mt-4">
                <div class="text-center">
                    <div class="border-t border-black w-56 pt-0.5 text-[7px] italic font-bold">Signature and Printed
                        Name of Medical Technologist</div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>

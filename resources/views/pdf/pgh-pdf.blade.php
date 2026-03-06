<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="bg-white text-black font-sans text-[10px]">

    <div class="max-w-4xl mx-auto px-2 py-1">

        {{-- ===== HEADER ===== --}}
        <div class="flex items-stretch gap-1 border-b border-black pb-1 mb-0">

            {{-- Left: Form number + Logos + Department Info together --}}
            <div class="flex flex-col shrink-0">
                <div class="leading-tight mb-1">
                    <p class="font-bold text-[9px]">PGH Form No. P-360037</p>
                    <p class="text-[8px]">Rev. 03, Eff. Date 28 April 2025</p>
                </div>
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/UP.png') }}" alt="UP Seal" class="h-14 w-auto object-contain" />
                    <img src="{{ asset('images/pgh.png') }}" alt="PGH Logo" class="h-14 w-auto object-contain" />
                    <div class="flex flex-col justify-center leading-snug">
                        <p class="font-bold text-[10px] uppercase tracking-tight">
                            Department of Laboratories &ndash; Division of Blood Bank
                        </p>
                        <p class="font-extrabold text-[17px] underline uppercase leading-tight tracking-wide">
                            UP &ndash; Philippine General Hospital
                        </p>
                        <p class="text-[9px]">
                            2<sup>nd</sup> Floor, Central Block Building, UP-PGH, Taft Avenue, Manila 1000
                        </p>
                        <p class="text-[9px]">
                            Tel. (632) 85548400 Local 3214/3017 | Email: bloodbank.uppgh@up.edu.ph
                        </p>
                    </div>
                </div>
            </div>

            {{-- Spacer --}}
            <div class="flex-1"></div>

            {{-- Right: Date Fields --}}
            <div class="shrink-0 text-[9px] leading-snug pl-2">
                <p class="font-bold text-[10px] mb-[2px]">Date</p>
                @foreach (['Arrival', 'Interview', 'P.E.', 'Extraction', 'Bleed', 'Serology'] as $field)
                    <div class="flex items-center gap-1 mb-[1px]">
                        <span class="w-16 text-right">{{ $field }}</span>
                        <span class="inline-block border-b border-black w-24">&nbsp;</span>
                    </div>
                @endforeach
                <p class="text-[7.5px] italic mt-[2px] text-right w-40">( Indicate time and MTOD initials )</p>
            </div>

        </div>

        {{-- ===== STAFF / BLOOD TYPE SECTION ===== --}}
        <div class="flex items-start gap-4 border-b border-black py-[5px]">

            {{-- Left: Blood Bank staff only --}}
            <div class="flex-1 text-[9px] leading-snug">
                <p class="italic text-blue-700">(This section is for Blood Bank staff only)</p>
                <div class="mt-1">
                    <span>Tube no.</span>
                    <span class="inline-block border-b border-black w-28 ml-1">&nbsp;</span>
                </div>
                <div class="mt-2">
                    <span>ID type</span>
                    <span class="inline-block border-b border-black w-28 ml-1">&nbsp;</span>
                </div>
            </div>

            {{-- Right: Blood Type / Grading --}}
            <div class="flex-1 text-[9px] leading-snug space-y-1">
                <div class="flex items-center gap-2">
                    <span>Blood Type:</span>
                    <span class="inline-block border-b border-black w-28">&nbsp;</span>
                    <span class="ml-2">Rh:</span>
                    <span class="inline-block border-b border-black w-16">&nbsp;</span>
                </div>
                <div class="flex items-center gap-2">
                    <span>US Grading<sup>p</sup> / MTOD:</span>
                    <span class="inline-block border-b border-black w-28">&nbsp;</span>
                </div>
                <div class="flex items-center gap-2">
                    <span>DS Grading / MTOD:</span>
                    <span class="inline-block border-b border-black w-28">&nbsp;</span>
                </div>
            </div>

        </div>

        @php
            $p = $data['personal'] ?? [];
            $surname = $p['surname'] ?? '';
            $firstName = $p['first_name'] ?? '';
            $middleName = $p['middle_name'] ?? '';
            $age = $p['age'] ?? '';
            $gender = $p['gender'] ?? '';
            $birthdate = !empty($p['birthdate']) ? \Carbon\Carbon::parse($p['birthdate'])->format('m/d/Y') : '';
            $birthplace = $p['birthplace'] ?? '';
            $civilStatus = $p['civil_status'] ?? '';
            $nationality = $p['nationality'] ?? '';
            $houseNo = $p['house_no'] ?? '';
            $street = $p['street'] ?? '';
            $subdivision = $p['subdivision'] ?? '';
            $barangay = $p['barangay'] ?? '';
            $city = $p['city'] ?? '';
            $province = $p['province'] ?? '';
            $zipCode = $p['zip_code'] ?? '';
            $telephone = $p['telephone'] ?? '';
            $occupation = $p['occupation'] ?? '';
            $donationCount = $p['donation_count'] ?? '';
            $lastDonationDetails = $p['last_donation_details'] ?? '';
            $patientName = $p['patient_name'] ?? '';
            $caseNo = $p['case_no'] ?? '';
            $deptWard = $p['dept_ward'] ?? '';
            $relationship = $p['relationship'] ?? '';
        @endphp

        {{-- ===== BLOOD DONOR FORM ===== --}}
        <div class="mt-2 text-[10px]">

            {{-- Italic notice --}}
            <p class="italic text-[9px] mb-1">(For Donors, please accomplish this portion)</p>

            {{-- Title --}}
            <div class="text-center mb-2">
                <p class="font-extrabold text-[14px] uppercase tracking-wide">Blood Donor Form</p>
                <p class="font-bold text-[11px]">(English)</p>
            </div>

            {{-- Category --}}
            <div class="flex items-center gap-6 mb-2 justify-center">
                <span class="font-semibold">Category:</span>
                <label class="flex items-center gap-1">
                    <span class="inline-block w-3 h-3 border border-black">&nbsp;</span>
                    <span>Pre-deposit</span>
                </label>
                <label class="flex items-center gap-1">
                    <span class="inline-block w-3 h-3 border border-black">&nbsp;</span>
                    <span>Walk-in Donor</span>
                </label>
                <label class="flex items-center gap-1">
                    <span class="inline-block w-3 h-3 border border-black">&nbsp;</span>
                    <span>Mobile blood drive</span>
                </label>
            </div>

            {{-- Name row --}}
            <div class="flex items-end gap-2 border-b border-black pb-[1px] mb-1">
                <span class="shrink-0">Surname:</span>
                <span class="flex-1 border-b border-black pb-[1px]">{{ $surname }}</span>
                <span class="shrink-0 ml-2">First name:</span>
                <span class="flex-1 border-b border-black pb-[1px]">{{ $firstName }}</span>
                <span class="shrink-0 ml-2">Middle name:</span>
                <span class="flex-1 border-b border-black pb-[1px]">{{ $middleName }}</span>
            </div>

            {{-- Age / Sex / Birthdate / Civil Status / Nationality --}}
            <div class="flex items-end gap-2 mb-1">
                <span class="shrink-0">Age/Sex:</span>
                <span class="border-b border-black w-8 text-center">{{ $age }}</span>
                <span>/</span>
                <span class="border-b border-black w-10 text-center">{{ $gender }}</span>
                <span class="shrink-0 ml-2">Date and Place of Birth:</span>
                <div class="flex flex-col items-center">
                    <span class="border-b border-black w-28 text-center">{{ $birthdate }}</span>
                    <span class="text-[7.5px] italic">Date (mm/dd/yyyy)</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="border-b border-black w-28 text-center">{{ $birthplace }}</span>
                    <span class="text-[7.5px] italic">Place</span>
                </div>
                <span class="shrink-0 ml-2">Civil Status:</span>
                <span class="border-b border-black w-16 text-center">{{ $civilStatus }}</span>
                <span class="shrink-0 ml-2">Nationality:</span>
                <span class="border-b border-black w-16 text-center">{{ $nationality }}</span>
            </div>

            {{-- Complete Permanent Address --}}
            <div class="mb-1">
                <div class="flex items-end gap-2">
                    <span class="shrink-0 font-semibold">Complete Permanent Address:</span>
                    <div class="flex flex-col items-center flex-1">
                        <span class="border-b border-black w-full text-center">{{ $houseNo }}</span>
                        <span class="text-[7.5px] italic">House No.</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <span class="border-b border-black w-full text-center">{{ $street }}</span>
                        <span class="text-[7.5px] italic">Lot &amp; Block no. / Street</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <span class="border-b border-black w-full text-center">{{ $subdivision }}</span>
                        <span class="text-[7.5px] italic">Subdivision/Townhouse</span>
                    </div>
                </div>
                <div class="flex items-end gap-2 mt-2">
                    <div class="flex flex-col items-center flex-1">
                        <span class="border-b border-black w-full text-center">{{ $barangay }}</span>
                        <span class="text-[7.5px] italic">Barangay / Sitio</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <span class="border-b border-black w-full text-center">{{ $city }}</span>
                        <span class="text-[7.5px] italic">City / Municipality</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <span class="border-b border-black w-full text-center">{{ $province }}</span>
                        <span class="text-[7.5px] italic">Province</span>
                    </div>
                    <div class="flex flex-col items-center w-20">
                        <span class="border-b border-black w-full text-center">{{ $zipCode }}</span>
                        <span class="text-[7.5px] italic">ZIP Code</span>
                    </div>
                </div>
            </div>

            {{-- Tel / Occupation --}}
            <div class="flex items-end gap-2 mb-2">
                <span class="shrink-0">Tel./Cel. #:</span>
                <span class="border-b border-black flex-1">{{ $telephone }}</span>
                <span class="shrink-0 ml-4">Occupation:</span>
                <span class="border-b border-black flex-1">{{ $occupation }}</span>
            </div>

            {{-- Donation history --}}
            <div class="flex items-end gap-2 mb-1">
                <span class="shrink-0">How many times have you donated blood?</span>
                <span class="border-b border-black w-20 text-center">{{ $donationCount }}</span>
                <span class="shrink-0 ml-4">Date &amp; Place of last donation:</span>
                <span class="border-b border-black flex-1">{{ $lastDonationDetails }}</span>
            </div>

            {{-- Patient info --}}
            <div class="flex items-end gap-2 mb-1">
                <span class="shrink-0">Name of Patient:</span>
                <span class="border-b border-black flex-1">{{ $patientName }}</span>
                <span class="shrink-0 ml-4">Case #:</span>
                <span class="border-b border-black w-28">{{ $caseNo }}</span>
                <span class="shrink-0 ml-4">Dept./Ward:</span>
                <span class="border-b border-black flex-1">{{ $deptWard }}</span>
            </div>

            {{-- Relationship --}}
            <div class="flex items-end gap-2 mb-1">
                <span class="shrink-0">Relationship to the patient:</span>
                <span class="border-b border-black flex-1">{{ $relationship }}</span>
            </div>

        </div>

        {{-- ===== QUESTIONNAIRE ===== --}}
        <div class="mt-3 text-[10px]">

            <p class="mb-1">Instructions: Place a check (&#10003;):</p>

            {{-- Column headers --}}
            <div class="flex gap-2 mb-1">
                <span class="w-8 font-bold text-center">YES</span>
                <span class="w-8 font-bold text-center">NO</span>
                <span class="font-bold">Are you&hellip;</span>
            </div>

            @php
                $circle = '<span class="inline-block w-4 h-4 rounded-full border border-black">&nbsp;</span>';
            @endphp

            {{-- Q1–5 --}}
            @foreach ([[1, 'Feeling healthy today?<br>Have you ever had any significant illnesses, or diseases from the attached list? *'], [2, 'Currently taking medication?<br>Have you taken any medication or substance(s) from the deferral list? *'], [3, 'Have you received any vaccination?'], [4, 'Have you taken aspirin or anything that has aspirin on it?'], [5, 'For females: In the past 9 months, have you been pregnant or had given birth?<br>Or have you breastfed for the past 3 months, or are currently breast feeding?']] as [$num, $question])
                <div class="flex gap-2 mb-[3px] items-start">
                    <span class="w-8 flex justify-center pt-[1px]">{!! $circle !!}</span>
                    <span class="w-8 flex justify-center pt-[1px]">{!! $circle !!}</span>
                    <span class="flex-1"><span class="font-semibold">{{ $num }}.</span>
                        {!! $question !!}</span>
                </div>
            @endforeach

            {{-- Q5 LMP line --}}
            <div class="flex gap-2 items-center mb-2 ml-16">
                <span>Last Menstrual Period:</span>
                <span class="border-b border-black flex-1">&nbsp;</span>
            </div>

            {{-- In the past 12 weeks --}}
            <div class="mb-[3px]">
                <p class="font-bold">In the past 12 weeks have you&hellip;</p>
            </div>
            <div class="flex gap-2 mb-2 items-start">
                <span class="w-8 flex justify-center pt-[1px]">{!! $circle !!}</span>
                <span class="w-8 flex justify-center pt-[1px]">{!! $circle !!}</span>
                <span class="flex-1"><span class="font-semibold">6.</span> Donated blood, platelet or plasma?</span>
            </div>

            {{-- In the past 12 months --}}
            <div class="mb-[3px]">
                <p class="font-bold">In the past 12 months have you&hellip;</p>
            </div>
            @foreach ([[7, 'Had a blood transfusion?'], [8, 'Had surgical operation, dental extraction, or any major medical procedure? *'], [9, 'Had a tattoo, ear or body piercing, accidental contact with blood, needlestick injury, and acupuncture?'], [10, 'Had sexual contact with high-risk individuals? *'], [11, 'Had sexual contact with anyone in exchange for material or monetary gain?'], [12, 'Had sexual contact with a person who has worked abroad?'], [13, 'Engaged in casual sex?'], [14, 'Lived with a person who has hepatitis?'], [15, 'Have you been imprisoned?'], [16, 'Have any of your relatives had Creutzfeldt-Jacob (Mad Cow) disease?']] as [$num, $question])
                <div class="flex gap-2 mb-[3px] items-start">
                    <span class="w-8 flex justify-center pt-[1px]">{!! $circle !!}</span>
                    <span class="w-8 flex justify-center pt-[1px]">{!! $circle !!}</span>
                    <span class="flex-1"><span class="font-semibold">{{ $num }}.</span>
                        {{ $question }}</span>
                </div>
            @endforeach

            {{-- Have you ever --}}
            <div class="mb-[3px] mt-1">
                <p class="font-bold">Have you ever&hellip;</p>
            </div>
            @foreach ([[17, 'Lived outside your place of residence, or had any history of travel?'], [18, 'Lived or traveled outside the Philippines?']] as [$num, $question])
                <div class="flex gap-2 mb-[3px] items-start">
                    <span class="w-8 flex justify-center pt-[1px]">{!! $circle !!}</span>
                    <span class="w-8 flex justify-center pt-[1px]">{!! $circle !!}</span>
                    <span class="flex-1"><span class="font-semibold">{{ $num }}.</span>
                        {{ $question }}</span>
                </div>
            @endforeach

            {{-- Q19–29 (continued Have you ever) --}}
            @foreach ([[19, 'Used needles to take drugs, steroids or anything not prescribed by your doctor?'], [20, 'Used clotting factor concentrates?'], [21, 'Had a positive test for the HIV virus, Hepatitis virus, Syphilis or Malaria?'], [22, 'Had Hepatitis?'], [23, 'Had Malaria?'], [24, 'Been told to have or treated for genital wart, syphilis, gonorrhea, or other Sexually transmissible Infections?'], [25, 'Had any type of cancer, for example Leukemia?'], [26, 'Had any problems with your heart and lungs?'], [27, 'Had a bleeding condition or a blood disease?'], [28, 'Are you giving blood because you wanted to be tested for HIV or Hepatitis virus?'], [29, 'Are you aware that if you have the HIV/Hepatitis virus, you can give it to someone else though you may feel well and have a negative HIV/Hepatitis test?']] as [$num, $question])
                <div class="flex gap-2 mb-[3px] items-start">
                    <span class="w-8 flex justify-center pt-[1px]">{!! $circle !!}</span>
                    <span class="w-8 flex justify-center pt-[1px]">{!! $circle !!}</span>
                    <span class="flex-1"><span class="font-semibold">{{ $num }}.</span>
                        {{ $question }}</span>
                </div>
            @endforeach

            {{-- Asterisk note --}}
            <p class="italic text-[9px] mt-2 mb-3">
                <em>Note: Questions with an asterisk (*) will be further explained by the interviewer.</em>
            </p>

            {{-- DONOR'S INFORMED CONSENT --}}
            <div class="mb-3">
                <p class="font-bold text-[11px] mb-1">DONOR'S INFORMED CONSENT</p>

                <p class="mb-2 leading-snug">
                    &ldquo;I,
                    <span class="inline-block border-b border-black w-40 align-bottom">&nbsp;</span>
                    , certify that I am the person referred to in all the entries, which were read and well understood
                    by me. It is my free and voluntary act to donate my blood, aware of its risks during and after
                    extraction. The same have been explained to me in understandable language and dialect that I
                    speak.&rdquo;
                </p>

                <p class="text-blue-700 mb-2 leading-snug">
                    I am voluntarily giving my blood through the Philippine General Hospital Blood Bank. I understand
                    that my blood will be tested for Blood Type, Hemoglobin, Malaria, Syphilis, Hepatitis B, Hepatitis C
                    and HIV and no official result will be released to me. If the result is reactive, I agree to be
                    referred to the appropriate facility for counseling and further management.
                </p>

                <p class="font-bold mb-1">For platelet donation only (Platelet Pheresis):</p>
                <p class="text-blue-700 mb-3 leading-snug">
                    I understand that donating platelets involves undergoing the apheresis process, where my blood will
                    be filtered through a machine that separates only the platelets. I acknowledge that I am aware of
                    the potential risks associated with both the collection process and the period following the
                    procedure.
                </p>

                <p class="font-bold text-center mb-4 leading-snug">
                    &ldquo;I certify that I have to the best of my knowledge, truthfully answered the above
                    questions.&rdquo;
                </p>

                {{-- Signature line --}}
                <div class="flex justify-between mt-6">
                    <div class="flex flex-col items-start w-64">
                        <span class="border-t border-black w-full pt-[2px] text-[9px]">Signature over printed name of
                            Donor</span>
                    </div>
                    <div class="flex flex-col items-start w-64">
                        <span class="border-t border-black w-full pt-[2px] text-[9px]">Signature of Interviewer</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- ===== PHYSICAL EXAMINATION ===== --}}
        <div class="mt-4 border-t border-black pt-2 text-[10px]">

            <p class="italic text-[9px] text-blue-700 mb-1">(This section is for Blood Bank staff only)</p>

            <p class="font-bold">PHYSICAL EXAMINATION:</p>
            <p class="italic text-[9px] mb-2">(NOTE: Please indicate time of P.E. in front of the form)</p>

            {{-- Weight / Blood Pressure / Temp / HR --}}
            <div class="flex items-end gap-4 mb-1">
                <span class="shrink-0">Weight:</span>
                <span class="border-b border-black w-32">&nbsp;</span>
                <span class="shrink-0">kg.</span>
                <span class="shrink-0 ml-2">Blood Pressure:</span>
                <span class="border-b border-black w-28">&nbsp;</span>
                <span class="flex-1"></span>
                <span class="shrink-0">Temp:</span>
                <span class="border-b border-black w-20">&nbsp;</span>
                <span class="shrink-0 ml-2">HR:</span>
                <span class="border-b border-black w-20">&nbsp;</span>
            </div>

            {{-- General Appearance / Skin --}}
            <div class="flex items-end gap-4 mb-1">
                <span class="shrink-0">General Appearance:</span>
                <span class="border-b border-black w-48">&nbsp;</span>
                <span class="flex-1"></span>
                <span class="shrink-0">Skin/Extremities:</span>
                <span class="border-b border-black flex-1">&nbsp;</span>
            </div>

            {{-- HEENT / Heart and Lungs --}}
            <div class="flex items-end gap-4 mb-2">
                <span class="shrink-0">HEENT:</span>
                <span class="border-b border-black w-64">&nbsp;</span>
                <span class="flex-1"></span>
                <span class="shrink-0">Heart and Lungs:</span>
                <span class="border-b border-black flex-1">&nbsp;</span>
            </div>

            {{-- Remarks / Acceptance status --}}
            <div class="flex items-center gap-6 mb-1">
                <span class="shrink-0">Remarks:</span>
                <label class="flex items-center gap-1">
                    <span class="inline-block w-3 h-3 border border-black">&nbsp;</span>
                    <span>Accepted</span>
                </label>
                <label class="flex items-center gap-1">
                    <span class="inline-block w-3 h-3 border border-black">&nbsp;</span>
                    <span>Temporarily Deferred</span>
                </label>
                <label class="flex items-center gap-1">
                    <span class="inline-block w-3 h-3 border border-black">&nbsp;</span>
                    <span>Permanently Deferred</span>
                </label>
            </div>

            {{-- Reason for Deferral --}}
            <div class="flex items-end gap-2 mb-4">
                <span class="shrink-0">Reason/s for Deferral:</span>
                <span class="border-b border-black flex-1">&nbsp;</span>
            </div>

            {{-- Medical Officer Signature --}}
            <div class="flex justify-end mb-4">
                <div class="w-72">
                    <span class="border-t border-black w-full block pt-[2px] text-[9px] text-right">Signature over
                        Printed Name of Medical Officer</span>
                </div>
            </div>

        </div>

        {{-- ===== LABORATORY EXAMS ===== --}}
        <div class="border-t-2 border-black pt-2 text-[10px]">

            <p class="font-extrabold underline mb-2">LABORATORY EXAMS FOR PROCESSING OF BLOOD DONORS:</p>

            {{-- Row 1: Hemoglobin / HBsAg / TPA / Malaria --}}
            <div class="flex items-end gap-4 mb-1">
                <span class="shrink-0">Hemoglobin:</span>
                <span class="border-b border-black w-28">&nbsp;</span>
                <span class="shrink-0 ml-4">HBsAg:</span>
                <span class="border-b border-black w-28">&nbsp;</span>
                <span class="shrink-0 ml-4">TPA:</span>
                <span class="border-b border-black w-28">&nbsp;</span>
                <span class="shrink-0 ml-4">Malaria:</span>
                <span class="border-b border-black w-28">&nbsp;</span>
            </div>

            {{-- Row 2: Hct / HCV / HIV --}}
            <div class="flex items-end gap-4 mb-6">
                <span class="shrink-0">Hct:</span>
                <span class="border-b border-black w-28">&nbsp;</span>
                <span class="shrink-0 ml-4">HCV:</span>
                <span class="border-b border-black w-28">&nbsp;</span>
                <span class="shrink-0 ml-4">HIV:</span>
                <span class="border-b border-black w-28">&nbsp;</span>
            </div>

            {{-- Med Tech Signature --}}
            <div class="flex justify-end">
                <div class="w-72">
                    <span class="border-t border-black w-full block pt-[2px] text-[9px] text-right">Signature over
                        Printed Name of Med. Tech. on Duty</span>
                </div>
            </div>

        </div>

    </div>

</body>

</html>

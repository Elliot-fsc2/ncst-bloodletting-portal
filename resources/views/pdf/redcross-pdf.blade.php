<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>


</head>

<body>

    <div class="max-w-5xl mx-auto bg-white font-sans relative">

        <div class="absolute left-0 top-0 text-xs leading-snug">
            {{-- <p class="font-semibold">Queue No: {{ $queue_number ?? '' }} | NCST Blood Donation</p> --}}
            <p>NCST, {{ ($preferred_date ?? null) ? \Carbon\Carbon::parse($preferred_date)->format('F j, Y') : '' }}, 8:00 AM</p>
        </div>

        <div class="flex flex-col items-center justify-center">
            <div class="flex items-center space-x-6">
                <img src="{{ asset('images/red-cross.png') }}" alt="Philippine Red Cross"
                    class="w-10 h-10 object-contain bg-gray-100 rounded-full" />

                <img src="{{ asset('images/doh.png') }}" alt="Department of Health"
                    class="w-10 h-10 object-contain bg-green-50 rounded-full" />
            </div>

            <h1 class="font-bold underline tracking-wide">
                BLOOD DONOR INTERVIEW SHEET
            </h1>
        </div>

        <div class="absolute right-8 top-0 flex flex-col items-end">
            <table class="text-[#000080] font-bold text-sm leading-tight tracking-wide mb-1 mr-4">
                <tbody>
                    <tr>
                        <td class="pr-4 text-left">HS</td>
                        <td class="text-center">-</td>
                    </tr>
                    <tr>
                        <td class="pr-4 text-left">LM</td>
                        <td class="text-center">-</td>
                    </tr>
                    <tr>
                        <td class="pr-4 text-left">CCF</td>
                        <td class="text-center">-</td>
                    </tr>
                    <tr>
                        <td class="pr-4 text-left">OW</td>
                        <td class="text-center">-</td>
                    </tr>
                    <tr>
                        <td class="pr-4 text-left">A</td>
                        <td class="text-center">-</td>
                    </tr>
                    <tr>
                        <td class="pr-4 text-left">MED</td>
                        <td class="text-center">-</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <div>
        <b>I. Pernsonal Data</b>(to be filled up by the donor).
    </div>
    <div class="max-w-5xl mx-auto p-2 bg-white text-black font-sans">

        <div class="flex items-start mb-2">
            <div class="w-48 flex-shrink-0 uppercase text-sm font-medium pt-1">
                NAME:
            </div>
            <div class="flex-1">
                <div class="grid grid-cols-3 border border-black">
                    <div class="border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['surname'] ?? '' }}</div>
                    <div class="border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['first_name'] ?? '' }}</div>
                    <div class="h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['middle_name'] ?? '' }}
                    </div>
                </div>
                <div class="grid grid-cols-3 text-xs text-center mt-1 leading-none">
                    <label class="font-serif italic">Surname</label>
                    <label class="font-serif italic">First Name</label>
                    <label class="font-serif italic">Middle Name</label>
                </div>
            </div>
        </div>

        <div class="flex items-start mb-2">
            <div class="w-48 flex-shrink-0"></div>
            <div class="flex-1">
                <div class="grid grid-cols-12 border border-black">
                    <div
                        class="col-span-4 border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['birthdate'] ?? '' }}
                    </div>
                    <div
                        class="col-span-2 border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['age'] ?? '' }}
                    </div>
                    <div
                        class="col-span-4 border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['civil_status'] ?? '' }}
                    </div>
                    <div class="col-span-2 h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['sex'] ?? '' }}</div>
                </div>
                <div class="grid grid-cols-12 text-[10px] text-center mt-1 uppercase leading-none">
                    <label class="col-span-4">Birthdate</label>
                    <label class="col-span-2">Age</label>
                    <label class="col-span-4">Civil Status</label>
                    <label class="col-span-2">Sex</label>
                </div>
            </div>
        </div>

        <div class="flex items-start mb-2">
            <div class="w-48 flex-shrink-0 uppercase text-sm font-medium pt-1">
                PERMANENT ADDRESS:
            </div>
            <div class="flex-1">
                <div class="grid grid-cols-12 border border-black">
                    <div
                        class="col-span-1 border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                    </div>
                    <div
                        class="col-span-3 border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['address_street'] ?? '' }}</div>
                    <div
                        class="col-span-2 border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['address_barangay'] ?? '' }}</div>
                    <div
                        class="col-span-2 border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['address_town'] ?? '' }}</div>
                    <div
                        class="col-span-2 border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['address_province'] ?? '' }}</div>
                    <div class="col-span-2 h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['address_zip'] ?? '' }}</div>
                </div>
                <div class="grid grid-cols-12 text-[10px] text-center mt-1 leading-none">
                    <label class="col-span-1">No.</label>
                    <label class="col-span-3">Street</label>
                    <label class="col-span-2">Barangay</label>
                    <label class="col-span-2">Town/Municipality</label>
                    <label class="col-span-2">Province/City</label>
                    <label class="col-span-2">Zip Code</label>
                </div>
            </div>
        </div>

        <div class="flex items-start mb-2">
            <div class="w-48 flex-shrink-0 uppercase text-sm font-medium pt-1">
                OFFICE ADDRESS
            </div>
            <div class="flex-1">
                <div class="w-full border border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                </div>
            </div>
        </div>

        <div class="flex items-start mb-2">
            <div class="w-48 flex-shrink-0"></div>
            <div class="flex-1">
                <div class="grid grid-cols-4 border border-black">
                    <div class="border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['nationality'] ?? '' }}</div>
                    <div class="border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['religion'] ?? '' }}</div>
                    <div class="border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['education'] ?? '' }}</div>
                    <div class="h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['occupation'] ?? '' }}
                    </div>
                </div>
                <div class="grid grid-cols-4 text-[10px] text-center mt-1 uppercase leading-none">
                    <label>Nationality</label>
                    <label>Religion</label>
                    <label>Education</label>
                    <label>Occupation</label>
                </div>
            </div>
        </div>

        <div class="flex items-start mb-2">
            <div class="w-48 flex-shrink-0 uppercase text-sm font-medium pt-1">
                CONTACT No.:
            </div>
            <div class="flex-1">
                <div class="grid grid-cols-3 border border-black">
                    <div class="border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['telephone_no'] ?? '' }}</div>
                    <div class="border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['mobile_no'] ?? '' }}</div>
                    <div class="h-6 px-1 flex items-center justify-center text-center text-sm">
                        {{ $data['email'] ?? '' }}</div>
                </div>
                <div class="grid grid-cols-3 text-[10px] text-center mt-1 uppercase leading-none">
                    <label>Telephone No.</label>
                    <label>Mobile No.</label>
                    <label>E-Mail Address</label>
                </div>
            </div>
        </div>

        <div class="flex items-start mb-2">
            <div class="w-48 flex-shrink-0 uppercase text-sm font-medium pt-1">
                IDENTIFICATION No.:
            </div>
            <div class="flex-1">
                <div class="grid grid-cols-6 border border-black">
                    <div class="border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                    </div>
                    <div class="border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                    </div>
                    <div class="border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                    </div>
                    <div class="border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                    </div>
                    <div class="border-r border-black h-6 px-1 flex items-center justify-center text-center text-sm">
                    </div>
                    <div class="h-6 px-1 flex items-center justify-center text-center text-sm"></div>
                </div>
                <div class="grid grid-cols-6 text-[10px] text-center mt-1 leading-none">
                    <label>School</label>
                    <label>Company</label>
                    <label>PRC</label>
                    <label>Driver's</label>
                    <label>SSS/GSIS/BIR</label>
                    <label>Others</label>
                </div>
            </div>
        </div>

    </div>

    <div>
        <b>II. Medical History</b>(Please read carefully and answer all relevant questions. Tick (&#10003;) the
        appropriate answer).
    </div>

    <div class="max-w-5xl mx-auto p-2 bg-white text-black font-sans">

        <table class="w-full border-collapse border border-black text-xs leading-tight">

            <thead>
                <tr>
                    <th class="border border-black w-6 px-1 py-[2px]"></th>
                    <th class="border border-black px-1 py-[2px] text-left"></th>
                    <th class="border border-black w-10 px-1 py-[2px] text-center font-bold">YES</th>
                    <th class="border border-black w-10 px-1 py-[2px] text-center font-bold">NO</th>
                    <th class="border border-black w-24 px-1 py-[2px] text-center font-bold">REMARKS</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">1.</td>
                    <td class="border border-black px-1 py-[2px]">Do you feel well and healthy today?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">2.</td>
                    <td class="border border-black px-1 py-[2px]">Have you ever been refused as a blood donor or told
                        not to donate blood for any reasons?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">3.</td>
                    <td class="border border-black px-1 py-[2px]">Are you giving blood only because you want to be
                        tested for HIV or the AIDS virus or Hepatitis virus?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">4.</td>
                    <td class="border border-black px-1 py-[2px]">Are you aware that an HIV / Hepatitis infected person
                        can still transmit the virus despite a negative HIV / Hepatitis test?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">5.</td>
                    <td class="border border-black px-1 py-[2px]">Have you within the last <strong>12 HOURS</strong>
                        had taken liquor, beer or any drinks with alcohol?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">6.</td>
                    <td class="border border-black px-1 py-[2px]">In the last <strong>3 DAYS</strong> have you taken
                        aspirin?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">7.</td>
                    <td class="border border-black px-1 py-[2px]">In the past <strong>4 WEEKS</strong> have you taken
                        any medications and/or vaccinations?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">8.</td>
                    <td class="border border-black px-1 py-[2px]">In the past <strong>3 MONTHS</strong> have you
                        donated whole blood, platelets or plasma?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>

                <tr class="bg-gray-50">
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px] font-bold uppercase text-[10px]">IN THE PAST 6 MONTHS
                        HAVE YOU:</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>

                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">9.</td>
                    <td class="border border-black px-1 py-[2px]">Been to any places in the Philippines or countries
                        infected with ZIKA Virus?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">10.</td>
                    <td class="border border-black px-1 py-[2px]">Had sexual contact with a person who was confirmed to
                        have ZIKA Virus infection?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">11.</td>
                    <td class="border border-black px-1 py-[2px]">Had sexual contact with a person who has been to any
                        places in the Philippines or countries infected with ZIKA Virus?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>

                <tr class="bg-gray-50">
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px] font-bold uppercase text-[10px]">IN THE PAST 12 MONTHS
                        HAVE YOU:</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>

                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">12.</td>
                    <td class="border border-black px-1 py-[2px]">Received blood, blood products and/or had
                        tissue/organ transplant or graft?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">13.</td>
                    <td class="border border-black px-1 py-[2px]">Had surgical operation or dental extraction?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">14.</td>
                    <td class="border border-black px-1 py-[2px]">Had a tattoo applied, ear and body piercing,
                        acupuncture, needle stick injury or accidental contact with blood?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">15.</td>
                    <td class="border border-black px-1 py-[2px]">Had sexual contact with high risks individuals or in
                        exchange for material or monetary gain?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">16.</td>
                    <td class="border border-black px-1 py-[2px]">Engaged in unprotected, unsafe or casual sex?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">17.</td>
                    <td class="border border-black px-1 py-[2px]">Had jaundice/hepatitis/ personal contact with person
                        who had hepatitis?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">18.</td>
                    <td class="border border-black px-1 py-[2px]">Been incarcerated, jailed or imprisoned?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">19.</td>
                    <td class="border border-black px-1 py-[2px]">Spent time or have relatives in the United Kingdom or
                        Europe?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>

                <tr class="bg-gray-50">
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px] font-bold uppercase text-[10px]">HAVE YOU EVER:</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>

                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">20.</td>
                    <td class="border border-black px-1 py-[2px]">Travelled or lived outside of your place of residence
                        or outside the Philippines?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">21.</td>
                    <td class="border border-black px-1 py-[2px]">Taken prohibited drugs (orally, by nose, or by
                        injection)?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">22.</td>
                    <td class="border border-black px-1 py-[2px]">Used clotting factor concentrates?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">23.</td>
                    <td class="border border-black px-1 py-[2px]">Had a positive test for the HIV virus, Hepatitis
                        virus, Syphilis or Malaria?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">24.</td>
                    <td class="border border-black px-1 py-[2px]">Had Malaria or Hepatitis in the past?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">25.</td>
                    <td class="border border-black px-1 py-[2px]">Had or was treated for genital wart, syphilis,
                        gonorrhea or other sexually transmitted diseases?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>

                <tr class="bg-gray-50">
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px] font-bold uppercase text-[10px]">HAD ANY OF THE
                        FOLLOWING:</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>

                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">26.</td>
                    <td class="border border-black px-1 py-[2px]">Cancer, blood disease or bleeding disorder
                        (hemophilia)?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">27.</td>
                    <td class="border border-black px-1 py-[2px]">Heart disease/surgery, rheumatic fever or chest
                        pains?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">28.</td>
                    <td class="border border-black px-1 py-[2px]">Lung disease, tuberculosis or asthma?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">29.</td>
                    <td class="border border-black px-1 py-[2px]">Kidney disease, thyroid disease, diabetes, epilepsy?
                    </td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">30.</td>
                    <td class="border border-black px-1 py-[2px]">Chicken pox and/or cold sores?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">31.</td>
                    <td class="border border-black px-1 py-[2px]">Any other chronic medical condition or surgical
                        operations?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">32.</td>
                    <td class="border border-black px-1 py-[2px]">Have you recently had rash and/or fever? Was/ were
                        this/these also associated with arthralgia or arthritis or conjunctivitis?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>

                <tr class="bg-gray-50">
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px] font-bold uppercase text-center text-[10px]">FOR
                        FEMALE DONORS ONLY:</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>

                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">33.</td>
                    <td class="border border-black px-1 py-[2px]">Are you currently pregnant or have you ever been
                        pregnant?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">34.</td>
                    <td class="border border-black px-1 py-[2px]">When was your last childbirth?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">35.</td>
                    <td class="border border-black px-1 py-[2px]">In the past <strong>1 YEAR</strong>, did you have a
                        miscarriage or abortion?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">36.</td>
                    <td class="border border-black px-1 py-[2px]">Are you currently breastfeeding?</td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-[2px] text-center align-top">37.</td>
                    <td class="border border-black px-1 py-[2px] flex justify-between">
                        <span>When was your last menstrual period?</span>
                        <span class="font-bold mr-16">DATE:</span>
                    </td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                    <td class="border border-black px-1 py-[2px]"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="max-w-5xl mx-auto px-2 pb-2 bg-white text-black font-sans">

        <div class="relative border-t-2 border-dashed border-black mt-2 mb-3">
            <span class="absolute -top-4 left-0 bg-white pr-2 text-xl pb-1">✂</span>
        </div>

        <div class="border border-black p-2">

            <h2 class="text-center font-bold text-base mb-1">
                CONFIDENTIAL UNIT EXCLUSION (CUE)
            </h2>

            <p class="text-xs text-justify leading-tight mb-2">
                Please <strong>MARK</strong> one of the boxes below. If at one point <strong>DURING</strong> or
                <strong>AFTER</strong> donating blood is unsure of your initial answer, please inform our Blood Service
                Staff immediately. If you have already left the blood donation venue, contact the PRC Headquarters at
                telephone number (02)790-2300 or any Philippine Red Cross Office nearest you.
                <span class="text-red-700 font-bold text-xs ml-2 tracking-wide">(046) 402-6267 / 0926-685-9594</span>
            </p>

            <p class="text-center text-xs font-bold underline mb-3">
                MARK ONE BOX ONLY. YOUR RESPONSE WILL BE STRICTLY CONFIDENTIAL.
            </p>

            <div class="flex flex-row justify-between items-center mb-2 px-2">

                <div class="flex items-center space-x-4">
                    <div class="font-bold text-xs leading-tight text-right">
                        I BELIEVE THAT MY<br>BLOOD IS:
                    </div>

                    <div class="flex items-center space-x-1">
                        <div class="text-[10px] font-bold text-center leading-tight">
                            SAFE<br><span class="font-normal">for transfusion</span>
                        </div>
                        <div class="w-8 h-8 border-2 border-black bg-white"></div>
                    </div>

                    <div class="flex items-center space-x-1">
                        <div class="text-[10px] font-bold text-center leading-tight">
                            NOT SAFE<br><span class="font-normal">for transfusion</span>
                        </div>
                        <div class="w-8 h-8 border-2 border-black bg-white"></div>
                    </div>
                </div>

                <div class="flex flex-col text-xs font-bold w-64">
                    <div class="border-2 border-black text-center py-1 mb-1 bg-gray-50">
                        BBIS DONATION ID
                    </div>
                    <div class="flex items-end mb-1">
                        <span class="whitespace-nowrap mr-2">DATE OF DONATION:</span>
                        <div class="border-b border-black flex-grow"></div>
                    </div>
                    <div class="flex items-end">
                        <span class="whitespace-nowrap mr-2">PLACE OF DONATION:</span>
                        <div class="border-b border-black flex-grow"></div>
                    </div>
                </div>

            </div>

            <p class="text-center text-[10px] font-bold mt-3">
                *THANK YOU FOR DONATING YOUR BLOOD AND FOR HELPING THE PHILIPPINE RED CROSS MAINTAIN A SAFE BLOOD
                SUPPLY*
            </p>

        </div>
    </div>
    @pageBreak

    <div class="max-w-5xl mx-auto p-4 bg-white text-black font-sans text-xs">
        <div class="mb-2 font-bold">III. DONOR’S DECLARATION</div>
        <ul class="list-none space-y-1 text-justify mb-4 ml-2">
            <li class="flex items-start">
                <span class="mr-2">➤</span>
                <span>I certify that I am the person referred to above and that all the entries are read and well understood by me and to the best of my knowledge, truthfully answered all the questions in this Blood Donor Interview Sheet.</span>
            </li>
            <li class="flex items-start">
                <span class="mr-2">➤</span>
                <span>I understand that all questions are pertinent for my safety and for the benefit of the patient who will undergo blood transfusion.</span>
            </li>
            <li class="flex items-start">
                <span class="mr-2">➤</span>
                <span>I am voluntarily giving my blood through the Philippine Red Cross, without remuneration, for the use of persons in need of this vital fluid without regard to rank, race, color, creed, religion, or political persuasion.</span>
            </li>
            <li class="flex items-start">
                <span class="mr-2">➤</span>
                <span>I understand that my blood will be screened for Malaria, Syphilis, Hepatitis B, Hepatitis C and HIV. I am aware that the screening tests are not diagnostic and may yield false positive results. Should any of the screening tests give a reactive result, I authorize the Red Cross to inform me utilizing the information I have supplied, subject the results to confirmatory tests, offer counselling and to dispose of my donated blood in any way it may deem advisable for the safety of the majority of the populace.</span>
            </li>
            <li class="flex items-start">
                <span class="mr-2">➤</span>
                <span>I confirm that I am over the age of 18 years.</span>
            </li>
            <li class="flex items-start">
                <span class="mr-2">➤</span>
                <span>I understand that all information hereinto is treated confidential in compliance with the Data Privacy Act of 2012. I therefore authorize the Philippine Red Cross to utilize the information I supplied for purposes of research or studies for the benefit and safety of the community.</span>
            </li>
        </ul>

        <div class="grid grid-cols-2 gap-8 mb-4">
            <div class="border border-black">
                 <div class="text-center font-bold border-b border-black text-[10px]">For those ages 16-17</div>
                 <div class="flex text-center pt-8 pb-1">
                     <div class="w-1/2 border-r border-black px-1 flex flex-col justify-end">
                         <div class="border-b border-black mb-1"></div>
                         <span class="text-[9px]">Signature of Parent or Guardian</span>
                     </div>
                     <div class="w-1/2 px-1 flex flex-col justify-end">
                         <div class="border-b border-black mb-1"></div>
                         <span class="text-[9px]">Relationship to Blood Donor</span>
                     </div>
                 </div>
            </div>
            <div class="flex items-end justify-between space-x-4 pb-1">
                <div class="text-center w-1/2 flex flex-col justify-end">
                    <div class="border-b border-black mb-1"></div>
                    <span class="text-[10px]">Donor's Signature</span>
                </div>
                <div class="text-center w-1/2 flex flex-col justify-end">
                    <div class="border-b border-black mb-1"></div>
                    <span class="text-[10px]">Donor's Thumbmark</span>
                </div>
            </div>
        </div>

        <div class="mb-2 font-bold">IV. INITIAL SCREENING (To be filled up by the interviewer)</div>

        <table class="w-full border-collapse border border-black text-center text-[10px] mb-2">
            <thead>
                <tr>
                    <th colspan="4" class="border border-black"></th>
                    <th colspan="3" class="border border-black font-bold text-xs bg-gray-100">FOR APHERESIS DONOR</th>
                    <th class="border border-black"></th>
                </tr>
                <tr>
                    <th class="border border-black w-[12%] px-1 py-1">BODY WT</th>
                    <th class="border border-black w-[12%] px-1 py-1">SP. GR</th>
                    <th class="border border-black w-[12%] px-1 py-1">HGB</th>
                    <th class="border border-black w-[12%] px-1 py-1">HCT</th>
                    <th class="border border-black w-[12%] px-1 py-1">RBC</th>
                    <th class="border border-black w-[12%] px-1 py-1">WBC</th>
                    <th class="border border-black w-[12%] px-1 py-1">PLT count</th>
                    <th class="border border-black w-[16%] px-1 py-1 bg-gray-50 font-bold">BLOOD TYPE</th>
                </tr>
            </thead>
            <tbody>
                <tr class="h-8">
                    <td class="border border-black"></td>
                    <td class="border border-black"></td>
                    <td class="border border-black"></td>
                    <td class="border border-black"></td>
                    <td class="border border-black"></td>
                    <td class="border border-black"></td>
                    <td class="border border-black"></td>
                    <td class="border border-black"></td>
                </tr>
            </tbody>
        </table>

        <div class="flex text-[10px] mb-4">
            <div class="w-1/2 pr-4">
                 <div class="flex items-center mb-1"><span class="font-bold w-32">TYPE OF DONATION:</span> <span class="w-40 font-bold">IN-HOUSE:</span> <span class="ml-auto">( )</span></div>
                 <div class="flex items-center mb-1"><span class="w-32"></span> <span class="w-40 font-bold">WALK- IN/VOLUNTARY:</span> <span class="ml-auto">( )</span></div>
                 <div class="flex items-center mb-1"><span class="w-32"></span> <span class="w-40 font-bold">REPLACEMENT:</span> <span class="ml-auto">( )</span></div>
                 <div class="flex items-center mb-1"><span class="w-32"></span> <span class="w-40 font-bold">PATIENT-DIRECTED:</span> <span class="ml-auto">( )</span></div>
            </div>
            <div class="w-1/2 pl-4">
                 <div class="flex justify-between items-center mb-1"><span class="font-bold">Mobile Blood Donation</span> <span>( )</span></div>
                 <div class="flex items-end mb-1">
                     <span class="mr-1 font-bold w-20 text-right">PLACE:</span>
                     <div class="border-b border-black flex-grow"></div>
                 </div>
                 <div class="flex items-end mb-1">
                     <span class="mr-1 font-bold w-20 text-right">ORGANIZER:</span>
                     <div class="border-b border-black flex-grow"></div>
                 </div>
            </div>
        </div>

        <div class="border border-black grid grid-cols-12 text-center text-[10px] mb-4">
            <div class="col-span-5 border-r border-black h-8"></div>
            <div class="col-span-3 border-r border-black h-8"></div>
            <div class="col-span-1 border-r border-black h-8"></div>
            <div class="col-span-2 border-r border-black h-8"></div>
            <div class="col-span-1 h-8"></div>

            <div class="col-span-5 border-t border-black py-1 font-bold">Patient Name</div>
            <div class="col-span-3 border-t border-black py-1 font-bold">Hospital</div>
            <div class="col-span-1 border-t border-black py-1 font-bold">Blood Type</div>
            <div class="col-span-2 border-t border-black py-1 font-bold">WB/Component</div>
            <div class="col-span-1 border-t border-black py-1 font-bold">No. of units</div>
        </div>

        <div class="flex items-center text-[11px] font-bold mb-2">
            <span class="mr-6">History of previous donation?</span>
            <span class="mr-6">( ) YES</span>
            <span>( ) NO</span>
        </div>

        <table class="w-full border-collapse border border-black text-[10px] mb-4">
            <thead>
                <tr>
                    <th class="border border-black w-1/3 p-1"></th>
                    <th class="border border-black w-1/3 p-1">Red Cross</th>
                    <th class="border border-black w-1/3 p-1">Hospital</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-black px-1 py-1">No. of times</td>
                    <td class="border border-black"></td>
                    <td class="border border-black"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-1">Date of last donation</td>
                    <td class="border border-black"></td>
                    <td class="border border-black"></td>
                </tr>
                <tr>
                    <td class="border border-black px-1 py-1">Place of last donation</td>
                    <td class="border border-black"></td>
                    <td class="border border-black"></td>
                </tr>
            </tbody>
        </table>

        <div class="flex items-end justify-between mb-4 text-[10px]">
            <div class="w-1/3 text-center">
                <div class="border-b border-black mb-1"></div>
                <div class="font-bold italic">INTERVIEWER (print name & sign)</div>
            </div>
            <div class="w-1/3 text-center px-4">
                <div class="border-b border-black mb-1"></div>
                <div>PRC Office</div>
            </div>
            <div class="w-1/3 text-center">
                <div class="border-b border-black mb-1"></div>
                <div>Date</div>
            </div>
        </div>

        <div class="font-bold mb-1 border-t-2 border-black pt-2">V. PHYSICAL EXAMINATION (To be accomplished by the Blood Bank Physician)</div>

        <table class="w-full border-collapse border-b border-black text-center text-[10px] mb-4">
            <thead>
                <tr class="h-8">
                    <td class="border border-black w-[14%]"></td>
                    <td class="border border-black w-[14%]"></td>
                    <td class="border border-black w-[14%]"></td>
                    <td class="border border-black w-[14%]"></td>
                    <td class="border border-black w-[14%]"></td>
                    <td class="border border-black w-[14%]"></td>
                    <td class="border border-black w-[16%]"></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-1 py-1">Blood Pressure</td>
                    <td class="px-1 py-1">Pulse Rate</td>
                    <td class="px-1 py-1">Body Temp.</td>
                    <td class="px-1 py-1">Gen. Appearance</td>
                    <td class="px-1 py-1">Skin</td>
                    <td class="px-1 py-1">HEENT</td>
                    <td class="px-1 py-1">Heart and Lungs</td>
                </tr>
            </tbody>
        </table>

        <div class="flex text-[10px] mb-4">
            <div class="w-1/2">
                <div class="font-bold mb-1">REMARKS:</div>
                <div class="flex items-center mb-1"><span class="w-6 font-bold">( )</span> <span>Accepted</span></div>
                <div class="flex items-center mb-1">
                    <span class="w-6 font-bold">( )</span>
                    <span class="w-32">Temporarily Deferred</span>
                    <span class="mr-1">Reason:</span>
                    <div class="border-b border-black flex-grow"></div>
                </div>
                <div class="flex items-center mb-1">
                    <span class="w-6 font-bold">( )</span>
                    <span class="w-32">Permanently Deferred</span>
                    <span class="mr-1">Reason:</span>
                    <div class="border-b border-black flex-grow"></div>
                </div>
                <div class="flex items-center mb-1">
                    <span class="w-6 font-bold">( )</span>
                    <span class="w-32">Refused</span>
                    <span class="mr-1">Reason:</span>
                    <div class="border-b border-black flex-grow"></div>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-end mb-6 text-[10px]">
             <div class="flex items-center">
                <span class="font-bold mr-2">Blood bag to be used: (mark [V] appropriate box):</span>
                <span class="w-3 h-3 border border-black inline-block mr-1"></span> <span class="mr-2">Single</span>
                <span class="w-3 h-3 border border-black inline-block mr-1"></span> <span class="mr-2">Double</span>
                <span class="w-3 h-3 border border-black inline-block mr-1"></span> <span class="mr-2">Triple</span>
                <span class="w-3 h-3 border border-black inline-block mr-1"></span> <span class="mr-2">Quadruple</span>
                <span class="w-3 h-3 border border-black inline-block mr-1"></span> <span class="mr-2">Top & Bottom</span>
                <span class="w-3 h-3 border border-black inline-block mr-1"></span> <span>Apheresis</span>
             </div>

             <div class="text-center w-64">
                <div class="border-b border-black mb-1"></div>
                <div class="font-bold">BSF PHYSICIAN (print name & sign)</div>
             </div>
        </div>

        <div class="font-bold mb-1">VI. BLOOD COLLECTION (To be accomplished by the phlebotomist)</div>

        <div class="text-[10px] mb-2 font-bold">Blood Bag Used:</div>

        <div class="border border-black text-[10px] mb-4">
            <table class="w-full text-center border-collapse">
                 <thead>
                     <tr>
                         <th colspan="4" class="border-b border-r border-black py-1">KARMI</th>
                         <th colspan="2" class="border-b border-r border-black py-1">SPECIAL BAG</th>
                         <th colspan="3" class="border-b border-black py-1">APHERESIS</th>
                     </tr>
                     <tr>
                         <th class="border-r border-black font-normal py-1 w-[11%]">Single</th>
                         <th class="border-r border-black font-normal py-1 w-[11%]">Double</th>
                         <th class="border-r border-black font-normal py-1 w-[11%]">Triple</th>
                         <th class="border-r border-black font-normal py-1 w-[11%]">Quadruple</th>
                         <th class="border-r border-black font-normal py-1 w-[11%]">FK T&B</th>
                         <th class="border-r border-black font-normal py-1 w-[11%]">TRM T&B</th>
                         <th class="border-r border-black font-normal py-1 w-[11%]">Amicore</th>
                         <th class="border-r border-black font-normal py-1 w-[11%]">Haemonetics</th>
                         <th class="font-normal py-1 w-[12%]">Trima</th>
                     </tr>
                 </thead>
            </table>
        </div>

        <div class="flex text-[10px] mb-2">
            <div class="w-1/2 pr-2">
                 <div class="flex items-end mb-1">
                     <span class="mr-1 font-bold">Amount of Blood Taken:</span>
                     <div class="border-b border-black w-24 mx-1"></div>
                     <span class="font-bold">ml.</span>
                 </div>
                 <div class="flex items-end mb-1">
                     <span class="mr-1 font-bold">Donor Reaction:</span>
                     <div class="border-b border-black flex-grow"></div>
                 </div>
                 <div class="flex items-end mb-1">
                     <span class="mr-1 font-bold">Management Done:</span>
                     <div class="border-b border-black flex-grow"></div>
                 </div>
            </div>
            <div class="w-1/2 pl-2">
                 <div class="flex items-center mb-1">
                     <span class="mr-4 font-bold">Successful:</span>
                     <span class="mr-2 font-bold">YES _______</span>
                     <span class="font-bold">NO _______</span>
                 </div>
                 <div class="flex items-end mb-1">
                     <span class="mr-1 font-bold">Start Time:</span>
                     <div class="border-b border-black w-24 mr-4"></div>
                     <span class="mr-1 font-bold">End Time:</span>
                     <div class="border-b border-black w-24"></div>
                 </div>
            </div>
        </div>

        <div class="flex items-end justify-between mt-8 relative">
            <div class="border-2 border-black py-3 px-8 text-center font-bold text-sm">
                BBIS DONATION ID
            </div>

            <div class="text-center w-64 absolute right-0 bottom-4">
                 <div class="border-b border-black mb-1"></div>
                 <div class="font-bold text-[10px]">PHLEBOTOMIST (print name & sign)</div>
            </div>
        </div>

        <div class="text-right text-[8px] mt-8 font-bold">
            PRC-NBS DONOR FORM 321-E Revised Sep2025
        </div>

    </div>
</body>

</html>

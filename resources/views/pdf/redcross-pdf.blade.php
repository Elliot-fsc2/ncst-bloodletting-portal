<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>

    <div class="max-w-5xl mx-auto bg-white font-sans relative">

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
</body>

</html>

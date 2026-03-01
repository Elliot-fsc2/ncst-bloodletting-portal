<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    @php
        $p = $data['personal'] ?? [];
        $h = $data['history'] ?? [];
        $sa = $data['section_a'] ?? [];
        $sb = $data['section_b'] ?? [];
        $sc = $data['section_c'] ?? [];
        $sd = $data['section_d'] ?? [];
        $se = $data['section_e'] ?? [];
        $age = !empty($p['birthdate']) ? \Carbon\Carbon::parse($p['birthdate'])->age : '';
    @endphp
    <div class="page">
        <div class="max-w-5xl mx-auto bg-white text-black font-sans">
            <table class="w-full border-collapse border border-black text-center text-sm leading-tight mb-2">
                <tbody>
                    <tr>
                        <td rowspan="3" class="border border-black p-1 w-[15%]">
                            <img src="{{ asset('images/vmmc.png') }}" alt="VMMC Logo" class="w-30 h-30 mx-auto">
                        </td>
                        <td class="border border-black p-1 w-[50%]">
                            <div class="text-base font-semibold">VETERANS MEMORIAL MEDICAL CENTER</div>
                            <div>North Avenue, Diliman, Quezon City</div>
                        </td>
                        <td colspan="2" class="border border-black p-1 text-left align-top w-[35%]">
                            <div class="text-[11px]">Form No.:</div>
                            <div class="font-bold text-sm">VMMC-MR-DOP_BB FORM 003</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            <div>DEPARTMENT OF PATHOLOGY</div>
                            <div>BLOOD BANK UNIT</div>
                        </td>
                        <td class="border border-black p-1 text-left align-top w-[17.5%]">
                            <div class="text-[11px]">Rev. No.:</div>
                            <div class="font-bold">01</div>
                        </td>
                        <td class="border border-black p-1 text-left align-top w-[17.5%]">
                            <div class="text-[11px]">Page:</div>
                            <div class="font-bold">1 of 3</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1 text-base uppercase tracking-wide">
                            Blood Donor Interview Data Sheet
                        </td>
                        <td class="border border-black p-1 text-left align-top">
                            <div class="text-[11px]">Issued By:</div>
                            <div class="font-bold">DOP BB</div>
                        </td>
                        <td class="border border-black p-1 text-left align-top">
                            <div class="text-[11px]">Date:</div>
                            <div class="font-bold">October 2023</div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-center mb-2">
                <div class="border border-black rounded-xl px-4 py-1 text-center text-sm">
                    Place Barcode Sticker of<br>
                    Donation ID no. here
                </div>
            </div>
            <div class="flex justify-between items-end gap-3 mb-2 px-1">
                <div class="w-1/3 flex flex-col items-center">
                    <div class="border-b border-black w-full min-h-[20px] text-center text-sm font-semibold">
                    </div>
                    <div class="text-sm mt-1">Date</div>
                </div>
                <div class="w-1/3 flex flex-col items-center">
                    <div class="border-b border-black w-full min-h-[20px] text-center text-sm font-semibold"></div>
                    <div class="text-sm mt-1">Serial No</div>
                </div>
                <div class="w-1/3 flex flex-col items-center">
                    <div
                        class="border-b border-black w-full min-h-[20px] text-center text-sm font-semibold text-red-600">
                    </div>
                    <div class="text-sm mt-1">Blood Type</div>
                </div>
            </div>
            <div class="flex justify-between items-end gap-3 mb-2 px-1">
                <div class="w-1/3 flex flex-col items-center">
                    <div class="border-b border-black w-full min-h-[16px] text-center text-sm font-semibold">
                    </div>
                    <div class="text-sm mt-1">Venue</div>
                </div>
                <div class="w-1/3 flex flex-col items-center">
                    <div class="border-b border-black w-full min-h-[20px] text-center text-sm font-semibold"></div>
                    <div class="text-sm mt-1">Pilot tube</div>
                </div>
                <div class="w-1/3 flex flex-col items-center">
                    <div class="border-b border-black w-full min-h-[20px] text-center text-sm font-semibold"></div>
                    <div class="text-sm mt-1">Type of ID/ ID no.</div>
                </div>
            </div>
            <div class="font-bold text-sm mb-1 px-1">
                PERSONAL DATA:
            </div>
            <div class="flex justify-between items-end gap-3 mb-1 px-1">
                <div class="w-1/3 flex flex-col items-center">
                    <div class="border-b-2 border-black w-full min-h-[20px] text-center text-sm font-bold uppercase">
                        {{ $p['surname'] ?? '' }}
                    </div>
                    <div class="text-xs font-bold mt-1">SURNAME</div>
                </div>
                <div class="w-1/3 flex flex-col items-center">
                    <div class="border-b-2 border-black w-full min-h-[20px] text-center text-sm font-bold uppercase">
                        {{ $p['given_name'] ?? '' }}
                    </div>
                    <div class="text-xs font-bold mt-1">GIVEN NAME</div>
                </div>
                <div class="w-1/3 flex flex-col items-center">
                    <div class="border-b-2 border-black w-full min-h-[20px] text-center text-sm font-bold uppercase">
                        {{ $p['middle_name'] ?? '' }}
                    </div>
                    <div class="text-xs font-bold mt-1">MIDDLE NAME</div>
                </div>
            </div>
            <div class="flex flex-wrap items-end mb-2 text-sm gap-y-2">
                <div class="flex items-end mr-4">
                    <span class="mr-1 whitespace-nowrap">DATE OF BIRTH:</span>
                    <div class="w-8 border-b border-black text-center min-h-[20px] font-semibold text-xs">
                        {{ $p['birthdate'] ?? '' }}</div>
                </div>
                <div class="flex items-end mr-4">
                    <span class="mr-1 whitespace-nowrap">AGE/SEX:</span>
                    <div class="w-8 border-b border-black text-center min-h-[20px] font-semibold text-xs">
                        {{ $age }}</div><span class="mx-1">/</span>
                    <div class="w-8 border-b border-black text-center min-h-[20px] font-semibold text-xs">
                        {{ $p['sex'] ?? '' }}</div>
                </div>
                <div class="flex items-end mr-4 flex-grow">
                    <span class="mr-1 whitespace-nowrap">CIVIL STATUS:</span>
                    <div class="flex-grow border-b border-black min-h-[20px] text-center font-semibold text-xs">
                        {{ $p['civil_status'] ?? '' }}</div>
                </div>
                <div class="flex items-end flex-grow">
                    <span class="mr-1 whitespace-nowrap">OCCUPATION:</span>
                    <div class="flex-grow border-b border-black min-h-[20px] text-center font-semibold text-xs">
                        {{ $p['occupation'] ?? '' }}
                    </div>
                </div>
            </div>
            <div class="flex items-start mb-2 text-sm w-full">
                <span class="mr-2 whitespace-nowrap mt-1">HOME ADDRESS:</span>
                <div class="flex w-full gap-2">
                    <div class="flex flex-col flex-grow-[0.5]">
                        <div class="border-b border-black w-full min-h-[20px] text-center font-semibold text-xs">
                            {{ $p['house_no'] ?? '' }}</div>
                        <div class="text-[11px] text-center mt-0.5">House no.</div>
                    </div>
                    <div class="flex flex-col flex-grow">
                        <div class="border-b border-black w-full min-h-[20px] text-center font-semibold text-xs">
                            {{ $p['street'] ?? '' }}
                        </div>
                        <div class="text-[11px] text-center mt-0.5">Street</div>
                    </div>
                    <div class="flex flex-col flex-grow">
                        <div class="border-b border-black w-full min-h-[20px] text-center font-semibold text-xs">
                            {{ $p['subdivision'] ?? '' }}
                        </div>
                        <div class="text-[11px] text-center mt-0.5">Subdivision</div>
                    </div>
                    <div class="flex flex-col flex-grow">
                        <div class="border-b border-black w-full min-h-[20px] text-center font-semibold text-xs">
                            {{ $p['barangay'] ?? '' }}
                        </div>
                        <div class="text-[11px] text-center mt-0.5">Barangay</div>
                    </div>
                    <div class="flex flex-col flex-grow-[1.5]">
                        <div class="border-b border-black w-full min-h-[20px] text-center font-semibold text-xs">
                            {{ $p['city_province'] ?? '' }}</div>
                        <div class="text-[11px] text-center mt-0.5">City/Province</div>
                    </div>
                </div>
            </div>
            <div class="flex items-end mb-2 text-sm gap-3">
                <div class="flex items-end w-1/2">
                    <span class="mr-2 whitespace-nowrap">EMAIL ADD.:</span>
                    <div class="border-b border-black flex-grow min-h-[20px] text-center font-semibold text-xs">
                        {{ $p['email'] ?? '' }}</div>
                </div>
                <div class="flex items-end w-1/2">
                    <span class="mr-2 whitespace-nowrap">CONTACT NUMBER:</span>
                    <div class="border-b border-black flex-grow min-h-[20px] text-center font-semibold text-xs">
                        {{ $p['contact_number'] ?? '' }}</div>
                </div>
            </div>
            <div class="flex flex-wrap items-end mb-2 text-sm gap-y-2">
                <div class="flex items-end flex-grow-[2] mr-4">
                    <span class="mr-2 whitespace-nowrap">NAME OF PATIENT:</span>
                    <div class="border-b border-black flex-grow min-h-[20px] text-center font-semibold text-xs">
                    </div>
                </div>
                <div class="flex items-end flex-grow mr-4">
                    <span class="mr-2 whitespace-nowrap">CATEGORY:</span>
                    <div class="border-b border-black flex-grow min-h-[20px] text-center font-semibold text-xs">
                    </div>
                </div>
                <div class="flex items-end flex-grow">
                    <span class="mr-2 whitespace-nowrap">WARD/ROOM NO.:</span>
                    <div class="w-10 border-b border-black text-center min-h-[20px] font-semibold text-xs"></div>
                    <span class="mx-1">/</span>
                    <div class="w-10 border-b border-black text-center min-h-[20px] font-semibold text-xs"></div>
                </div>
            </div>
            <div class="flex flex-col text-sm gap-1 mb-1">
                <div class="flex items-center">
                    <span class="w-40 whitespace-nowrap">Type of Donor:</span>
                    <div class="flex items-center w-36 cursor-pointer">
                        <div class="w-3.5 h-3.5 border border-black rounded-full mr-2">
                        </div>
                        <span>Walk-in</span>
                    </div>
                    <div class="flex items-center cursor-pointer">
                        <div class="w-3.5 h-3.5 border border-black rounded-full mr-2"></div>
                        <span>Mobile Blood Donation</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="w-40 whitespace-nowrap">Method of Collection:</span>
                    <div class="flex items-center w-36 cursor-pointer">
                        <div class="w-3.5 h-3.5 border border-black rounded-full mr-2">
                        </div>
                        <span>Conventional</span>
                    </div>
                    <div class="flex items-center cursor-pointer">
                        <div class="w-3.5 h-3.5 border border-black rounded-full mr-2"></div>
                        <span>Apheresis</span>
                    </div>
                </div>
            </div>
            <table class="w-full border-collapse border-2 border-black text-[11px] leading-tight mt-2">
                <thead>
                    <tr>
                        <th class="border border-black p-1 text-left w-[85%]"></th>
                        <th class="border border-black p-1 text-center w-[7.5%] font-bold">YES<br>(OO)</th>
                        <th class="border border-black p-1 text-center w-[7.5%] font-bold">NO<br>(HINDI)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-black p-1">
                            <span class="font-bold uppercase">MEDICAL HISTORY:</span>
                            <span class="ml-2">Check your answer <span class="italic">(Markahan ng (✔) ang inyong
                                    sagot)</span></span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold"></td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold"></td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            1. Have you donated blood before? If yes, indicate the date and place of last donation.<br>
                            <span class="italic">Nakapagbigay ka na ba ng dugo? Kung oo, isulat kung saan at kalian ang
                                huling donasyon.</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($h['donated_before'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($h['donated_before'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            2. Have you ever donated or attempted to donate blood using different (or another) name here
                            or
                            elsewhere?<br>
                            <span class="italic">Nakapagbigay ka na ba ng dugo na gumamit ng ibang pangalan dito o sa
                                ibang
                                lugar?</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($h['used_different_name'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($h['used_different_name'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            3. Have you for any reason been deferred as a blood donor or told not to donate blood?<br>
                            <span class="italic">Ikaw ba ay hindi natanggap o nasabihan na hindi puwedeng magbigay ng
                                dugo
                                sa ano mang dahilan?</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($h['deferred_before'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($h['deferred_before'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1 font-bold uppercase">
                            SECTION A. KONDISYON SA NAKARAANG 18 NA BUWAN
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold"></td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold"></td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            1. Have you within the last eighteen (18) months had any of the following: high blood
                            pressure,
                            night sweats, unexplained fevers, unexplained weight loss, persistent diarrhea, enlarged
                            lymph
                            node?<br>
                            <span class="italic">Sa nakaraang labing-walong (18) buwan, nagkaroon o nakaranas ka ba ng
                                isa
                                sa mga sumusunod: alta-presyon, pagpapawis sa gabi, hindi maipaliwanag na lagnat,
                                madalas na
                                pagdumi, malaking kulani?</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sa['symptoms'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sa['symptoms'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1 font-bold uppercase">
                            SECTION B. KONDISYON SA NAKARAANG 12 NA BUWAN
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold"></td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold"></td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            1. Any of the following (ENCIRCLE): malaria, hepatitis, jaundice, syphilis, chicken pox,
                            shingles, cold sores, serious accident, cancer, blood disease like leukemia, recent or
                            severe
                            respiratory disease, cardiovascular disease, kidney disease, syphilis, diabetes, asthma,
                            epilepsy, tuberculosis?<br>
                            <span class="italic">Nagkaroon o nakaranas sa mga sumusunod: malarya, sakit sa atay,
                                paninilaw
                                ng mga mata at buong katawan, tulo, bulutong tubig, singaw, malubhang aksidente, kanser,
                                sakit sa dugo tulad ng leukemia o walang tigil na pagdurugo, sakit sa baga, sakit sa
                                puso,
                                sakit sa bato, syphilis, dyabetis, hika, epilepsy, tuberculosis?</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['diseases'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['diseases'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            2. Under doctor's care or had a major illness or surgery?<br>
                            <span class="italic">Nasa pangangalaga ng doctor o nagkaroon ng malubhang karamdaman o
                                operasyon?</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['doctor_care'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['doctor_care'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            3. Have you ever had a dental surgery for the past twelve (12) months or tooth extraction
                            for
                            the past six (6) months?<br>
                            <span class="italic">Naoperahan ka ba ng ngipin sa nakaraang labindalawang (12) buwan? O
                                Nagpabunot ka ba ng ngipin simula nitong nakaraang anim (6) na buwan?</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['dental'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['dental'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            4. Taken prohibited drugs? (orally, by nose or injection)<br>
                            <span class="italic">Nakagamit ng mga ipinagbabawal na gamut? (ininum, sininghot "cocaine"
                                o
                                naitusok ng karayom)</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['drugs'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['drugs'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            5. Received blood or taken clotting factor concentrates for bleeding problem such as
                            hemophilia
                            and had an organ or tissue transplant or graft?<br>
                            <span class="italic">Ikaw ba ay nasalinan ng dugo dahil sa hemophilia at naoperahan o
                                nabigyan
                                ng bahagi ng katawan na galing sa ibang tao?</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['transplant'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['transplant'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



    <div class="page">
        <div class="max-w-5xl mx-auto bg-white text-black font-sans">
            <table class="w-full border-collapse border-2 border-black text-[11px] leading-tight">
                <thead>
                    <tr>
                        <th class="border border-black p-1 text-left w-[85%]"></th>
                        <th class="border border-black p-1 text-center w-[7.5%] font-bold">YES<br>(OO)</th>
                        <th class="border border-black p-1 text-center w-[7.5%] font-bold">NO<br>(HINDI)</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td class="border border-black p-1">
                            6. A tattoo applied, ear piercing, acupuncture, accidental needle stick or come in contact
                            with
                            someone else's blood?<br>
                            <span class="italic">Nagpalagay ng tattoo, nagpabutas sa tenga, nagpa-akyupuncture,
                                naturukan
                                ng karayom nang hindi sinasadya o nadikit sa dugo ng ibang tao?</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['tattoo'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['tattoo'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>

                    <tr>
                        <td class="border border-black p-1">
                            7. Engaged in sexual activity on the same sex or multiple sexual partners?<br>
                            <span class="italic">Nagkaroon ng karanasan na makipagtalik sa kaparehong kasarian (lalaki
                                sa
                                lalaki, babae sa babae) o higit pa sa isa ang naging katalik</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['sex_multi'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['sex_multi'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>

                    <tr>
                        <td class="border border-black p-1">
                            8. Engaged in sexual activity with an individual who received an injection without proper
                            medical supervision?<br>
                            <span class="italic">Nagkaroon ng karanasan sa taong naturukan ng gamot na walang
                                pahintulot ng
                                doktor?</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['sex_unsupervised'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['sex_unsupervised'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>

                    <tr>
                        <td class="border border-black p-1">
                            9. In personal contact with anyone who had hepatitis?<br>
                            <span class="italic">May nakasama sa bahay o taong lagi mong nakakahalubilo na may sakit sa
                                atay?</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold"></td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold"></td>
                    </tr>

                    <tr>
                        <td class="border border-black p-1">
                            10. Given money or drugs to anyone to have sex with you or had sex with anyone who has taken
                            money or drugs for sex?<br>
                            <span class="italic">Nagbayad kahit kanino para lang makipagtalik sa iyo o nakipagtalik
                                kahit
                                kanino na tumatanggap ng pera o ng ipinagbabawal na gamot para lang makipag talik sa
                                isang
                                tao?</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['sex_money'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['sex_money'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>

                    <tr>
                        <td class="border border-black p-1">
                            11. A sexual partner who is bisexual or medically unsupervised user of intravenous drug, who
                            had
                            taken clotting factor concentrates for bleeding problem and has HIV or had a positive test
                            for
                            HIV virus?<br>
                            <span class="italic">Nagkaroon ka ba ng kasintahan na nakikipagtalik sa kaparehong kasarian
                                at
                                gumagamit ng gamot na walang pahintulot ng doktor?</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['sex_bisexual'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['sex_bisexual'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>

                    <tr>
                        <td class="border border-black p-1">
                            12. To malaria endemic areas like Palawan and Mindoro?<br>
                            <span class="italic">Nakapunta sa lugar na laganap ang malaria katulad ng Palawan at
                                Mindoro?</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['malaria_area'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['malaria_area'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>

                    <tr>
                        <td class="border border-black p-1">
                            13. In jail or prison?<br>
                            <span class="italic">Nakulong o nabilanggo?</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['jail'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sb['jail'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>

                    <tr>
                        <td class="border border-black p-1 font-bold uppercase">
                            SECTION C. KONDISYON SA NAKARAANG 4 NA LINGGO
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold"></td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold"></td>
                    </tr>

                    <tr>
                        <td class="border border-black p-1">
                            1. In the past four weeks, have you taken any medications such as Isotretinoin (Accutane) or
                            Finasteride (Proscar, Propecia), etretinate (Tegison) for psoriasis, Feldene, aspirin other
                            medicines?<br>
                            <span class="italic">Sa nakaraang apat na lingo, ikaw ba ay nakainom ng as Isotretinoin
                                (Accutane) or Finasteride (Proscar, Propecia), Etretinate (Tegison) para sa psoriasis,
                                Feldene, aspirin o kahit anong gamot?</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sc['meds'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sc['meds'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>

                    <tr>
                        <td class="border border-black p-1">
                            2. Have you ever received human pituitary-derived growth hormone or had a brain covering
                            graft?<br>
                            <span class="italic">Ikaw ba ay tumanggap ng "human pituitary-derived growth hormone" o
                                naoperahan na sa uttak?</span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sc['growth_hormone'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sc['growth_hormone'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            3. Have you within the last twenty-four (24) hours had an intake of alcohol?<br>
                            <span class="italic">Nakainom ka ba ng alak sa nakaraang dalawampu’t apat (24) na oras
                            </span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sc['alcohol'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sc['alcohol'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            4. Do you intend to ride/pilot an airplane within twenty-four (24) hours or tend to drive a
                            heavy or any
                            transport vehicle within the next twelve (12) hours?<br>
                            <span class="italic">Ikaw ba ay may balak na sumakay/magpalipad ng eroplano sa susunod na
                                dalawangpu’t apat na oras o
                                may balak na magmaneho ng sasakyan sa susunod na labindalawang oras?
                            </span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sc['pilot_driver'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sc['pilot_driver'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            5. Are you currently suffering from illness, allergy, or any infectious disease?<br>
                            <span class="italic">Sa kasalukuyan, ikaw ba ay may karamdaman, nakahahawang sakit tulad ng
                                sipon, nakararanas ng
                                pangangati (allergy), trangkaso, o pananakit ng lalamunan?
                            </span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sc['illness'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sc['illness'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>

                    <tr>
                        <td class="border border-black p-1 font-bold uppercase">
                            SECTION D. COVID-19
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold"></td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold"></td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            1. In the past 28 days, have you travelled outside the Philippines? If yes, indicate the
                            country/ies.<br>
                            <span class="italic">Sa nakalipas na dalawangpu’t walong araw, ikaw ba ay nag biyahe sa
                                labas
                                ng Pilipinas? Kung Oo,
                                isaad kung anung bansa o mga bansa.
                            </span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sd['travel_intl'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sd['travel_intl'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            2. In the past 28 days, have you ever had close contact (live with, worked with, travelled
                            with
                            or cared for)
                            a confirmed COVID -19 patient
                            <br>
                            <span class="italic">Sa nakalipas na dalawangpu’t walong araw, ikaw ba ay may nakasalamuha
                                (kasama sa bahay,
                                katrabaho, nakasabay sa biyahe) na isang COVID-19 patient?
                            </span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sd['covid_contact'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sd['covid_contact'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            3. Have you ever had close contact with a person exhibiting symptoms of acute respiratory
                            illness?
                            <br>
                            <span class="italic">May nakasalamuha na may sintomas ng ubo, sipon, lagnat o acute
                                respiratory
                                illness?
                            </span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sd['symptoms_contact'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sd['symptoms_contact'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            4. Have you received vaccine against COVID-19? If Yes, kindly indicate the date and type of
                            vaccine.
                            _____________________

                            <br>
                            <span class="italic">Ikaw ba ay nakatanggap na ng bakuna laban sa COVID-19? Kung Oo, Kailan
                                at
                                anong bakuna
                                ito.____________________________
                            </span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sd['vaccine_received'] ?? '') === 'yes' ? '✔' : '' }}</td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold">
                            {{ ($sd['vaccine_received'] ?? '') === 'no' ? '✔' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1 font-bold uppercase">
                            SECTION E. FEMALE DONORS (PARA SA MGA KABABAIHAN)
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold"></td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold"></td>
                    </tr>
                    <tr>
                        <td class="border border-black p-1">
                            1. When was your last delivery? {{ $se['delivery'] ?? '_________' }} When was your last
                            menstruation? {{ $se['menstruation'] ?? '_________' }}
                            <br>
                            <span class="italic">Kailan ka huling nanganak? {{ $se['delivery'] ?? '____________' }}
                                Kailan ka huling
                                dinatnan/niregla? {{ $se['menstruation'] ?? '' }}
                            </span>
                        </td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold"></td>
                        <td class="border border-black p-1 text-center align-middle text-sm font-bold"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



    <div class="page">
        <div class="max-w-5xl mx-auto bg-white text-black font-sans">
            <div class="font-bold text-sm mb-1">CONSENT</div>

            <div class="text-xs leading-snug mb-2 space-y-1 text-justify">
                <p class="indent-8">
                    "I have read this form and understand its content and voluntarily give my consent for the
                    collection,
                    use, processing, storage and retention of my personal data or information to OPERATION LIFELINE -
                    VMMC
                    for the purpose described in this document. I also understand that my consent does not prevent the
                    existence of other criteria for lawful processing of personal data and does not waive any of my
                    rights
                    under RA 10173- Data Privacy Act of 2012 and other applicable laws.
                </p>
                <p class="indent-8">
                    It is my free and voluntary act and deed to donate my blood and I am aware of its risks and
                    consequences
                    during and after extraction having been explained to me in clear and understandable language and
                    dialect
                    that I speak."
                </p>
                <p class="indent-8">
                    I understand that my blood will be screened for blood type, hemoglobin, malaria, syphilis, hepatitis
                    B &
                    C, and HIV 1 & 2 and no result will be issued to me. If found reactive, I agree to be referred to
                    the
                    appropriate facility for counseling and further management. I certify that I have to the best of my
                    knowledge, truthfully answered the above questions."
                </p>
                <p class="indent-8 italic">
                    "Nagpapatunay na ako ang taong tinutukoy at ang lahat ng nakasulat dito ay nabasa ko at
                    naiintindihan at
                    ako ay kusang loob na magbibigay ng dugo. Alam ko ang mga panganib at kahihinatnan sa mga sandaling
                    kinukuhanan ako ng dugo hanggang sa matapos ang donasyon. Ito ay naipaliwanag sa akin at
                    naiintindihan
                    ko nang mabuti."
                </p>
                <p class="indent-8 italic">
                    "Pagkatapos masagutan nang buong katapatan ang mga tanong, ako ay kusa at buong loob na magbibigay
                    ng
                    dugo sa OPERATION LIFELINE - VMMC. Naiintindihan ko na ang aking dugo ay susurin nang mabuti upang
                    malaman ang blood type, hemoglobin, malaria, syphilis, hepatitis B at C, at HIV 1 at 2 at walang
                    opisyal
                    na resulta na ibibgay sa akin. Kung sakaling maging "reactive", ako ay sumasang-ayon na maisangguni
                    sa
                    nararapat na pasilidad para sa karagdagang pagsusuri.
                </p>
            </div>

            <div class="w-[60%] mx-auto mb-3 flex flex-col items-center">
                <div class="border-b border-black w-full min-h-[20px]"></div>
                <div class="text-xs font-bold mt-1 text-center">(Donor's Signature/ Lagda ng magbibigay donasyon)</div>
            </div>

            <div class="text-center font-bold text-base underline mb-2">
                FOR BLOOD BANK USE ONLY
            </div>

            <div class="font-bold text-sm underline mb-2">
                PHYSICAL EXAMINATION:
            </div>

            <div class="flex flex-wrap items-end mb-2 text-xs gap-x-2">
                <div class="flex items-end flex-grow">
                    <span class="mr-2 whitespace-nowrap">Body Weight:</span>
                    <div class="border-b border-black flex-grow min-h-[16px]"></div>
                </div>
                <div class="flex items-end flex-grow">
                    <span class="mr-2 whitespace-nowrap">Blood Pressure:</span>
                    <div class="border-b border-black flex-grow min-h-[16px]"></div>
                </div>
                <div class="flex items-end flex-grow">
                    <span class="mr-2 whitespace-nowrap">Pulse Rate:</span>
                    <div class="border-b border-black flex-grow min-h-[16px]"></div>
                </div>
                <div class="flex items-end flex-grow">
                    <span class="mr-2 whitespace-nowrap">Temperature:</span>
                    <div class="border-b border-black flex-grow min-h-[16px]"></div>
                </div>
            </div>

            <div class="flex flex-wrap items-end mb-2 text-xs gap-x-2">
                <div class="flex items-end flex-grow-[2]">
                    <span class="mr-2 whitespace-nowrap">General Appearance:</span>
                    <div class="border-b border-black flex-grow min-h-[16px]"></div>
                </div>
                <div class="flex items-end flex-grow-[3]">
                    <span class="mr-2 whitespace-nowrap">Skin:</span>
                    <div class="border-b border-black flex-grow min-h-[16px]"></div>
                </div>
            </div>

            <div class="flex flex-wrap items-end mb-2 text-xs gap-x-2">
                <div class="flex items-end flex-grow-[2]">
                    <span class="mr-2 whitespace-nowrap">HEENT:</span>
                    <div class="border-b border-black flex-grow min-h-[16px]"></div>
                </div>
                <div class="flex items-end flex-grow-[3]">
                    <span class="mr-2 whitespace-nowrap">Heart and Lungs:</span>
                    <div class="border-b border-black flex-grow min-h-[16px]"></div>
                </div>
            </div>

            <div class="text-xs mb-3">
                <div class="mb-2">REMARKS:</div>
                <div class="ml-8 flex flex-col gap-1 mb-4">
                    <div class="flex items-center">
                        <span class="mr-2 text-[10px]">O</span>
                        <span>Accepted</span>
                    </div>
                    <div class="flex items-center">
                        <span class="mr-2 text-[10px]">O</span>
                        <span>Temporarily Deferred</span>
                    </div>
                    <div class="flex items-center">
                        <span class="mr-2 text-[10px]">O</span>
                        <span>Permanently Deferred</span>
                    </div>
                </div>
                <div class="flex items-end ml-8">
                    <span class="mr-2">Reason:</span>
                    <div class="border-b border-black flex-grow min-h-[16px]"></div>
                </div>
            </div>

            <div class="flex justify-between items-start text-xs">

                <div class="w-2/5 flex flex-col gap-1 mt-4">
                    <div class="flex items-end">
                        <span class="w-24">Hemoglobin:</span>
                        <div class="border-b border-black flex-grow min-h-[16px]"></div>
                    </div>
                    <div class="flex items-end">
                        <span class="w-24">Hematocrit:</span>
                        <div class="border-b border-black flex-grow min-h-[16px]"></div>
                    </div>
                    <div class="flex items-end">
                        <span class="w-24">Malaria :</span>
                        <div class="border-b border-black flex-grow min-h-[16px]"></div>
                    </div>
                    <div class="flex items-end">
                        <span class="w-24">Platelet Count:</span>
                        <div class="border-b border-black flex-grow min-h-[16px]"></div>
                    </div>
                    <div class="flex items-end">
                        <span class="w-24">WBC Count:</span>
                        <div class="border-b border-black flex-grow min-h-[16px]"></div>
                    </div>
                </div>

                <div class="w-2/5 flex flex-col gap-6">
                    <div class="flex flex-col items-start w-full">
                        <div class="border-b border-black w-full min-h-[16px]"></div>
                        <span class="mt-1">Examining Physician/Nurse</span>
                        <span class="text-[10px]">(Signature over printed name)</span>
                    </div>

                    <div class="flex flex-col items-start w-full mt-1 gap-1">
                        <span>Screened by:</span>
                        <div class="border-b border-black w-full min-h-[16px]"></div>
                        <div class="border-b border-black w-full min-h-[16px]"></div>
                        <div class="border-b border-black w-full min-h-[16px]"></div>
                        <div class="border-b border-black w-full min-h-[16px]"></div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-start w-full mt-1 text-xs">
                <div class="flex flex-col w-1/2 pr-4 gap-1 mt-2">
                    <div class="flex flex-col w-48 mb-1">
                        <div class="border-b border-black w-full min-h-[14px]"></div>
                        <span>PHLEBOTOMIST (print name & sign)</span>
                    </div>
                    <div class="flex items-end">
                        <span class="w-20">Time Started:</span>
                        <div class="border-b border-black w-24 min-h-[14px]"></div>
                    </div>
                    <div class="flex items-end">
                        <span class="w-20">Time Finished:</span>
                        <div class="border-b border-black w-24 min-h-[14px]"></div>
                    </div>
                </div>

                <div class="flex flex-col w-1/2 gap-1 mt-2">
                    <div class="flex items-start h-[16px]">
                        <span>Remarks:</span>
                    </div>
                    <div class="flex items-end gap-1">
                        <span class="w-28">Sufficient Collection:</span>
                        <span class="tracking-widest">( )</span>
                        <div class="border-b border-black w-20 min-h-[14px]"></div>
                        <span>mL</span>
                    </div>
                    <div class="flex items-end gap-1">
                        <span class="w-28">Insufficient Collection:</span>
                        <span class="tracking-widest">( )</span>
                        <div class="border-b border-black w-20 min-h-[14px]"></div>
                        <span>mL</span>
                    </div>
                </div>

            </div>

            <div class="flex items-center gap-2 mt-2 text-xs">
                <span>Blood Bag Used:</span>
                <div class="flex items-center gap-1 cursor-pointer">
                    <span class="tracking-widest">( )</span>
                    <span>Single Bag</span>
                </div>
                <div class="flex items-center gap-1 cursor-pointer">
                    <span class="tracking-widest">( )</span>
                    <span>Double Bag</span>
                </div>
                <div class="flex items-center gap-1 cursor-pointer">
                    <span class="tracking-widest">( )</span>
                    <span>Triple Bag</span>
                </div>
            </div>

        </div>
    </div>
</body>

</html>

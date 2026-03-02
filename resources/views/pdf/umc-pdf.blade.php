<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="bg-white text-black font-sans text-[9px]">

    @php
        $p = $data['personal'] ?? [];

        $surname = strtoupper($p['surname'] ?? '');
        $firstName = strtoupper($p['first_name'] ?? '');
        $middleName = strtoupper($p['middle_name'] ?? '');

        $age = $p['age'] ?? '';
        $gender = $p['gender'] ?? '';
        $birthdate = !empty($p['birthdate']) ? \Carbon\Carbon::parse($p['birthdate'])->format('F d, Y') : '';
        $civilStatus = $p['civil_status'] ?? '';
        $address = $p['address'] ?? '';
        $occupation = $p['occupation'] ?? '';
        $businessAddress = $p['business_address'] ?? '';
        $cellphone = $p['cellphone'] ?? '';
        $nationality = $p['nationality'] ?? '';
        $telephone = $p['telephone'] ?? '';

        // Dynamic box count: at least the minimum, expands for longer names
        $surnameChars = str_split(str_pad($surname, max(16, mb_strlen($surname))));
        $firstNameChars = str_split(str_pad($firstName, max(16, mb_strlen($firstName))));
        $middleNameChars = str_split(str_pad($middleName, max(11, mb_strlen($middleName))));
    @endphp

    <div class="max-w-5xl mx-auto px-4 py-1">

        <div class="text-xs leading-snug mb-1">
            <p class="font-semibold">Queue No: {{ $queue_number ?? '' }} | NCST Blood Donation</p>
            <p>NCST,
                {{ isset($preferred_date) && $preferred_date ? \Carbon\Carbon::parse($preferred_date)->format('F j, Y') : '' }},
                8:00 AM</p>
        </div>

        {{-- ===== HEADER ===== --}}
        <div class="flex items-center gap-2 mb-1">
            {{-- Logos --}}
            <img src="{{ asset('images/umc/institute.png') }}" alt="DLMHSI Logo" class="h-12 w-auto object-contain" />
            <img src="{{ asset('images/umc/umc.png') }}" alt="DLSUMC Logo" class="h-12 w-auto object-contain" />

            {{-- Hospital Info --}}
            <div class="flex flex-col leading-none gap-[2px]">
                <h1 class="text-[11px] font-extrabold uppercase tracking-wide text-black">
                    DE LA SALLE UNIVERSITY MEDICAL CENTER
                </h1>
                <p class="text-[8px] text-black italic">A service of De La Salle Medical and Health Sciences Institute
                </p>
                <p class="text-[9px] font-bold text-black">Blood Bank Section</p>
                <p class="text-[8px] text-black">City of Dasmariñas, Cavite, Philippines</p>
                <p class="text-[8px] text-black">Tel no. (046) 481-8000 loc. 1197</p>
            </div>
        </div>

        {{-- ===== LICENSE & TITLE ===== --}}
        <div class="text-center mb-1">
            <p class="text-[9px] font-semibold">License Number: 618</p>
            <p class="text-[11px] font-extrabold uppercase tracking-wide">PAUNAWA SA MGA MAGHAHANDOG NG DUGO</p>
            <p class="text-[11px] font-extrabold uppercase tracking-wide">(NOTICE TO ALL BLOOD DONORS)</p>
        </div>

        {{-- ===== NOTICE PARAGRAPHS ===== --}}
        <div class="text-[9px] leading-[1.3] text-justify mb-2 space-y-1 px-4">
            <p class="indent-8">
                May mga tao sa komunidad na hindi maaaring maghandog ng dugo, sa dahilang maaari silang makahawa ng
                impeksyon sa mga pasyenteng makatatanggap nito. Kinakailangang kumpletuhin ang mga sagot sa papeples na
                ito kung nais maghandog ng dugo. Kung hindi nalalaman kung paano sasagutan ang mga tanong ay maaaring
                kumunsulta sa kahit sinong tauhan ng DLSUMC Blood Bank.
            </p>
            <p class="indent-8">
                Ana ano mang maling pahayag o tugon sa mga sumusunod na katanungan ay labas sa batas. Kapag ito'y
                inyong ginawa, maaari kayong makatanggap ng mabigat na kaparusahan.
            </p>
            <p class="indent-8">
                (There are some people in the community who must not donate blood because it may transmit infections to
                patients who receive it. You must complete this form if you want to donate blood. If you do not know how
                to answer any of these questions, please check with interviewing DLSUMC Blood Bank personnel before
                answering the questions.
            </p>
            <p class="indent-8">
                It is against the law to knowingly make a false or misleading statement. If you do, you may receive a
                heavy penalty)
            </p>
        </div>

        {{-- ===== SECTION I: PERSONAL DATA ===== --}}
        <div class="mb-2">

            {{-- Section header row --}}
            <div class="flex items-center justify-between mb-1">
                <div class="font-extrabold text-[10px] uppercase">I.&nbsp;&nbsp;&nbsp;PERSONAL DATA</div>
                <div class="flex items-center gap-1 text-[9px]">
                    <span>Petsa (Date)</span>
                    <span class="border-b border-black w-36 inline-block">&nbsp;</span>
                </div>
            </div>

            {{-- Pangalan label --}}
            <div class="text-[9px] font-bold mb-[2px]" style="color:#00008B;">Pangalan:</div>

            {{-- Character grid for name --}}
            <div class="mb-[2px]">
                <div class="flex">
                    {{-- Surname --}}
                    @foreach ($surnameChars as $char)
                        <div
                            class="w-5 h-5 border border-black {{ $loop->last ? '' : 'border-r-0' }} flex items-center justify-center text-[8px] font-bold">
                            {{ trim($char) !== '' ? $char : '' }}
                        </div>
                    @endforeach
                    {{-- spacer --}}
                    <div class="w-3"></div>
                    {{-- First Name --}}
                    @foreach ($firstNameChars as $char)
                        <div
                            class="w-5 h-5 border border-black {{ $loop->last ? '' : 'border-r-0' }} flex items-center justify-center text-[8px] font-bold">
                            {{ trim($char) !== '' ? $char : '' }}
                        </div>
                    @endforeach
                    {{-- spacer --}}
                    <div class="w-3"></div>
                    {{-- Middle Name --}}
                    @foreach ($middleNameChars as $char)
                        <div
                            class="w-5 h-5 border border-black {{ $loop->last ? '' : 'border-r-0' }} flex items-center justify-center text-[8px] font-bold">
                            {{ trim($char) !== '' ? $char : '' }}
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Column labels --}}
            <div class="flex text-[8px] mb-2" style="color:#00008B;">
                <div class="w-[calc(16*1.25rem+0.5rem)] text-center font-bold">APELYIDO (Surname)</div>
                <div class="w-2"></div>
                <div class="w-[calc(16*1.25rem+0.5rem)] text-center font-bold">PANGALAN (Name)</div>
                <div class="w-2"></div>
                <div class="w-[calc(11*1.25rem)] text-center font-bold">MIDDLE NAME</div>
            </div>

            {{-- Two-column fields --}}
            <div class="grid grid-cols-2 gap-x-6 text-[9px]">

                {{-- LEFT COLUMN --}}
                <div class="flex flex-col gap-[3px]">
                    {{-- Edad & Kasarian --}}
                    <div class="flex gap-6">
                        <div>
                            <span style="color:#00008B;" class="font-semibold">Edad:</span>
                            <span
                                class="border-b border-black inline-block min-w-[4rem] px-1 font-medium">{{ $age }}</span>
                            <div style="color:#8B0000;" class="text-[8px]">(Age)</div>
                        </div>
                        <div>
                            <span style="color:#00008B;" class="font-semibold">Kasarian:</span>
                            <span
                                class="border-b border-black inline-block min-w-[4rem] px-1 font-medium">{{ $gender }}</span>
                            <div style="color:#8B0000;" class="text-[8px]">(Sex)</div>
                        </div>
                    </div>
                    {{-- Petsa ng Kaarawan --}}
                    <div>
                        <span style="color:#00008B;" class="font-semibold">Petsa ng Kaarawan:</span>
                        <span
                            class="border-b border-black inline-block min-w-[7rem] px-1 font-medium">{{ $birthdate }}</span>
                        <div style="color:#8B0000;" class="text-[8px]">(Birth Date)</div>
                    </div>
                    {{-- Tirahan --}}
                    <div>
                        <span style="color:#00008B;" class="font-semibold">Tirahan:</span>
                        <span
                            class="border-b border-black inline-block min-w-[10rem] px-1 font-medium">{{ $address }}</span>
                        <div style="color:#8B0000;" class="text-[8px]">(Address)</div>
                    </div>
                    {{-- Trabaho --}}
                    <div>
                        <span style="color:#00008B;" class="font-semibold">Trabaho:</span>
                        <span
                            class="border-b border-black inline-block min-w-[10rem] px-1 font-medium">{{ $occupation }}</span>
                        <div style="color:#8B0000;" class="text-[8px]">(Occupation)</div>
                    </div>
                    {{-- Lugar ng Trabaho --}}
                    <div>
                        <span style="color:#00008B;" class="font-semibold">Lugar ng Trabaho:</span>
                        <span
                            class="border-b border-black inline-block min-w-[8rem] px-1 font-medium">{{ $businessAddress }}</span>
                        <div style="color:#8B0000;" class="text-[8px]">(Bussiness Address)</div>
                    </div>
                    {{-- Pangalan ng Pasyente --}}
                    <div>
                        <span style="color:#00008B;" class="font-semibold">Pangalan ng Pasyente:</span>
                        <span class="border-b border-black inline-block w-28">&nbsp;</span>
                        <div style="color:#8B0000;" class="text-[8px]">(Patient's Name)</div>
                    </div>
                </div>

                {{-- RIGHT COLUMN --}}
                <div class="flex flex-col gap-[3px]">
                    {{-- Civil Status --}}
                    <div>
                        <span class="font-semibold">Civil Status:</span>
                        <span class="ml-2">Single</span>
                        <span
                            class="inline-flex items-center justify-center w-4 h-4 border border-black align-middle mx-1 text-[9px] font-bold">{{ $civilStatus === 'Single' ? '✓' : '' }}</span>
                        <span>Married</span>
                        <span
                            class="inline-flex items-center justify-center w-4 h-4 border border-black align-middle mx-1 text-[9px] font-bold">{{ $civilStatus === 'Married' ? '✓' : '' }}</span>
                        <span>Widow</span>
                        <span
                            class="inline-flex items-center justify-center w-4 h-4 border border-black align-middle mx-1 text-[9px] font-bold">{{ $civilStatus === 'Widow' ? '✓' : '' }}</span>
                    </div>
                    {{-- Cellphone No. --}}
                    <div>
                        <span class="font-semibold">Cellphone No.:</span>
                        <span
                            class="border-b border-black inline-block min-w-[9rem] px-1 font-medium">{{ $cellphone }}</span>
                    </div>
                    {{-- Lahi --}}
                    <div>
                        <span class="font-semibold">Lahi:</span>
                        <span
                            class="border-b border-black inline-block min-w-[11rem] px-1 font-medium">{{ $nationality }}</span>
                        <div class="text-[8px] text-gray-600">(Nationality)</div>
                    </div>
                    {{-- Telepono --}}
                    <div>
                        <span class="font-semibold">Telepono:</span>
                        <span
                            class="border-b border-black inline-block min-w-[10rem] px-1 font-medium">{{ $telephone }}</span>
                        <div class="text-[8px] text-gray-600">(Tel.No.)</div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ===== SECTION II: MEDICAL HISTORY ===== --}}
        <div class="mt-2">

            {{-- Section title --}}
            <div class="font-extrabold text-[10px] uppercase mb-[1px]">II.&nbsp;&nbsp;&nbsp;MEDICAL HISTORY:</div>

            {{-- Instruction lines --}}
            <div class="text-[9px] mb-[2px]">
                <span class="font-bold underline">TANDAAN</span><span>: MARKAHAN NG ( / ) <span
                        class="font-bold underline">CHECK</span> ANG MGA SAGOT SA MGA TANONG NA NAAAYON SA INYO.</span>
            </div>
            <div class="text-[9px] font-bold mb-1 underline">YES / NO PLEASE CHECK APPROPRIATE ANSWER</div>

            {{-- Table --}}
            <table class="w-full border-collapse border border-black text-[9px]">
                <thead>
                    <tr>
                        <th class="border border-black px-1 py-[2px] text-left font-normal w-full"></th>
                        <th class="border border-black px-2 py-[2px] text-center font-bold w-12">YES</th>
                        <th class="border border-black px-2 py-[2px] text-center font-bold w-12">NO</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Group header: Ikaw ba ay --}}
                    <tr class="bg-gray-100">
                        <td colspan="3" class="border border-black px-1 py-[2px] font-bold"
                            style="color:#00008B;">Ikaw ba ay:</td>
                    </tr>
                    {{-- Q1 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            1. Nasa mabuting kalusugan ngayon?<br>
                            <span class="italic">(Feeling healthy today?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q2 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            2. Naggagamot o may iniinom na medikasyon?<br>
                            <span class="italic">(Currently taking medication?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q3 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            3. Binakunahan laban sa beke, tigdas, hepatitis o polio nitong nakaraang taon?<br>
                            <span class="italic">(Have you receive any vaccination?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>

                    {{-- Group header: Tanong para sa babae --}}
                    <tr class="bg-gray-100">
                        <td colspan="3" class="border border-black px-1 py-[2px] font-bold"
                            style="color:#00008B;">Tanong para sa babae:</td>
                    </tr>
                    {{-- Q4 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            4. Ikaw ba ay nabuntis o buntis sa kasalukuyan o di kaya naman ay nakunan sa nakaraang 12
                            buwan?<br>
                            <span class="italic">(Have you been pregnant or are you pregnant now?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q5 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            5. Ikaw ba ay nawalan ng regla sa nakaraang anim (6) na lingo? Huling araw ng regla
                            <span class="border-b border-black inline-block w-24">&nbsp;</span><br>
                            <span class="italic">(Have you experience no menstruation for the past 6 months? Last
                                menstrual period
                                <span class="border-b border-black inline-block w-24">&nbsp;</span>)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>

                    {{-- Group header: Sa Nakaraang tatlong (3) araw --}}
                    <tr class="bg-gray-100">
                        <td colspan="3" class="border border-black px-1 py-[2px] font-bold"
                            style="color:#00008B;">Sa Nakaraang tatlong (3) araw:</td>
                    </tr>
                    {{-- Q6 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            6. Ikaw ba ay umiinom ng Aspirin o anumang gamot na may sangkap na Aspirin?<br>
                            <span class="italic">(Have you taken any aspirin or anything that has aspirin in
                                it?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>

                    {{-- Group header: Sa nakaraang labindalawang (12) lingo o 3 buwan --}}
                    <tr class="bg-gray-100">
                        <td colspan="3" class="border border-black px-1 py-[2px] font-bold"
                            style="color:#00008B;">Sa nakaraang labindalawang (12) lingo o 3 buwan:</td>
                    </tr>
                    {{-- Q7 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            7. Ikaw ba ay nakapag handog na ng dugo, platelets o plasma?<br>
                            <span class="italic">(Donated blood, platelet or plasma?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>

                    {{-- Group header: Sa nakaraang labindalawang (12) buwan o 1 taon --}}
                    <tr class="bg-gray-100">
                        <td colspan="3" class="border border-black px-1 py-[2px] font-bold"
                            style="color:#00008B;">Sa nakaraang labindalawang (12) buwan o 1 taon:</td>
                    </tr>
                    {{-- Q8 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            8. Ikaw ba ay nasalinan ng dugo?<br>
                            <span class="italic">(Had a Blood Transfusion?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q9 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            9. Ikaw ba ay naoperahan o nakapagpabunot ng ngipin sa dentista?<br>
                            <span class="italic">(Had surgical operation, dental extraction?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q10 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            10. Ikaw ba ay nagpatato, nagpabutas ng tainga, nagkaroon ng aksidenteng kontak sa dugo o
                            aksidenteng
                            natusok ng karayom o nagpa-acupuncture?<br>
                            <span class="italic">(Had a tattoo, ear or body piercing, accidental contact with blood,
                                needle-stick and acupuncture?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q11 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            11. Ikaw ba ay nakipagtalik na o may karanasan sa pakikipagtalik sa mga sex worker
                            (prostitute)<br>
                            <span class="italic">(Had sexual contact with high risk individuals?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q12 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            12. Ikaw ba ay may karanasan na sa pakikipagtalik na may kapalit na pera o anumang material
                            na bagay?<br>
                            <span class="italic">(Had sexual contact with anyone in exchange for material or monetary
                                gain?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q13 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            13. Ikaw ba ay nakipagtalik sa taong nakapag-trabaho na sa abroad?<br>
                            <span class="italic">(Had sexual contact with a person who has worked abroad?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q14 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            14. Ikaw ba ay nakipag-talik sa taong di mo asawa o kasalukuyang karelasyon?<br>
                            <span class="italic">(Engaged in casual sex?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q15 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            15. Ikaw ba ay may kasama sa bahay na may sakit na Hepatitis?<br>
                            <span class="italic">(Lived with a person who has hepatitis?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q16 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            16. Ikaw ba ay nakaranas ng makulong sa piitan?<br>
                            <span class="italic">(Have you been imprisoned?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q17 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            17. Mayroon ka bang kamag-anak na nagkaroon ng "Mad Cow Disease"?<br>
                            <span class="italic">(Have any of your relatives had Creutzfeldt Jakob (Mad Cow)
                                Disease?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>

                    {{-- Group header: Naranasan mo na bang --}}
                    <tr class="bg-gray-100">
                        <td colspan="3" class="border border-black px-1 py-[2px] font-bold"
                            style="color:#00008B;">Naranasan mo na bang:</td>
                    </tr>
                    {{-- Q18 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            18. Manirahan sa ibang lugar maliban sa kinagisnan mong bayan, probinsya o siyudad?<br>
                            <span class="italic">(Lived outside your place of residence?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q19 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            19. Manirahan sa ibang bansa?<br>
                            <span class="italic">(Lived outside the Philippines?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q20 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            20. Mag-iniksyon sa sarili ng gamot, steroids o anumang gamot na hindi inireseta ng
                            doktor?<br>
                            <span class="italic">(Used needles to take drugs, steroids or anything not prescribed by
                                your doctor?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q21 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            21. Gumamit ng "clotting factor concentrate".<br>
                            <span class="italic">(Used clotting factor concentrate?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>

                    {{-- Group header: Ikaw ba ay (2nd) --}}
                    <tr class="bg-gray-100">
                        <td colspan="3" class="border border-black px-1 py-[2px] font-bold"
                            style="color:#00008B;">Ikaw ba ay:</td>
                    </tr>
                    {{-- Q22 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            22. Nagkaroon na ng positibong pagsusuri sa AIDS?HIV, Hepatitis virus, Syphilis o
                            Malaria?<br>
                            <span class="italic">(Had a positive test for the HIV/AIDS virus, Hepatitis virus, Syphilis
                                or Malaria?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q23 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            23. Nagkaroon na ng Hepatitis?<br>
                            <span class="italic">(Had Hepatitis?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q24 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            24. Nagkaroon na ng Malaria?<br>
                            <span class="italic">(Had Malaria?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q25 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            25. Nagkaroon na at ginamot sa mga sakit na nakakahawa na nakukuha sa pamamagitan ng
                            pakikipag-<br>
                            talik (hal.kulugo sa maselang bahagi ng katawan, syphilis o tulo etc)<br>
                            <span class="italic">(Been told to have or treated for genital wart,syphilis, gonorrhea or
                                other sexually transmissible infections?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q26 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            26. Nagkaroon na ng kahit anumang uri ng kanser (kanser sa suso, leukemia, kanser sa baga,
                            etc)<br>
                            <span class="italic">(Had any type of cancer for example leukemia?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q27 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            27. Nagkaroon na ng sakit sa puso at baga?<br>
                            <span class="italic">(Had any problems with your heart and lungs?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q28 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            28. Nagkaroon na ng abnormal na pagdurugo sakit o impeksyon sa dugo?<br>
                            <span class="italic">(Had a bleeding condition or a blood disease?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q29 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            29. Ikaw ba ay naghahandog ng dugo dahil nais mo lang masuri ka sa Hepatitis virus o
                            HIV?<br>
                            <span class="italic">(Are you giving blood because you wanted to be tested for HIV or
                                Hepatitis virus?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                    {{-- Q30 --}}
                    <tr>
                        <td class="border border-black px-1 py-[1px]">
                            30. Alam mo ba na maaaring ka makasalin ng AIDS/Hepatitis mula sa iyong dugo kahit ikaw ay
                            walang
                            nararamdaman at negatibo sa HIV/Hepatitis.<br>
                            <span class="italic">(Know that if you have the AIDS/Hepatitis virus, you can give it to
                                someone else though you may feel well
                                and have a negative HIV/Hepatitis test?)</span>
                        </td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                        <td class="border border-black px-1 py-[1px] text-center"></td>
                    </tr>
                </tbody>
            </table>

            {{-- Consent paragraphs --}}
            <div class="text-[9px] leading-[1.3] text-justify mt-2 space-y-1">
                <p class="indent-8">
                    Ako ay kusang loob na nagbibigay ng dugo sa DLS-UMC Blood Bank upang magamit ng higit na
                    nangangailangan.
                    Pinahihintulutan ko sila na suriin ang aking dugo sa <strong>"Blood Type, Hepatitis B, Malaria,
                        Syphilis,
                        HIV 1 &amp; 2, at Hepatitis C virus"</strong>
                </p>
                <p class="italic indent-8">
                    (I am voluntary giving blood through DLSUMC Blood Bank to be used as decided by the blood bank. I
                    give them
                    the permission for detailed typing of my blood and the blood screening tests for Hepatitis B,
                    Malaria,
                    Syphilis, HIV 1 and 2 and Hepatitis C virus.)
                </p>
                <p class="indent-8">
                    Pinatutunayan ko sa abot ng aking kaalaman na pawing katotohanan ang aking isinagsot sa mga
                    nakalahad na
                    katanungan sa itaas at nauunawaan na ang mga pahayag ay mahalaga upang aking malaman kung ako ay
                    nararapat
                    na magbigay ng dugo. Ang ospital na ito at kasama ng mga tauhang bumbuo nito ay walang pananagutan
                    sa ano
                    mang maaaring mangyari sa pagbibigay ko ng dugo. Ako ay nangangako na hindi ako gagawa ng mabigat na
                    trabaho
                    sa araw ng pagbibigay ng dugo. Ako ay umaayon na ang dugo na aking inihandog ay pag-aari na ng
                    DLSUMC
                    Blood Bank.
                </p>
                <p class="italic indent-8">
                    (I certify that I have to the best of my knowledge, truthfully answered the above questions and
                    understand
                    that this information is important in determining whether I am acceptable as a blood donor. I
                    release the
                    hospital and its personnel from any liability that my results from this donation. I will not engage
                    in
                    strenuous activity on this day of donation).
                </p>
            </div>

            {{-- Signature of Donor --}}
            <div class="flex justify-end mt-3 mb-3 pr-4">
                <div class="text-center">
                    <div class="border-b border-black w-48 mb-1">&nbsp;</div>
                    <div class="text-[9px]">Lagda ng naghahandog ng dugo</div>
                    <div class="text-[9px]">(Signature of Donor)</div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="text-right text-[8px] italic mb-2">
                Effective July 06, 2023 | III-LABU-FR03-8
            </div>

            {{-- ===== SECTION III: PHYSICAL EXAMINATION ===== --}}
            <div class="mt-2 text-[9px]">
                <div class="font-extrabold text-[10px] uppercase mb-1">III. PHYSICAL EXAMINATION:</div>

                {{-- Weight / Height / Vital Signs / Tattoo / Earpiercing --}}
                <div class="grid grid-cols-2 gap-x-4 mb-1">
                    {{-- Left --}}
                    <div class="flex flex-col gap-[3px]">
                        <div class="flex items-center gap-2">
                            <span class="font-semibold">Weight:</span>
                            <span class="border-b border-black flex-1">&nbsp;</span>
                            <span class="font-semibold ml-4">Height:</span>
                            <span class="border-b border-black flex-1">&nbsp;</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="font-semibold whitespace-nowrap">Vital Signs:</span>
                            <div class="flex flex-col gap-[2px]">
                                <div class="flex items-center gap-2">
                                    <span>BP</span>
                                    <span class="border-b border-black w-24">&nbsp;</span>
                                    <span>PR</span>
                                    <span class="border-b border-black w-24">&nbsp;</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span>RR</span>
                                    <span class="border-b border-black w-24">&nbsp;</span>
                                    <span>Temp</span>
                                    <span class="border-b border-black w-20">&nbsp;</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Right --}}
                    <div class="flex flex-col gap-[4px]">
                        <div class="flex items-center gap-2">
                            <span class="font-semibold w-24">Tattoo:</span>
                            <span>( ) present</span>
                            <span class="ml-4">( ) absent</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-semibold w-24">Earpiercing:</span>
                            <span>( ) present</span>
                            <span class="ml-4">( ) absent</span>
                        </div>
                    </div>
                </div>

                {{-- Physical exam fields --}}
                <div class="grid grid-cols-2 gap-x-8 mt-1">
                    <div class="flex flex-col gap-[3px]">
                        <div class="flex items-center gap-1">
                            <span class="font-semibold w-28">SHEENT:</span>
                            <span class="border-b border-black flex-1">&nbsp;</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="font-semibold w-28">NECK &amp; LUNGS:</span>
                            <span class="border-b border-black flex-1">&nbsp;</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="font-semibold w-28">ABDOMEN:</span>
                            <span class="border-b border-black flex-1">&nbsp;</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-[3px]">
                        <div class="flex items-center gap-1">
                            <span class="font-semibold w-28">SCLERAE:</span>
                            <span class="border-b border-black flex-1">&nbsp;</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="font-semibold w-28">HEART:</span>
                            <span class="border-b border-black flex-1">&nbsp;</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="font-semibold w-28">EXTREMITIES:</span>
                            <span class="border-b border-black flex-1">&nbsp;</span>
                        </div>
                    </div>
                </div>

                {{-- Remarks --}}
                <div class="mt-2 flex items-start gap-2">
                    <span class="font-semibold whitespace-nowrap">REMARKS:</span>
                    <div class="flex flex-col gap-[2px]">
                        <div class="flex items-center gap-1">
                            <span>( )</span>
                            <span>Donor is physically fit:</span>
                            <span class="border-b border-black w-32">&nbsp;</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <span>( )</span>
                            <span>Donor is unfit to donate blood. Reason:</span>
                            <span class="border-b border-black w-28">&nbsp;</span>
                        </div>
                    </div>
                </div>

                {{-- Signature of Examiner --}}
                <div class="flex justify-end mt-3 pr-4">
                    <div class="text-center">
                        <div class="border-b border-black w-56 mb-1">&nbsp;</div>
                        <div class="text-[9px]">Signature of Examiner over printed name</div>
                    </div>
                </div>

            </div>

            {{-- ===== SECTION IV: INITIAL SCREENING ===== --}}
            <div class="mt-3 text-[9px]">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3 flex-1">
                        <span class="font-extrabold text-[10px] uppercase whitespace-nowrap">IV. INITIAL
                            SCREENING:</span>
                        <span class="font-semibold whitespace-nowrap">Hematocrit</span>
                        <span class="border-b border-black w-20">&nbsp;</span>
                        <span class="font-semibold whitespace-nowrap">Hemoglobin</span>
                        <span class="border-b border-black w-20">&nbsp;</span>
                        <span class="font-bold whitespace-nowrap">BLOOD TYTPE</span>
                        <span class="border-b border-black w-24">&nbsp;</span>
                    </div>
                    <div class="text-center whitespace-nowrap">
                        <div class="border-b border-black w-40 mb-1">&nbsp;</div>
                        <div class="font-bold text-[9px]">MEDTECH SIGNATURE</div>
                    </div>
                </div>
                <div class="flex flex-col gap-[2px] mt-1 ml-8">
                    <div class="flex items-center gap-1">
                        <span>( )</span>
                        <span>Donor is accepted for blood donation.</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span>( )</span>
                        <span>Donor is rejected to donate blood.&nbsp; Reason:</span>
                        <span class="border-b border-black w-36">&nbsp;</span>
                    </div>
                </div>
            </div>

            {{-- ===== SECTION V: FINAL SCREENING ===== --}}
            <div class="mt-3 text-[9px]">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3 flex-1">
                        <span class="font-extrabold text-[10px] uppercase whitespace-nowrap">V. FINAL SCREENING:</span>
                        <span class="font-semibold whitespace-nowrap">HBsAg</span>
                        <span class="border-b border-black w-14">&nbsp;</span>
                        <span class="font-semibold whitespace-nowrap">RPR</span>
                        <span class="border-b border-black w-14">&nbsp;</span>
                        <span class="font-semibold whitespace-nowrap">HCV</span>
                        <span class="border-b border-black w-14">&nbsp;</span>
                        <span class="font-semibold whitespace-nowrap">HIV</span>
                        <span class="border-b border-black w-14">&nbsp;</span>
                        <span class="font-semibold whitespace-nowrap">Malaria</span>
                        <span class="border-b border-black w-14">&nbsp;</span>
                    </div>
                    <div class="text-center whitespace-nowrap">
                        <div class="border-b border-black w-40 mb-1">&nbsp;</div>
                        <div class="font-bold text-[9px]">MEDTECH SIGNATURE</div>
                    </div>
                </div>
                <div class="flex flex-col gap-[2px] mt-1 ml-8">
                    <div class="flex items-center gap-1">
                        <span>( )</span>
                        <span>Donor is accepted for blood donation.</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span>( )</span>
                        <span>Donor is rejected to donate blood.&nbsp; Reason:</span>
                        <span class="border-b border-black w-36">&nbsp;</span>
                    </div>
                </div>
            </div>

            {{-- Final footer --}}
            <div class="text-right text-[8px] italic mt-3">
                Effective July 06, 2023 | III-LABU-FR03-8
            </div>

        </div>

    </div>

</body>

</html>

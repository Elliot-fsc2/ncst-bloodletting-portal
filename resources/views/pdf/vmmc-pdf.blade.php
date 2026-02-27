<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>VMMC Blood Donor Interview Data Sheet</title>
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      fontSize: { '6': '6pt', '7': '7pt', '8': '8pt', '9': '9pt', '10': '10pt', '11': '11pt' }
    }
  }
}
</script>
<style>
  .page { page-break-after: always; }
  .page:last-child { page-break-after: auto; }
  /* underline field helpers — always show border (form field line) */
  .uf    { display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; min-width:18mm; }
  .uf-xs { min-width:12mm; }
  .uf-sm { min-width:22mm; }
  .uf-md { min-width:34mm; }
  .uf-lg { min-width:54mm; }
  .uf-xl { min-width:72mm; }
  .uf-fw { display:block; width:100%; border-bottom:1px solid #000; min-height:5mm; }
  .bul   { display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; }
</style>
</head>
<body class="bg-white text-black font-sans text-[8pt]">

@php
    $p  = $data['personal']  ?? [];
    $h  = $data['history']   ?? [];
    $sa = $data['section_a'] ?? [];
    $sb = $data['section_b'] ?? [];
    $sc = $data['section_c'] ?? [];
    $sd = $data['section_d'] ?? [];
    $se = $data['section_e'] ?? [];

    $yy  = fn($v) => $v === 'yes' ? '✓' : '';
    $nn  = fn($v) => $v === 'no'  ? '✓' : '';
    $val = fn($v, $fb = '') => ($v ?? '') !== '' ? $v : $fb;


    $age = '';
    if (!empty($p['birthdate'])) {
        try { $age = \Carbon\Carbon::parse($p['birthdate'])->age; } catch(\Exception $e) {}
    }

    $logoPath = public_path('images/vmmc.png');
    $logoSrc  = file_exists($logoPath)
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
        : '';
@endphp

@php
function vmmc_hdr(string $logo, int $pg): string {
    return <<<HTML
<table class="w-full border-collapse border border-black mb-4 text-[8pt]">
  <tr>
    <td rowspan="3" class="w-[18mm] text-center border-r border-black p-1 align-middle">
      <img src="{$logo}" class="w-[15mm] h-[15mm] inline-block" alt="VMMC">
    </td>
    <td class="text-center border-r border-black px-2 py-1 align-middle">
      <div class="text-[10pt] font-bold">VETERANS MEMORIAL MEDICAL CENTER</div>
      <div class="text-[7.5pt]">North Avenue, Diliman, Quezon City</div>
    </td>
    <td class="w-[38mm] text-[7pt] align-top px-1.5 py-1 border-l border-black">
      <span class="text-[7pt]">Form No.:</span><br>
      <strong class="text-[7pt]">VMMC-MR-DOP _BB FORM 003</strong>
    </td>
  </tr>
  <tr>
    <td class="text-center border-r border-t border-black px-2 py-1 align-middle">
      <div class="text-[8.5pt] font-bold text-[#1a6b8a]">DEPARTMENT OF PATHOLOGY<br>BLOOD BANK UNIT</div>
    </td>
    <td class="w-[38mm] border-t border-black align-top">
      <table class="w-full h-full border-collapse text-[7pt]"><tr>
        <td class="border-r border-black px-1.5 py-1 align-top w-1/2"><strong>Rev. No.:</strong><br>01</td>
        <td class="px-1.5 py-1 align-top w-1/2"><strong>Page:</strong><br>{$pg} of 3</td>
      </tr></table>
    </td>
  </tr>
  <tr>
    <td class="text-center border-r border-t border-black px-2 py-1.5 align-middle">
      <div class="text-[11pt] font-bold">BLOOD DONOR INTERVIEW DATA SHEET</div>
    </td>
    <td class="w-[38mm] border-t border-black align-top">
      <table class="w-full h-full border-collapse text-[7pt]"><tr>
        <td class="border-r border-black px-1.5 py-1 align-top w-1/2"><strong>Issued By:</strong><br>DOP BB</td>
        <td class="px-1.5 py-1 align-top w-1/2"><strong>Date:</strong><br>October 2023</td>
      </tr></table>
    </td>
  </tr>
</table>
HTML;
}
@endphp

{{-- ═══════════════════════════════════════════════════════════ PAGE 1 --}}
<div class="page w-full">

  {!! vmmc_hdr($logoSrc, 1) !!}

  {{-- BARCODE BOX --}}
  <div class="border border-gray-400 rounded w-[52mm] h-[16mm] mx-auto my-2 flex items-center justify-center text-[7.5pt] text-gray-500 text-center">
    Place Barcode Sticker of<br>Donation ID no. here
  </div>

  {{-- Date / Serial / Blood Type --}}
  <table class="w-full border-collapse mb-1">
    <tr>
      <td class="w-1/3 text-center px-2 pb-0">
        <span class="block border-t border-black min-h-[5mm]">&nbsp;</span>
        <span class="block text-[7pt] text-gray-600 mt-0.5">Date</span>
      </td>
      <td class="w-1/3 text-center px-2 pb-0">
        <span class="block border-t border-black min-h-[5mm]">&nbsp;</span>
        <span class="block text-[7pt] text-gray-600 mt-0.5">Serial No</span>
      </td>
      <td class="w-1/3 text-center px-2 pb-0">
        <span class="block border-t border-black min-h-[5mm]">&nbsp;</span>
        <span class="block text-[7pt] text-gray-600 mt-0.5">Blood Type</span>
      </td>
    </tr>
  </table>

  {{-- Venue / Pilot tube / ID --}}
  <table class="w-full border-collapse mb-3">
    <tr>
      <td class="w-1/3 text-center px-2 pb-0">
        <span class="block border-t border-black min-h-[5mm]">&nbsp;</span>
        <span class="block text-[7pt] text-gray-600 mt-0.5">Venue</span>
      </td>
      <td class="w-1/3 text-center px-2 pb-0">
        <span class="block border-t border-black min-h-[5mm]">&nbsp;</span>
        <span class="block text-[7pt] text-gray-600 mt-0.5">Pilot tube</span>
      </td>
      <td class="w-1/3 text-center px-2 pb-0">
        <span class="block border-t border-black min-h-[5mm]">&nbsp;</span>
        <span class="block text-[7pt] text-gray-600 mt-0.5">Type of ID / ID no.</span>
      </td>
    </tr>
  </table>

  {{-- PERSONAL DATA --}}
  <div class="text-[9pt] font-bold mb-2">PERSONAL DATA:</div>

  {{-- NAME --}}
  <table class="w-full border-collapse mb-1.5">
    <tr>
      <td class="w-1/3 text-center px-2">
        <span class="block border-b border-black min-h-[5mm] text-[8pt]">{{ strtoupper($val($p['surname'] ?? '')) }}</span>
        <span class="block text-[7pt] font-bold text-center mt-0.5">SURNAME</span>
      </td>
      <td class="w-1/3 text-center px-2">
        <span class="block border-b border-black min-h-[5mm] text-[8pt]">{{ strtoupper($val($p['given_name'] ?? '')) }}</span>
        <span class="block text-[7pt] font-bold text-center mt-0.5">GIVEN NAME</span>
      </td>
      <td class="w-1/3 text-center px-2">
        <span class="block border-b border-black min-h-[5mm] text-[8pt]">{{ strtoupper($val($p['middle_name'] ?? '')) }}</span>
        <span class="block text-[7pt] font-bold text-center mt-0.5">MIDDLE NAME</span>
      </td>
    </tr>
  </table>

  {{-- DOB / AGE / CIVIL / OCCUPATION --}}
  <div class="mb-1.5 text-[8pt]">
    DATE OF BIRTH: <span class="uf uf-xs">{{ $val($p['birthdate'] ?? '') }}</span>
    &nbsp; AGE/SEX: <span class="uf uf-xs">{{ $age }}/{{ $val($p['sex'] ?? '') }}</span>
    &nbsp; CIVIL STATUS: <span class="uf uf-sm">{{ $val($p['civil_status'] ?? '') }}</span>
    &nbsp; OCCUPATION: <span class="uf uf-md">{{ $val($p['occupation'] ?? '') }}</span>
  </div>

  {{-- HOME ADDRESS --}}
  @php
    $fullAddress = collect([
      $p['house_no'] ?? '',
      $p['street']   ?? '',
      $p['subdivision'] ?? '',
      $p['barangay'] ?? '',
      $p['city_province'] ?? '',
    ])->filter()->implode(', ');
  @endphp
  <div class="mb-0.5 text-[8pt]">HOME ADDRESS:
    <!-- <span class="uf-fw">{{ $fullAddress }}</span> -->
  </div>
  <table class="w-full border-collapse text-[7pt] mb-1.5">
    <tr>
      <td class="w-[26%] text-center px-0.5">
        <span class="block border-b border-black min-h-[4mm]">{{ $val($p['house_no'] ?? '') }}</span>
        <span class="text-[7pt]">House no. &nbsp; Street</span>
      </td>
      <td class="w-[2%]"></td>
      <td class="w-[24%] text-center px-0.5">
        <span class="block border-b border-black min-h-[4mm]">{{ $val($p['subdivision'] ?? '') }}</span>
        <span class="text-[7pt]">Subdivision</span>
      </td>
      <td class="w-[2%]"></td>
      <td class="w-[22%] text-center px-0.5">
        <span class="block border-b border-black min-h-[4mm]">{{ $val($p['barangay'] ?? '') }}</span>
        <span class="text-[7pt]">Barangay</span>
      </td>
      <td class="w-[2%]"></td>
      <td class="w-[22%] text-center px-0.5">
        <span class="block border-b border-black min-h-[4mm]">{{ $val($p['city_province'] ?? '') }}</span>
        <span class="text-[7pt]">City/Province</span>
      </td>
    </tr>
  </table>

  {{-- EMAIL / CONTACT --}}
  <div class="mb-1.5 text-[8pt]">
    EMAIL ADD.: <span class="uf uf-lg">{{ $val($p['email'] ?? '') }}</span>
    &nbsp;&nbsp; CONTACT NUMBER: <span class="uf uf-md">{{ $val($p['contact_number'] ?? '') }}</span>
  </div>

  {{-- PATIENT / CATEGORY / WARD --}}
  <div class="mb-1.5 text-[8pt]">
    NAME OF PATIENT: <span class="uf uf-lg">&nbsp;</span>
    &nbsp; CATEGORY: <span class="uf uf-xs">&nbsp;</span>
    &nbsp; WARD/ROOM NO.: <span class="uf uf-xs">&nbsp;</span>
  </div>

  {{-- TYPE / METHOD --}}
  <div class="mb-1 text-[8pt]">Type of Donor: &nbsp;&nbsp;&nbsp; O Walk-in &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; O Mobile Blood Donation</div>
  <div class="mb-2.5 text-[8pt]">Method of Collection: &nbsp; O Conventional &nbsp;&nbsp;&nbsp; O Apheresis</div>

  {{-- MEDICAL HISTORY TABLE --}}
  <table class="w-full border-collapse border border-black text-[7.5pt]">
    <thead>
      <tr>
        <th colspan="2" class="text-left px-1.5 py-0.5 font-normal bg-gray-100 border border-black text-[8pt]">
          <strong>MEDICAL HISTORY:</strong> &nbsp; Check your answer (<em>Markahan ng (✓) ang inyong sagot</em>)
        </th>
        <th class="w-[11mm] text-center text-[7pt] bg-gray-100 border border-black">YES<br>(OO)</th>
        <th class="w-[11mm] text-center text-[7pt] bg-gray-100 border border-black">NO<br>(HINDI)</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">1.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Have you donated blood before? If yes, indicate the date and place of last donation.<br>
          <em class="text-[7pt]">Nakapagbigay ka na ba ng dugo? Kung oo, isulat kung saan at kalian ang huling donasyon.
          @if(($h['donated_before'] ?? '') === 'yes' && ($h['last_donation_info'] ?? ''))
            <br><strong>Last donation:</strong> {{ $h['last_donation_info'] }}
          @endif
          </em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($h['donated_before'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($h['donated_before'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">2.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Have you ever donated or attempted to donate blood using different (or another) name here or elsewhere?<br>
          <em class="text-[7pt]">Nakapagbigay ka na ba ng dugo na gumamit ng ibang pangalan dito o sa ibang lugar?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($h['used_different_name'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($h['used_different_name'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">3.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Have you for any reason been deferred as a blood donor or told not to donate blood?<br>
          <em class="text-[7pt]">Ikaw ba ay hindi natanggap o nasabihan na hindi puwedeng magbigay ng dugo sa ano mang dahilan?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($h['deferred_before'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($h['deferred_before'] ?? '') }}</td>
      </tr>

      {{-- SECTION A --}}
      <tr>
        <td colspan="4" class="bg-[#e0e0e0] font-bold text-[7.5pt] px-2 py-0.5 border border-black">
          SECTION A. KONDISYON SA NAKARAANG 18 NA BUWAN
        </td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">1.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Have you within the last eighteen (18) months had any of the following: high blood pressure, night sweats, unexplained fevers, unexplained weight loss, persistent diarrhea, enlarged lymph node?<br>
          <em class="text-[7pt]">Sa nakaraang labing-walong (18) buwan, nagkaroon o nakaranaska ba ng isa sa mga sumusunod: alta-presyon, pagpapawis sa gabi, hindi maipaliwanag na lagnat, madalas na pagdumi, malakingkulani?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sa['symptoms'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sa['symptoms'] ?? '') }}</td>
      </tr>

      {{-- SECTION B --}}
      <tr>
        <td colspan="4" class="bg-[#e0e0e0] font-bold text-[7.5pt] px-2 py-0.5 border border-black">
          SECTION B. KONDISYON SA NAKARAANG 12 NA BUWAN
        </td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">1.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Any of the following (ENCIRCLE): malaria, hepatitis, jaundice, syphilis, chicken pox, shingles, cold sores,serious accident, cancer, blood disease like leukemia, recent or severe respiratory disease, cardiovascular disease, kidney disease, syphilis, diabetes, asthma, epilepsy, tuberculosis?<br>
          <em class="text-[7pt]">Nagkaroon o nakaranas sa mga sumusunod: malarya, sakit sa atay, paninilaw ng mga mata at buong katawan, tulo, bulutong tubig, singaw, malubhang aksidente, kanser, sakit sa dugo tulad ng leukemia o walang tigil na pagdurugo, sakit sa baga, sakit sa puso, sakit sa bato, syphilis, dyabetis, hika, epilepsy, tuberculosis?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sb['diseases'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sb['diseases'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">2.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Under doctor's care or had a major illness or surgery?<br>
          <em class="text-[7pt]">Nasa pangangalaga ng doctor o nagkaroon ng malubhang karamdaman o operasyon?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sb['doctor_care'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sb['doctor_care'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">3.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Have you ever had a dental surgery for the past twelve (12) months or tooth extraction for the past six (6) months?<br>
          <em class="text-[7pt]">Naoperahan ka ba ng ngipin sa nakaraang labindalawang (12) buwan? O Nagpabunot ka ba ng ngipin simula nitong nakaraang anim (6) na buwan?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sb['dental'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sb['dental'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">4.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Taken prohibited drugs? (orally, by nose or injection)<br>
          <em class="text-[7pt]">Nakagamit ng mga ipinagbabawal na gamut? (ininum, siningof "cocaine" o naitusok ng karayom)</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sb['drugs'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sb['drugs'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">5.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Received blood or taken clotting factor concentrates for bleeding problem such as hemophilia and had an organ or tissue transplant or graft?
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sb['transplant'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sb['transplant'] ?? '') }}</td>
      </tr>
    </tbody>
  </table>

  <div class="text-right text-[7pt] text-gray-500 mt-2">Page 1 of 3</div>
</div>
{{-- ═══════════════════════════════════════════════════════ END PAGE 1 --}}


{{-- ═══════════════════════════════════════════════════════════ PAGE 2 --}}
<div class="page w-full">

  {!! vmmc_hdr($logoSrc, 2) !!}

  <table class="w-full border-collapse border border-black text-[7.5pt]">
    <thead>
      <tr>
        <th class="w-[5mm] border border-black bg-gray-100"></th>
        <th class="text-left border border-black bg-gray-100"></th>
        <th class="w-[11mm] text-center text-[7pt] bg-gray-100 border border-black">YES<br>(OO)</th>
        <th class="w-[11mm] text-center text-[7pt] bg-gray-100 border border-black">NO<br>(HINDI)</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">5.</td>
        <td class="align-top border border-black px-1 py-0.5">
          <em class="text-[7pt]">Ikaw ba ay hindi nasalinan ng dugo dahil sa hemophilia at naoperahan o nabigyan ng bahagi ng katawan na galing sa ibang tao?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sb['transplant'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sb['transplant'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">6.</td>
        <td class="align-top border border-black px-1 py-0.5">
          A tattoo applied, ear piercing, acupuncture, accidental needle stick or come in contact with someone else's blood?<br>
          <em class="text-[7pt]">Nagpalagay ng tattoo, nagpabutas sa tenga, nagpa-akyupuncture, naturukan ng karayom nang hindi sinasadya o nadikit sa dugo ng ibang tao?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sb['tattoo'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sb['tattoo'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">7.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Engaged in sexual activity on the same sex or multiple sexual partners?<br>
          <em class="text-[7pt]">Nagkaroon ng karanasan na nakipagtalik sa kaparehong kasarian (lalaki sa lalaki, babae sa babae) o higit pa sa isa ang naging katalik</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sb['sex_multi'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sb['sex_multi'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">8.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Engaged in sexual activity with an individual who received an injection without proper medical supervision?<br>
          <em class="text-[7pt]">Nagkaroon ng karanasan sa taong naturukan ng gamot na walang pahintulot ng doktor?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sb['sex_unsupervised'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sb['sex_unsupervised'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">9.</td>
        <td class="align-top border border-black px-1 py-0.5">
          In personal contact with anyone who had hepatitis?<br>
          <em class="text-[7pt]">May nakasama sa bahay o taong lagi mong nakakahalubilo na may sakit sa atay?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sb['hepatitis_contact'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sb['hepatitis_contact'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">10.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Given money or drugs to anyone to have sex with you or had sex with anyone who has taken money or drugs for sex?<br>
          <em class="text-[7pt]">Nagbigad bahagi kanito para lang makipagtalik sa iyo o nakipagtalik kahit kanino ne tumatanggap ng pera o ng ipinagbabawal na gamot para lang makipag talik sa isang tao?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sb['sex_money'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sb['sex_money'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">11.</td>
        <td class="align-top border border-black px-1 py-0.5">
          A sexual partner who is bisexual or medically unsupervised user of intravenous drug, who had taken clotting factor concentrates for bleeding problem and has HIV or had a positive test for HIV virus?<br>
          <em class="text-[7pt]">Nagkaroon ka ba ng kasintahan na nakikipagtalik sa kaparehong kasarian at gumagamit ng gamot na walang pahintulot ng doktor?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sb['sex_bisexual'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sb['sex_bisexual'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">12.</td>
        <td class="align-top border border-black px-1 py-0.5">
          To malaria endemic areas like Palawan and Mindoro?<br>
          <em class="text-[7pt]">Nakapunta sa lugar na laganap ang malaria katulad ng Palawan at Mindoro?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sb['malaria_area'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sb['malaria_area'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">13.</td>
        <td class="align-top border border-black px-1 py-0.5">
          In jail or prison?<br>
          <em class="text-[7pt]">Nakulong o nabilanggo?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sb['jail'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sb['jail'] ?? '') }}</td>
      </tr>

      {{-- SECTION C --}}
      <tr>
        <td colspan="4" class="bg-[#e0e0e0] font-bold text-[7.5pt] px-2 py-0.5 border border-black">
          SECTION C. KONDISYON SA NAKARAANG 4 NA LINGGO
        </td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">1.</td>
        <td class="align-top border border-black px-1 py-0.5">
          In the past four weeks, have you taken any medications such as Isotretinoin (Accutane) or Finasteride (Proscar, Propecia), etretinate (Tegison) for psoriasis, Feldene, aspirin other medicines?<br>
          <em class="text-[7pt]">Sa nakaraang apat na lingo, ikaw ba ay nakainom ng as Isotretinoin (Accutane) or Finasteride (Proscar, Propecia), Etretinate (Tegison) para sa psoniasis, Feldene, aspirin o kahit anong gamot?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sc['meds'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sc['meds'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">2.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Have you ever received human pituitary-derived growth hormone or had a brain covering graft?<br>
          <em class="text-[7pt]">Ikaw ba ay tumanggap ng "human pituitary-derived growth hormone" o naoperahan na sa uttak?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sc['growth_hormone'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sc['growth_hormone'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">3.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Have you within the last twenty-four (24) hours had an intake of alcohol?<br>
          <em class="text-[7pt]">Nainom ka ba ng alak sa nakaraang dalawampu't apat (24) na oras</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sc['alcohol'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sc['alcohol'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">4.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Do you intend to ride/pilot an airplane within twenty-four (24) hours or tend to drive a heavy or any transport vehicle within the next twelve (12) hours?<br>
          <em class="text-[7pt]">Ikaw ba ay may balak na sumakay/magpailipas ng eroplano na susunod na dalawangpu't apat na oras o may balak na magmaneho ng sasakyan na susunod na labindalawang oras?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sc['pilot_driver'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sc['pilot_driver'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">5.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Are you currently suffering from illness, allergy, or any infectious disease?<br>
          <em class="text-[7pt]">Sa kasalukuyan, ikaw ba ay may karamdaman, nakahahawang sakit tulad ng sipon, nakararanas ng pangangati (allergy), trangkaso, o pananakit ng lalamunan?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sc['illness'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sc['illness'] ?? '') }}</td>
      </tr>

      {{-- SECTION D --}}
      <tr>
        <td colspan="4" class="bg-[#e0e0e0] font-bold text-[7.5pt] px-2 py-0.5 border border-black">
          SECTION D. COVID-19
        </td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">1.</td>
        <td class="align-top border border-black px-1 py-0.5">
          In the past 28 days, have you travelled outside the Philippines? If yes, indicate the country/ies.<br>
          <em class="text-[7pt]">Sa nakalipas na dalawangpu't walong araw, ikaw ba ay nag biyahe sa labas ng Pilipinas? Kung Oo, isaad kung anung bansa o mga bansa.</em>
          @if(($sd['travel_intl'] ?? '') === 'yes' && ($sd['travel_countries'] ?? ''))
            <br><strong>Country/ies:</strong> {{ $sd['travel_countries'] }}
          @endif
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sd['travel_intl'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sd['travel_intl'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">2.</td>
        <td class="align-top border border-black px-1 py-0.5">
          In the past 28 days, have you ever had close contact (live with, worked with, travelled with or cared for) a confirmed COVID-19 patient<br>
          <em class="text-[7pt]">Sa nakalipas na dalawangpu't walong araw, ikaw ba ay may nakasalamuha (kasama sa bahay, katrabaho, nakasabay sa biyahe) na isang COVID-19 patient?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sd['covid_contact'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sd['covid_contact'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">3.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Have you ever had close contact with a person exhibiting symptoms of acute respiratory illness?<br>
          <em class="text-[7pt]">May nakasalamuha na may sintomas ng ubo, sipon, lagnat o acute respiratory illness?</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sd['symptoms_contact'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sd['symptoms_contact'] ?? '') }}</td>
      </tr>
      <tr>
        <td class="w-[5mm] align-top border border-black px-1 py-0.5">4.</td>
        <td class="align-top border border-black px-1 py-0.5">
          Have you received vaccine against COVID-19? If Yes, kindly indicate the date and type of vaccine.<br>
          <em class="block text-[7pt] mb-1">Ikaw ba ay nakatanggap na ng bakuna laban sa COVID-19? Kung Oo, Kailan at anong bakuna ito.</em>
          @if(($sd['vaccine_received'] ?? '') === 'yes')
            <span class="uf uf-xl">{{ $val($sd['vaccine_details'] ?? '') }}</span>
            @if($sd['vaccine_date'] ?? '')
              &nbsp;<strong>Date:</strong> {{ $sd['vaccine_date'] }}
            @endif
          @else
            <span class="uf uf-xl">&nbsp;</span>
          @endif
          <br>
          <em class="text-[7pt]">Ikaw ba ay nakatanggap na ng bakuna laban sa COVID-19? Kung Oo, Kailan at anong bakuna ito.</em>
        </td>
        <td class="text-center align-middle border border-black">{{ $yy($sd['vaccine_received'] ?? '') }}</td>
        <td class="text-center align-middle border border-black">{{ $nn($sd['vaccine_received'] ?? '') }}</td>
      </tr>

      {{-- SECTION E --}}
      <tr>
        <td colspan="4" class="bg-[#e0e0e0] font-bold text-[7.5pt] px-2 py-0.5 border border-black">
          SECTION E. FEMALE DONORS (PARA SA MGA KABABAIHAN)
        </td>
      </tr>
      <tr>
        <td colspan="4" class="border border-black px-1.5 py-1 text-[7.5pt]">
          1. When was your last delivery? <span class="uf uf-sm">{{ $val($se['delivery'] ?? '') }}</span>
          &nbsp;&nbsp; When was your last menstruation? <span class="uf uf-sm">{{ $val($se['menstruation'] ?? '') }}</span><br>
          <em>Kailan ka huling nanganak? <span class="uf uf-sm">&nbsp;</span>
          &nbsp;&nbsp; Kailan ka huling dinatnan/hiregia? <span class="uf uf-sm">&nbsp;</span></em>
        </td>
      </tr>
    </tbody>
  </table>

  <div class="text-right text-[7pt] text-gray-500 mt-2">Page 2 of 3</div>
</div>
{{-- ═══════════════════════════════════════════════════════ END PAGE 2 --}}


{{-- ═══════════════════════════════════════════════════════════ PAGE 3 --}}
<div class="page w-full">

  {!! vmmc_hdr($logoSrc, 3) !!}

  {{-- CONSENT --}}
  <div class="text-[9pt] font-bold mb-2">CONSENT</div>

  <div class="text-[7.5pt] leading-snug mb-2 text-justify">
    &ldquo;I have read this form and understand its content and voluntarily give my consent for the collection, use, processing, storage and retention of my personal data or information to OPERATION LIFELINE &ndash; VMMC for the purpose described in this document. I also understand that my consent does not prevent the existence of other criteria for lawful processing of personal data and does not waive any of my rights under RA 10173- Data Privacy Act of 2012 and other applicable laws.
  </div>
  <div class="text-[7.5pt] leading-snug mb-2 text-justify ml-8">
    It is my free and voluntary act and deed to donate my blood and I am aware of its risks and consequences during and after extraction having been explained to me in clear and understandable language and dialect that I speak.&rdquo;<br>
    &ldquo;I understand that my blood will be screened for blood type, hemoglobin, malaria, syphilis, hepatitis B &amp; C, and HIV 1 &amp; 2 and no result will be issued to me. If found reactive, I agree to be referred to the appropriate facility for counseling and further management. I certify that I have to the best of my knowledge, truthfully answered the above questions.&rdquo;
  </div>
  <div class="text-[7.5pt] leading-snug mb-2 text-justify italic">
    &ldquo;Nagpapatunay na ako ang taong tinutukoy at ang lahat ng nakesulaot dito ay nabasa ko at naliintindihan at ako ay kusang loob na magbibigay ng dugo. Alam ko ang mga panganib at mga sandaling kinukuhanan ako ng dugo hanggang sa matapos ang donasyon. Ito ay naipaliwanag sa akin at naliintindihan ko nang mabuti.&rdquo;<br>
    &ldquo;Pagkatapos masagutan nang buong katapatan ang mga tanong, ako yust at buong loob na magbibigay ng dugo sa OPERATION LIFELINE &ndash; VMMC. Naliintindihan ko na ang aking dugo ay susuriin nang mabuti upang malaman ang blood type, hemoglobin, malaria, syphilis, hepatitis B at C, at HIV 1 at 2 at walang opisyal na resulta ang ibibigay sa akin. Kung sakaling maging "reactive", ako ay sumasang-ayon na maisangguni sa nararapat na pasilidad para sa karagdagang pagsusuri.&rdquo;
  </div>

  <div class="mt-6 text-center">
    <div class="border-b border-black w-[65mm] mx-auto">&nbsp;</div>
    <div class="text-[7.5pt] mt-0.5">(Donor's Signature/ <em>Lagda ng magbibigay donasyon</em>)</div>
  </div>

  {{-- FOR BLOOD BANK USE ONLY --}}
  <div class="text-[10pt] font-bold text-center underline my-3">FOR BLOOD BANK USE ONLY</div>

  <div class="text-[9pt] font-bold mb-2">PHYSICAL EXAMINATION:</div>

  <table class="w-full border-collapse mb-1.5 text-[7.5pt]">
    <tr>
      <td class="w-[28%] pb-0.5">Body Weight: <span class="bul min-w-[18mm]">&nbsp;</span></td>
      <td class="w-[28%] pb-0.5">Blood Pressure: <span class="bul min-w-[16mm]">&nbsp;</span></td>
      <td class="w-[22%] pb-0.5">Pulse Rate: <span class="bul min-w-[14mm]">&nbsp;</span></td>
      <td class="w-[22%] pb-0.5">Temperature: <span class="bul min-w-[12mm]">&nbsp;</span></td>
    </tr>
  </table>
  <table class="w-full border-collapse mb-1.5 text-[7.5pt]">
    <tr>
      <td class="w-[40%]">General Appearance: <span class="bul min-w-[28mm]">&nbsp;</span></td>
      <td class="w-[60%]">Skin: <span class="bul min-w-[58mm]">&nbsp;</span></td>
    </tr>
  </table>
  <table class="w-full border-collapse mb-2.5 text-[7.5pt]">
    <tr>
      <td class="w-[40%]">HEENT: <span class="bul min-w-[48mm]">&nbsp;</span></td>
      <td class="w-[60%]">Heart and Lungs: <span class="bul min-w-[60mm]">&nbsp;</span></td>
    </tr>
  </table>

  <div class="text-[8pt] font-bold mb-1.5">REMARKS:</div>
  <div class="text-[7.5pt] mb-3 ml-5 leading-loose">
    O Accepted<br>
    O Temporarily Deferred<br>
    O Permanently Deferred
  </div>

  <table class="w-full border-collapse mb-4 text-[7.5pt]">
    <tr>
      <td class="w-[13%] text-[8pt]">Reason:</td>
      <td><span class="block border-b border-black min-h-[5mm]">&nbsp;</span></td>
    </tr>
  </table>

  <table class="w-full border-collapse mb-8 text-[7.5pt]">
    <tr>
      <td class="w-1/2">&nbsp;</td>
      <td class="w-1/2 text-center">
        <span class="block border-b border-black w-[65mm] mx-auto">&nbsp;</span>
        <span class="text-[7.5pt]">Examining Physician/Nurse<br>(Signature over printed name)</span>
      </td>
    </tr>
  </table>

  <div class="text-[8pt] mb-1">Screened by:</div>
  <table class="w-full border-collapse mb-3 text-[7.5pt]">
    <tr>
      <td class="w-[35%] align-top leading-loose">
        Hemoglobin: <span class="bul min-w-[28mm]">&nbsp;</span><br>
        Hematocrit: <span class="bul min-w-[28mm]">&nbsp;</span><br>
        Malaria &nbsp;: &nbsp;&nbsp;<span class="bul min-w-[28mm]">&nbsp;</span><br>
        Platelet Count: <span class="bul min-w-[20mm]">&nbsp;</span><br>
        WBC Count: <span class="bul min-w-[24mm]">&nbsp;</span>
      </td>
      <td class="w-[65%] align-top pl-3 leading-loose">
        <span class="block border-b border-black min-h-[5mm]">&nbsp;</span>
        <span class="block border-b border-black min-h-[5mm]">&nbsp;</span>
        <span class="block border-b border-black min-h-[5mm]">&nbsp;</span>
        <span class="block border-b border-black min-h-[5mm]">&nbsp;</span>
        <span class="block border-b border-black min-h-[5mm]">&nbsp;</span>
      </td>
    </tr>
  </table>

  <table class="w-full border-collapse mt-4 text-[7.5pt]">
    <tr>
      <td class="w-1/2 align-top leading-loose">
        <strong>PHLEBOTOMIST</strong> (print name &amp; sign)<br>
        <span class="block border-b border-black min-w-[60mm]">&nbsp;</span>
        Time Started: <span class="bul min-w-[28mm]">&nbsp;</span><br>
        Time Finished: <span class="bul min-w-[26mm]">&nbsp;</span>
      </td>
      <td class="w-1/2 align-top leading-loose">
        Remarks:<br>
        Sufficient Collection: &nbsp;( &nbsp;&nbsp; ) <span class="bul min-w-[18mm]">&nbsp;</span> mL<br>
        Insufficient Collection: ( &nbsp;&nbsp; ) <span class="bul min-w-[18mm]">&nbsp;</span> mL
      </td>
    </tr>
  </table>

  <div class="text-[8pt] mt-3">
    Blood Bag Used: ( &nbsp;&nbsp; ) Single Bag &nbsp;&nbsp; ( &nbsp;&nbsp; ) Double Bag &nbsp;&nbsp; ( &nbsp;&nbsp; ) Triple Bag
  </div>

  <div class="text-right text-[7pt] text-gray-500 mt-2">Page 3 of 3</div>
</div>
{{-- ═══════════════════════════════════════════════════════ END PAGE 3 --}}

</body>
</html>

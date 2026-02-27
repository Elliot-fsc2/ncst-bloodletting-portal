<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        @livewireStyles
    </head>
    <body class="antialiased min-h-screen relative [background:linear-gradient(135deg,#fff0f0_0%,#ffe4e4_50%,#fecaca_100%)] before:content-[''] before:fixed before:inset-0 before:bg-[radial-gradient(circle,rgba(220,38,38,0.07)_1px,transparent_1px)] before:bg-size-[26px_26px] before:pointer-events-none before:z-0">
        <div class="relative z-10 flex min-h-screen flex-col items-center justify-center gap-4 p-6 md:p-10">
            <div class="flex w-full max-w-3xl flex-col gap-4">

                {{-- Blood Donation Header --}}
                <div class="flex flex-col items-center gap-2">
                    <div class="flex items-center justify-center size-14 rounded-full shrink-0 [background:linear-gradient(135deg,#ef4444,#b91c1c)] [box-shadow:0_4px_18px_rgba(220,38,38,0.4)]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-6 h-6">
                            <path d="M12 2C12 2 5 10.5 5 15a7 7 0 0 0 14 0C19 10.5 12 2 12 2z"/>
                        </svg>
                    </div>
                    <span class="text-[0.68rem] font-medium tracking-[0.06em] uppercase text-red-400">Voluntary Blood Donation Registration</span>
                </div>

                {{-- Main slot --}}
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>

                <p class="text-center text-[0.7rem] mt-2">
                    Your information is kept confidential and used only for blood donation purposes.
                </p>

            </div>
        </div>
        @livewireScripts
        @fluxScripts
    </body>
</html>

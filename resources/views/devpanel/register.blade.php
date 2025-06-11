<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="w-100 h-full flex flex-col justify-center items-center p-4">
            <h1 class="font-bold text-2xl">Maak Developer Account</h1>
            <form method="POST" class="flex flex-col justify-center items-center gap-5 mt-10 mb-10" action="{{ route('dev.register') }}">
                @csrf
                <div class="flex flex-col relative">
                <label class="bg-white w-min pl-1 pr-1 -top-3.5 left-1.5 absolute" for="email">Email</label>
                <input class="rounded-md border-slate-400" name="email" value="{{ old('email') ?? '' }}">
                </div>
                <div class="flex flex-col relative">
                <label class="bg-white w-min pl-1 pr-1 -top-3.5 left-1.5 absolute" for="password">Wachtwoord</label>
                <input type="text" class="rounded-md border-slate-400" name="password" value="{{ old('password') ?? '' }}">
                </div>
                <input type="submit" class="border-slate-400 border-[0.5px] p-2 rounded-md" value="Maak Account">
            </form>

            <h1>API Key wordt hieronder weergeven wanneer er een account wordt gemaakt</h1>
            <h2>Sla deze API Key ergens goed op, je kunt hem niet opnieuw bekijken!</h2>
            <div class="relative mt-5">
                <input id="outputToken" type="text" class="relative border-slate-400 border-[0.5px] p-2 rounded-md w-[35rem]" readonly name="outputToken" value="{{ session('API_KEY') ?? '' }}">
                <div class="absolute right-2 top-1/2 -translate-y-1/2 cursor-pointer" id="copy-icon-div">
                    <svg  id='Copy_24' width='32' height='32' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' stroke='none' fill='#ffffff' opacity='0'/>
                        <g transform="matrix(0.8 0 0 0.8 12 12)" >
                            <path id="copy-icon-path" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: #2c2e30; fill-rule: nonzero; opacity: 1;" transform=" translate(-15, -14.5)" d="M 11 2 C 9.895 2 9 2.895 9 4 L 9 20 C 9 21.105 9.895 22 11 22 L 24 22 C 25.105 22 26 21.105 26 20 L 26 8.5 C 26 8.235 25.895031 7.9809687 25.707031 7.7929688 L 20.207031 2.2929688 C 20.019031 2.1049687 19.765 2 19.5 2 L 11 2 z M 19 3.9042969 L 24.095703 9 L 20 9 C 19.448 9 19 8.552 19 8 L 19 3.9042969 z M 6 7 C 4.895 7 4 7.895 4 9 L 4 25 C 4 26.105 4.895 27 6 27 L 19 27 C 20.105 27 21 26.105 21 25 L 21 24 L 11 24 C 8.794 24 7 22.206 7 20 L 7 7 L 6 7 z" stroke-linecap="round" />
                        </g>
                    </svg>

                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('API_KEY'))
                <h1 class="text-green-400">
                    Account succesvol aangemaakt.
                </h1>
            @endif
        </div>
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    </head>

   <body class="font-sans antialiased">
        <div class="min-h-screen bg-coyos-darkbrown">
            @livewire('navigation-dropdown')

            <!-- Page Heading -->
            <header class="bg-coyos-lightbrown shadow">
                {{-- <header class="bg-white shadow"> --}}
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header?? '' }}
                    </div>
            </header>

            <!-- Page Content -->
            <main class="mx-5 my-6">
                <div class=" md:w-1/2 sm:w-full sm:min-w-max-content p-4 mx-auto border  border-yellow-200 border-solid rounded-md justify-self-center">
                    <h1 class="text-black ">QR Delivery</h1>
                    <h2 class="text-xl font-semibold leading-tight text-gray-800">
                        {{ __('Leer el QR del Pedido del Cliente') }}
                    </h2>

                    <div class="mx-auto half-width flex  flex-col justify-self-center">
                        <video width="800" height="600" id="preview" playsinline autoplay></video>
                        <h3 id="ordenH3">ORDEN:???</h3>
                        <select id="select">
                        </select>
                        <button id="button">Seleccionar</button>
                        <script type="text/javascript">
                            const video = document.getElementById('preview');
                            const button = document.getElementById('button');
                            const select = document.getElementById('select');
                            let currentStream;

                            function stopMediaTracks(stream) {
                            stream.getTracks().forEach(track => {
                                track.stop();
                            });
                            }

                            function playMediaTracks(stream){
                                stream.getTracks().forEach(track=>{
                                    track.play();
                                });
                            }

                            function gotDevices(mediaDevices) {
                            select.innerHTML = '';
                            select.appendChild(document.createElement('option'));
                            let count = 1;
                            mediaDevices.forEach(mediaDevice => {
                                if (mediaDevice.kind === 'videoinput') {
                                const option = document.createElement('option');
                                option.value = mediaDevice.deviceId;
                                const label = mediaDevice.label || `Camera ${count++}`;
                                const textNode = document.createTextNode(label);
                                option.appendChild(textNode);
                                select.appendChild(option);
                                }
                            });
                            }

                            button.addEventListener('click', event => {
                            if (typeof currentStream !== 'undefined') {
                                stopMediaTracks(currentStream);
                            }
                            const videoConstraints = {};
                            if (select.value === '') {
                                videoConstraints.facingMode = 'environment';
                            } else {
                                videoConstraints.deviceId = { exact: select.value };
                            }
                            const constraints = {
                                video: videoConstraints,
                                audio: false
                            };
                            navigator.mediaDevices
                                .getUserMedia(constraints)
                                .then(stream => {
                                currentStream = stream;
                            //     playMediaTracks(currentStream);
                                video.srcObject = stream;
                                video.playsInline = true;
                                return navigator.mediaDevices.enumerateDevices();
                                })
                                .then(gotDevices)
                                .catch(error => {
                                console.error(error);
                                });
                            });

                            navigator.mediaDevices.enumerateDevices().then(gotDevices);
                        </script>
                    </div>
                </div>
            </main>
        </div>

@stack('modals')

@livewireScripts
</body>

</html>

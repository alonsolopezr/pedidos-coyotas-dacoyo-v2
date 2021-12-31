

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

    <body>

        <h1>QR Delivery</h1>
        {{-- <x-slot name="header"> --}}
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Read QR Client\'s Orders') }}
            </h2>
        {{-- </x-slot> --}}

    <video id="preview"></video>
    <h3 id="ordenH3">ORDEN:???</h3>
    <script type="text/javascript">

        var now = Date.now();
        navigator.mediaDevices.getUserMedia({audio: false, video: true})
        .then(function(stream) {
            console.log('Got stream, time diff :', Date.now() - now);
        })
        .catch(function(err) {
            console.log('GUM failed with error, time diff: ', Date.now() - now);
        });



        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
            //alert(content);
            let qrText = content;
            let qrArray = qrText.split("*");
            let fecha = qrArray[0];
            let hora = qrArray[1];
            let sucursal = qrArray[2];
            let orden = qrArray[3];
            //let cliente = qrArray[3];

            //formatear fecha separando los 4 digitos del año, 2 del mes, 2 del dia
           //let fechaFormat = fecha.substring(0,4)+"-"+fecha.substring(4,6)+"-"+fecha.substring(6,8);
            //formatear hora separando los 2 digitos del hora, 2 del minuto, 2 del segundo
           //let horaFormat = hora.substring(0,2)+":"+hora.substring(2,4)+":"+hora.substring(4,6);

            $('#ordenH3').text('ORDEN: #' + orden + ' del día ' + fecha + ' ' + hora+ ' ' + 'Sucursal: '+sucursal);
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
            scanner.start(cameras[1]);
            } else {
            console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });
    </script>

</body>

</html>




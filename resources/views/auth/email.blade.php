@vite('resources/css/app.css')

@php
$user = Auth::user();
@endphp
<div class="h-screen bg-gray-900 flex justify-center">
    <div class="h-5/6 w-96 border-2 border-red-500 mt-10 flex flex-col rounded-md items-center bg-gray-700">
        <div class="max-h">
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" class="mt-10 w-12">
        </div>
        <div class="mt-2">
            <h1 class=" text-3xl font-sans font-bold text-white">Verifica tu correo</h1>
        </div>
        <div class="mt-6">
            @if(isset($user))
            <h2 class="text-xl text-white font-mono">Bienvenido  {{$user->name}} {{$user->id}}</h2>
            @else
            <h2 class="text-xl text-white font-mono">Bienvenido</h2>
            @endif
       </div>
         <div class="mt-2 p-1">
              <p class="text-l text-center text-white font-mono">Hemos enviado un correo a la dirreccion que ingresaste, con unas instrucciones para que puedas ingresar</p>
         </div>   
         <div class="mt-5">
            <form method="POST" action="{{route('verify.sms')}}">            
                @csrf
                <div class="flex flex-col">
                    <label for="code" class="text-white font-mono">Codigo de confirmacion:</label>
                    <input type="text" class="border border-gray-400 p-2 rounded-lg h-8 w-80" name="code" id="code" value="{{old('code')}}">
                   @foreach ($errors->get('code') as $message)
                    <span class="text-red-500 text-xs font-bold">{{$message}}</span>
                      @endforeach
                </div>
                <div class="flex flex-col mt-6">
                     <button class="bg-black hover:bg-gray-900 text-white font-bold py-2 px-4 rounded" type="submit">Confirmar</button> 
                </div>
                <input type="hidden" name="user_id" value="{{$user->id}}">
            </form>  
         </div>

         <div class="mt-2 p-2 text-center">
            <form  method="GET" action="{{route('resend.sms')}}" >
                <span class="text-white font-mono text-center">No recibiste el correo?</span>
                <br>
                <span class="text-white font-mono text-center" id="tiempo"></span> 
                <input type="hidden" name="user_id_2" value="{{$user->id}}">
                <button class="bg-black hover:bg-gray-900 text-white font-bold py-2 px-4 rounded " type="submit" id="miBoton" disabled>Volver a enviar</button> 
            </form>

         </div>
            
        
</div>
<script>

document.addEventListener('DOMContentLoaded', function() {

let boton = document.getElementById('miBoton');
let tiempo = document.getElementById('tiempo');

let contador = 10;

let intervalo = setInterval(function() {
    if (contador == 0) {
        boton.disabled = false;
        boton.classList.remove('bg-gray-900');
        boton.innerText = 'Volver a enviar';
        tiempo.innerText = '';
        contador = 10;
        clearInterval(intervalo);
    } else {
        boton.disabled = true;
        boton.classList.add('bg-gray-900');


        tiempo.innerText = 'Espera ' + contador + ' segundos para volver a enviar';
        contador--;
    }
}, 1000);


});
</script>
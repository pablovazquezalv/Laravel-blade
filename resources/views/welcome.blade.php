@php
$user = Auth::user();
@endphp
@vite('resources/css/app.css')
@vite('resources/js/app.js')
<title>Inicio</title>
<div class="bg-gray-900 h-screen text-center">
        @if(Session::has('warning'))
        <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium"> {{ Session::get('warning') }} 
            </div>
            <button id="closeButton" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
              <span class="sr-only">Close</span>
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
              </svg>
            </button>
        </div>
 
@endif
        <div class="flex justify-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" class="mt-10 w-12">
        </div>
  
        @if(isset($user))
        <h2 class="text-xl text-white font-mono mt-3">Bienvenido  {{$user->name}} {{$user->last_name}}</h2>
        <h3 class="text-xl text-white font-mono mt-3">Tu correo es: {{$user->email}}</h3>
        <h3 class="text-xl text-white font-mono mt-3">Tu telefono es: {{$user->phone_number}}</h3>
        @else
        <h2 class="text-xl text-white font-mono">Bienvenido</h2>
        @endif

        <form method="GET" action="{{url('logout')}}">
            @csrf
        <button class="bg-red-600 hover:bg-red-900 text-white font-bold py-2 px-4 rounded mt-5" type="submit" >Cerrar Sesion</button>
        </form>
    </div>
<script>   
  document.getElementById('closeButton').addEventListener('click', function() {
        // Ocultar el modal
        document.getElementById('alert-2').style.display = 'none';
    });
</script>
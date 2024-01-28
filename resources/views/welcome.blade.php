@php
$user = Auth::user();
@endphp
    @vite('resources/css/app.css')
    <div class="bg-gray-900 h-screen text-center">
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
 
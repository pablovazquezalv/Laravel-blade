@php
$user = Auth::user();
@endphp
@vite('resources/css/app.css')
@vite('resources/js/app.js')
<title>Inicio</title>


<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" class="h-8" alt="Flowbite Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Control Users</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Tickets</a>
        </li>
        <li>
          <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Usuarios</a>
        </li>
       
      </ul>
    </div>
  </div>
</nav>

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
       
          
<br>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg ml-10 mr-10">
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
              <th scope="col" class="px-6 py-3">
                  ID DEL TICKET
              </th>
              <th scope="col" class="px-6 py-3">
                  Responsable
              </th>
              <th scope="col" class="px-6 py-3">
                  Descripcion
              </th>
              <th scope="col" class="px-6 py-3">
                  Estado
              </th>
              <th scope="col" class="px-6 py-3">
                  Acciones
              </th>
          </tr>
      </thead>
      <tbody>
          <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  2983
              </th>
              <td class="px-6 py-4">
                  John Doe
              </td>
              <td class="px-6 py-4">
                  Instalar Teams
              </td>
              <td class="px-6 py-4">
                  Abierto
              </td>
              <td class="px-6 py-4">
                  <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
              </td>
          </tr>
          
          
          
         
      </tbody>
  </table>
</div>

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

@vite('resources/css/app.css')
@vite('resources/js/app.js')
<x-nav />
<div class="bg-gray-900 h-screen ">
    <br>
    
    <h2 class="text-center text-3xl font-bold text-white">Usuarios</h2>
    
    <br>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg ml-10 mr-10">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs  uppercase bg-gray-800 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID DEL user
                </th>
                <th scope="col" class="px-6 py-3">
                    Usuario
                </th>
                <th scope="col" class="px-6 py-3">
                    Correo
                </th>
                <th scope="col" class="px-6 py-3">
                    Telefono
                </th>
                <th scope="col" class="px-6 py-3">
                  Rol
              </th>
               
                <th scope="col" class="px-6 py-3">
                    Cambiar rol
                </th>
              
              <th scope="col" class="px-6 py-3">
                  Status
              </th>
              <th scope="col" class="px-6 py-3">
                  Cambiar status
                </th>
            </tr>
        </thead>
        <tbody class="text-white">
          @foreach($users as $user)
            <tr class="odd:bg-gray-900 odd:dark:bg-gray-900 even:bg-gray-700  text-white">
                <th scope="row" class="px-6 py-4 font-medium text-white">
                  {{ $user->id }}
  
                </th>
                <td class="px-6 py-4">
                    {{ $user->name }} {{ $user->last_name }}
                </td>
  
                <td class="px-6 py-4">
                    {{ $user->email }}
                </td>
                <td class="px-6 py-4">
                    {{ $user->phone_number }}
                </td>
                <td class="px-6 py-4">
                    {{ $user->rol_id }}
                </td>
                <td class="px-6 py-4">
                    <button type="button" data-modal-target="modal2-{{ $user->id }}" data-modal-toggle="modal2-{{ $user->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Cambiar Rol</button>
                 
                </td>
              <td class="px-6 py-4">
                @if($user->status == 1)
                <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Activo</span>
                @else
                <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">Inactivo</span>
                @endif
            </td>
            <td class="px-6 py-4">
                <form action="{{route('change.status',$user->id)}}" method="POST">
                    @csrf
                <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Cambiar</button>
            </form>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
@foreach($users as $user)
<div id="modal2-{{$user->id}}"    tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" data-modal-hide="modal2-{{$user->id}}" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Cambiar rol</span>
            </button>
            <form method="POST" action="{{route('change.rol')}}" >
                @csrf
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Elige a que rol deseas cambiarle</h3>
                <p>Selecciona el rol que deseas asignarle a este usuario</p>
                <p>Usuario: {{ $user->name }} {{ $user->last_name }}</p>
                <p>rol actual: {{ $user->rol_id }}</p>
                <p>USERID {{ $user->id }}</p>
               <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="mt-5">
                    <select id="rol_id" name="rol_id" class="w-full px-4 py-2.5 text-sm font-medium text-gray-900 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 focus:outline-none">
                        <option value="1">Administrador</option>
                        <option value="2">Usuario</option>
                        <option value="3">Invitado</option>
                    </select>
                </div>
                <br>
              
                <button data-modal-hide="modal2-{{$user->id}}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Cambiar rol
                </button>
                <button data-modal-hide="modal2-{{$user->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach
   
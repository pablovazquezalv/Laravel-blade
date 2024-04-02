
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
  <!-- Modal Para cambiar roles-->
@foreach($users as $user)
<x-modal :roluser="$user->rol_id" :id="$user->id" :nameuser="$user->name" :lastnameuser="$user->last_name"/>
@endforeach
   
<div id="modal2-{{$attributes['id']}}"    tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-gray-800 rounded-lg shadow dark:bg-gray-700">
            <button type="button" data-modal-hide="modal2-{{$attributes['id']}}" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Cambiar rol</span>
            </button>
            <form method="POST" action="{{route('change.rol')}}" >
                @csrf
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-blue-700 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-white">Elige a que rol deseas cambiarle al usuario:</h3>
                
                <p class="text-white">Usuario: {{ $attributes['nameuser'] }} {{ $attributes['lastnameuser'] }}</p>
                @if($attributes['rol_id'] == 1)
                <p class="text-white">Rol actual: Administrador</p>
                @elseif($attributes['rol_id'] == 2)
                <p class="text-white">Rol actual: Coordinador</p>
                @else
                <p class="text-white">Rol actual: Invitado</p>
                @endif
               
               <!-- <p>USERID {{ $attributes['id'] }}</p> -->
                
               <input type="hidden" name="user_id" value="{{ $attributes['id'] }}">
                <div class="mt-5">
                    <select id="rol_id" name="rol_id" class="w-full px-4 py-2.5 text-sm font-medium text-gray-900 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 focus:outline-none">
                        <option value="1">Administrador</option>
                        <option value="2">Coordinador</option>
                        <option value="3">Invitado</option>
                    </select>
                </div>
                <br>
              
                <button data-modal-hide="modal2-{{$attributes['id']}}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Cambiar rol
                </button>
                <button data-modal-hide="modal2-{{$attributes['id']}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div id="default-modal-{{ $attributes['id']}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-gray-800 rounded-lg shadow dark:bg-gray-700">
            
            
            <button type="button" data-modal-hide="modal2-{{$attributes['id']}}" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Cambiar rol</span>
            </button>
            
            <form action="{{ route('tickets.resolve',$attributes['id'] ) }}" method="POST">
              @csrf
            <div class="p-4 md:p-5 space-y-4">
                <h3 class="mb-5 text-lg font-normal text-white">Estas seguro de terminar este ticket?</h3>
  
              <!--mostar el id del ticket-->
            <p class="text-white">
                ID del ticket: {{ $attributes['id'] }}
              </p>
              <!--mostrar el titulo del ticket-->
            <p class="text-white">
                Titulo: {{ $attributes['title'] }}
              </p>
              <!--mostrar la descripcion del ticket-->
            <p class="text-white">
                Descripcion: {{ $attributes['description'] }}
              </p>
              <!--mostrar la prioridad del ticket-->
            <p class="text-white">
                Prioridad: {{ $attributes['priority'] }}
              </p>
              <!--mostrar el usuario -->
              <p class="text-white">
                Usuario: {{ $attributes['name'] }} {{ $attributes['lastname'] }}
              </p>
              
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="default-modal-{{$attributes['id']}}" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Terminar</button>
                <button data-modal-hide="default-modal-{{$attributes['id']}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-dark focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
            </div>
            </form>
        </div>
    </div>
  </div>
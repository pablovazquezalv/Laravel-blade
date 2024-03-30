@php
$user = Auth::user();
@endphp
@vite('resources/css/app.css')
@vite('resources/js/app.js')
<title>Inicio</title>
<x-nav />


<div class="bg-gray-900 h-screen ">
         
<br>
@if($user->rol_id == 1 || $user->rol_id == 2)
<a class="bg-blue-600 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded mt-5 ml-10"   href="{{route('tickets.create.view')}}">Crear Ticket</a>
@endif
    
<h2 class="text-center text-3xl font-bold text-white">Tickets</h2>

<br>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg ml-10 mr-10">
  <table class="w-full text-sm text-left rtl:text-right text-white-500 dark:text-gray-400">
      <thead class="text-xs text-white font-bold uppercase bg-gray-800 dark:bg-gray-700 dark:text-gray-400">
          <tr>
              <th scope="col" class="px-6 py-3">
                  ID DEL TICKET
              </th>
              <th scope="col" class="px-6 py-3">
                  Usuario
              </th>
              <th scope="col" class="px-6 py-3">
                  Titulo
              </th>
              <th scope="col" class="px-6 py-3">
                  Descripcion
              </th>
              <th scope="col" class="px-6 py-3">
                Prioridad
            </th>
              <th scope="col" class="px-6 py-3">
                  Estado
              </th>
              <th scope="col" class="px-6 py-3">
                Fecha de creacion
            </th>
              <th scope="col" class="px-6 py-3">
                  Acciones
              </th>
              <th scope="col" class="px-6 py-3">
                
            </th>
            <th scope="col" class="px-6 py-3">
                
            </th>
          </tr>
      </thead>
      <tbody class="font-bold ">
        @foreach($tickets as $ticket)
          <tr class="odd:bg-gray-900 odd:dark:bg-gray-900 even:bg-gray-700  text-white">
              <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                {{ $ticket->id }}
              </th>
              <td class="px-6 py-4">
                  {{ $ticket->name }} {{ $ticket->last_name }}
              </td>
              <td class="px-6 py-4">
                  {{ $ticket->title }}
              </td>
              <td class="px-6 py-4">
                  {{ $ticket->description }}
              </td>
              <td class="px-6 py-4">
                
                @if($ticket->priority == 'low')
                <span class="bg-blue-800 text-white  font-semibold px-2 rounded-full">Baja</span>
                @elseif($ticket->priority == 'medium')
                <span class="bg-yellow-800 text-white font-semibold px-2 rounded-full">Media</span>
                @else
                <span class="bg-red-800 text-white font-semibold px-2 rounded-full">Alta</span>
                @endif
              </td>
              <td class="px-6 py-4">
                  @if($ticket->status == 'open')
                  <span class="bg-green-800 text-white  font-semibold px-2 rounded-full">Abierto</span>
                  @else
                  <span class="bg-red-800 text-white font-semibold px-2 rounded-full">Cerrado</span>
                  @endif
                </td>
              <td class="px-6 py-4">
                  {{ $ticket->created_at }}
              </td>
              <td class="px-6 py-4">
                @if($user->rol_id == 1 || $user->rol_id == 2)
                @if($ticket->status == 'open')
                <button data-modal-target="default-modal-{{ $ticket->id }}" data-modal-toggle="default-modal-{{ $ticket->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" type="button">
                  Listo
              </button>
                @else
                <button class="font-medium text-gray-600 dark:text-gray-500" type="button" disabled>
                  Listo
              </button>
                @endif
                @else
                <button class="font-medium text-gray-600 dark:text-gray-500" type="button" disabled>
                  Listo
              </button>
                @endif
              </td>
              <td class="px-6 py-4">
                @if(($user->rol_id == 1 || $user->rol_id == 2) && $ticket->status == 'open')
                <a href="{{ route('tickets.edit.view', $ticket->id) }}"  class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                @else
                <button class="font-medium text-gray-600 dark:text-gray-500" type="button" disabled>
                  Editar
              </button>
                @endif
              </td>
            <td class="px-6 py-4">
            @if($user->rol_id == 1 || $user->rol_id == 2)
              <button type="button" onclick="eliminarTicket({{ $ticket->id }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Eliminar</button>
              @else
              <button class="font-medium text-gray-600 dark:text-gray-500" type="button" disabled>
                Eliminar
            </button>
              @endif
            </td>

          </tr>
          
          @endforeach
      </tbody>
  </table>
</div>
@foreach($tickets as $ticket)
<div id="default-modal-{{ $ticket->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-2xl max-h-full">
      <!-- Modal content -->
      <div class="relative bg-gray-600 rounded-lg shadow dark:bg-gray-700">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                  Finalizar ticket
              </h3>
              <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-{{$ticket->id}}">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  <span class="sr-only">Cerrar</span>
              </button>
          </div>
          <form action="{{ route('tickets.resolve',$ticket->id ) }}" method="POST">
            @csrf
          <div class="p-4 md:p-5 space-y-4">
          <p class="text-white">
              ¿Estas seguro de finalizar este ticket?
            </p>

            <!--mostar el id del ticket-->
          <p class="text-white">
              ID del ticket: {{ $ticket->id }}
            </p>
            <!--mostrar el titulo del ticket-->
          <p class="text-white">
              Titulo: {{ $ticket->title }}
            </p>
            <!--mostrar la descripcion del ticket-->
          <p class="text-white">
              Descripcion: {{ $ticket->description }}
            </p>
            <!--mostrar la prioridad del ticket-->
          <p class="text-white">
              Prioridad: {{ $ticket->priority }}
            </p>
            <!--mostrar el usuario -->
            <p class="text-white">
              Usuario: {{ $ticket->name }} {{ $ticket->last_name }}
            </p>
            
          </div>
          <!-- Modal footer -->
          <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
              <button data-modal-hide="default-modal-{{$ticket->id}}" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Terminar</button>
              <button data-modal-hide="default-modal-{{$ticket->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-dark focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
          </div>
          </form>
      </div>
  </div>
</div>
@endforeach
<!--modal-->

<script type="text/javascript">



  function eliminarTicket(id) {
    var respuesta = confirm("¿Estás seguro de eliminar este ticket ?");

    if (respuesta) {
      window.location.href = "{{ url('ticketDelete/') }}" + "/" + id;
    }
  }

 

</script>
     
    
    

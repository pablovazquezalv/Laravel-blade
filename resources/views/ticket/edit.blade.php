@php
$user = Auth::user();
@endphp
@vite('resources/css/app.css')
@vite('resources/js/app.js')
<title>Inicio</title>
<x-nav />

<div class="bg-gray-900 h-screen ">
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
<a class="bg-blue-600 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded mt-5 ml-10"   href="{{route('welcome.view')}}">Regresar</a>
<br>
<br>


<h2 class="text-2xl font-semibold text-white dark:text-white text-center">Editar Ticket</h2>
  
<form class="max-w-sm mx-auto" method="POST" action="{{route('tickets.edit',$ticket->id)}}" >
    @csrf
    <div class="mb-5">
      <label for="title" class="block mb-2 text-sm font-medium text-white dark:text-white">Titulo:</label>
      <input type="text" id="title" name="title" value="{{$ticket->title}}" value="{{old('title')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ej. Reseteo de contraseña" required />
      @error('title')
                <small style="color: red" class="font-bold">{{$message}}</small>
       @enderror
    </div>
    <div class="mb-5">
      <label for="description" class="block mb-2 text-sm font-medium text-white dark:text-white">Descripcion:</label>
      <input type="text" id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$ticket->description}}" value="{{old('description')}}" required />
      @error('description')
      <small style="color: red" class="font-bold">{{$message}}</small>
@enderror
    </div>
    <div class="mb-5">
      <label for="priority" class="block mb-2 text-sm font-medium text-white dark:text-white">Prioridad:</label>
      <select id="priority" name="priority" value="{{$ticket->priority}}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        <option value="low">Baja</option>
        <option value="medium">Media</option>
        <option value="high">Alta</option>
      </select>

      @error('priority')
      <small style="color: red" class="font-bold">{{$message}}</small>
    @enderror
    </div>

    <input type="hidden" name="user_id" value="{{$user->id}}">

   
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear</button>
  </form>
  



        </div>
     
    </div>

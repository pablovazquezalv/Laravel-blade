@vite('resources/css/app.css')
<!-- vista para loguear con codigo de verificacion -->

@if(isset($user))
<div class="h-screen bg-gray-900 flex justify-center">
    <div class="h-5/6 w-96 border-2 border-red-500 mt-10 flex flex-col rounded-md items-center bg-gray-700">
        <div class="max-h">
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" class="mt-10 w-12">
        </div>
        <div class="mt-2">
            <h1 class=" text-3xl font-sans font-bold text-white text-center">Iniciar sesion</h1>
            <h3 class=" text-xl font-sans font-bold text-white text-center">Ingresa el codigo que te enviamos para poder iniciar sesion</h1>
        </div>
        <div class="mt-6">
            @if(isset($user))
            <h2 class="text-xl text-white font-mono">Hola!  {{$user->name}} {{$user->last_name}}</h2>
            @else
            <h2 class="text-xl text-white font-mono">Bienvenido </h2>
            @endif 
       </div>
       <div class="mt-10 p-2">
    @if(isset($user))
    @if($user->rol_id == 1)
    <p class="text-white">Hemos enviado un codigo de ingreso para que puedas ingresar, ingresa ese codigo para iniciar en la aplicacion movil y obtener los codigos de acceso</p>
    @else
    <p class="text-white">Hemos enviado un codigo de ingreso al correo que ingresaste</p>
    @endif   
    @else
    <p class="text-white">Hemos enviado un codigo de ingreso al correo que ingresaste</p>
    @endif
</div>
           
         <div class="mt-5">
            <form method="POST" action="{{route('login.code')}}">            
                @csrf
                <div class="flex flex-col">
                    <label for="code" class="text-white font-mono">Codigo de confirmacion:</label>
                    <input type="text" class="border border-gray-400 p-2 rounded-lg h-8 w-80" name="code" id="code" value="{{old('code')}}">
                   @foreach ($errors->get('code') as $message)
                    <span class="text-red-500 text-xs font-bold">{{$message}}</span>
                      @endforeach
                </div>

                @if(isset($user))
                <input type="hidden" name="user_id" value="{{$user->id}}">
                @endif


                <div class="flex flex-col mt-6">
                     <button class="bg-black hover:bg-gray-900 text-white font-bold py-2 px-4 rounded" type="submit">Confirmar</button> 
                </div>
                                
            </form>  
             {{-- <div class="flex flex-col mt-6">
                <form action="{{url('resend.whatsapp')}}" method="POST">
                    @csrf
                <p class="text-white">¿No recibiste el codigo?</p>
                <button class="bg-black hover:bg-gray-900 text-white font-bold py-2 px-4 rounded" type="submit">Confirmar</button> 
            </form>
            </div>  --}}
         </div>  
</div>
@else
<!-- decir que esta haciendo algo mal -->
<h3 class="text-white">Parece que estas haciendo algo mal</h3>
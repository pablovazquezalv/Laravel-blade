@vite('resources/css/app.css')
<title>Iniciar Sesion</title>    
<div class="h-screen bg-gray-900 flex justify-center">
<div class="h-5/6 w-96 border-2 border-red-500 mt-10 flex flex-col rounded-md items-center bg-gray-700">

    <div class="mt-2">
        <h1 class=" text-3xl font-sans font-bold text-white">Se ha vuelto a enviar el correo</h1>
    </div>
    <div class="mt-6">
        @if(isset($user))
        <h2 class="text-xl text-white font-mono">Hola! {{$user->name}} {{$user->last_name}}</h2>
        @else
        <h2 class="text-xl text-white font-mono">Bienvenido</h2>
        @endif 
   </div>
    <div class="mt-10 p-2">
        <p class="text-l text-center text-white font-mono">Volvimos a enviar un correo a la dirección que ingresaste, para validarlo, con unas instrucciones que debes de seguir para poder ingresar.</p>  
    </div>
    <div class="mt-10 p-2">
        <p class="text-l text-center text-white font-mono">Por favor revisa tu bandeja de entrada o la carpeta de spam.</p>  
    </div>
    <div class="mt-5">
        <a href="{{route('verified.view')}}" class="bg-green-500 text-white p-2 rounded-md">Recibi el correo</a>
    </div>
    <!--Boton de no recibi-->
   <form action="{{route('resend.email')}}" method="POST">
    @csrf
    <p class="text-white text-center mt-10">¿No recibiste el correo?</p>
    <div class="mt-5">
        <button type="submit" class="bg-red-500 text-white p-2 rounded-md">Reenviar correo</button>
    </div>
    <input type="hidden" name="id" value="{{$user->id}}">
   </form>
</div>
</div>
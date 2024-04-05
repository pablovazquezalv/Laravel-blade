@vite('resources/css/app.css')

<div class="h-screen bg-gray-900 flex justify-center">
    <div class="h-5/6 w-96 border-2 border-red-500 mt-10 flex flex-col rounded-md items-center bg-gray-700">
        <div class="max-h">
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" class="mt-10 w-12">
        </div>
        <div class="mt-2">
            <h1 class=" text-3xl font-sans font-bold text-white">Verifica tu telefono</h1>
        </div>
        <div class="mt-6">
            @if(isset($user))
            <h2 class="text-xl text-white font-mono">Bienvenido  {{$user->name}} {{$user->last_name}}</h2>
            @else
            <h2 class="text-xl text-white font-mono">Bienvenido</h2>
            @endif 
       </div>
       <div class="mt-10 p-2">
        <p class="text-l text-center text-white font-mono">Ingresa el codigo de verificacion, que hemos enviamos a tu whatssApp</p>  
    </div>
           
         <div class="mt-5">
            <form method="POST" action="{{route('verify.whatssApp')}}">            
                @csrf
                <div class="flex flex-col">
                    <label for="code" class="text-white font-mono">Codigo de confirmacion:</label>
                    <input type="text" class="border border-gray-400 p-2 rounded-lg h-8 w-80" name="code" id="code" value="{{old('code')}}">
                   @foreach ($errors->get('code') as $message)
                    <span class="text-red-500 text-xs font-bold">{{$message}}</span>
                      @endforeach
                </div>
                <div class="flex flex-col mt-6">
                     <button class="bg-black hover:bg-gray-900 text-white font-bold py-2 px-4 rounded" type="submit">Confirmar</button> 
                </div>
                @if(isset($user))
                <input type="hidden" name="user_id" value="{{$user->id}}">     
                @endif            
            </form>  
            <!-- Reenviar codigo-->
             <div class="flex flex-col mt-6">
                <form action="{{route('resend.whatsapp')}}" method="POST">
                    @csrf
                <p class="text-white">¿No recibiste el codigo?</p>
                @if(isset($user))
                <input type="hidden" name="user_id" value="{{$user->id}}">
                @endif
                <button class="bg-black hover:bg-gray-900 text-white font-bold py-2 px-4 rounded" type="submit">Confirmar</button> 
            </form>
            </div> 
         </div>

      
            
        
</div>
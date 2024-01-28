
@vite('resources/css/app.css')
<title>Iniciar Sesion</title>
<body>
    
<div class="h-screen bg-gray-900 flex justify-center">
<div class="h-5/6 w-96 border-2 border-red-500 mt-10 flex flex-col rounded-md items-center bg-gray-700">

    <div class="max-h">
        <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" class="mt-10 w-12">
    </div>

    <div class="mt-2">
        <h1 class=" text-3xl font-sans font-bold text-white">Iniciar Sesion</h1>
    </div>

    <div class="">
        <form method="POST" action="{{route('login.user')}}"  class=" m-10">
            @csrf
            <div class="flex flex-col  ">
                <label for="name" class="mt-2 text-white font-mono">Correo electronico:</label>
                <input type="email" class="border border-gray-400 p-2 rounded-lg h-8 w-80" name="email" id="email" value="{{old('email')}}">
                @error('email')
                <small style="color: red" class="font-bold">{{$message}}</small>
                @enderror
            </div>
            <div class="flex flex-col mt-2">
                <label for="password" class="text-white font-mono">Contraseña:</label>
                <input type="password" class="border border-gray-400 p-2 rounded-lg h-8 w-80" name="password" id="password" value="{{old('password')}}">
                @error('password')
                <small style="color: red" class="font-bold">{{$message}}</small>
                @enderror
            </div>
    
            <br>
            <div class="flex flex-col">
                 <button class="bg-black hover:bg-gray-900 text-white font-bold py-2 px-4 rounded" type="submit">Iniciar sesion</button> 
            </div>
        </form>
    </div>

</div>
</div>
    @vite('resources/js/app.js')
</body>
</html>
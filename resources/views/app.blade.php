<body>
    
@vite(['resources/css/app.css','resources/js/app.js'])

<div class="h-screen bg-gray-900 flex justify-center">
<div class="mt-10">
<a class="bg-black hover:bg-gray-600 text-white font-bold py-2 px-4 rounded -10" type="submit"  href="{{route('register.view')}}">CREAR CUENTA</a>

<button class="bg-black hover:bg-gray-600 text-white font-bold py-2 px-4 rounded ml-10" type="submit"><a href="{{route('login.view')}}">INICIAR SESION</a></button>
</div>
</div>
</body>

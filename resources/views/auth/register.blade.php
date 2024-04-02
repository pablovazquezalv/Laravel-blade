<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<body>
<div class="h-screen bg-gray-900 flex justify-center">
<div class="h-5/6 w-96 border-2 border-red-500 mt-5 flex flex-col rounded-md items-center bg-gray-700">
    <div class="max-h">
        <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" class="mt-10 w-12">
    </div>

    <div class="mt-2">
        <h1 class=" text-3xl font-sans font-bold text-white">Crear cuenta</h1>
    </div>

    <div class=" mt-3">
    <form method="POST" action="{{route('register.user')}}" id="register-form">
        @csrf
        @error('g-recaptcha-response')
        <small style="color: red">{{$message}}</small>
        @enderror
        <div class="flex flex-col mt2">
            <label for="name" class="mt-2 text-white font-mono">Nombre</label>
            <input type="text" class="border border-gray-400 p-2 rounded-lg h-8 w-80" name="name" id="name" value="{{ old('name')}}" required >
            @error('name')
            <small style="color: red" class="font-bold">{{$message}}</small>
            @enderror
        </div>
        <div class="flex flex-col mt-2">
            <label for="" class="text-white font-mono">Apellido</label>
            <input type="text" class="border border-gray-400 p-2 rounded-lg h-8 w-80" name="last_name" id="last_name" value="{{old('last_name')}}" required>
            @error('last_name')
            <small style="color: red" class="font-bold">{{$message}}</small>
            @enderror
        </div>
        <div class="flex flex-col mt-2">
            <label for="email" class="text-white font-mono">Correo electronico</label>
            <input type="email" class="border border-gray-400 p-2 rounded-lg h-8 w-80" name="email" id="email" value="{{old('email')}}" required>
            @error('email')
            <small style="color: red" class="font-bold">{{$message}}</small>
            @enderror
        </div>
        <div class="flex flex-col mt-2">
            <label for="password" class="text-white font-mono">Contraseña</label>
            <input type="password" class="border border-gray-400 p-2 rounded-lg h-8 w-80" name="password" id="password" value="{{old('password')}}">
            @error('password')
            <small style="color: red" class="font-bold">{{$message}}</small>
            @enderror
        </div>

        <div class="flex flex-col mt-2">
            <label for="phone_number" class="text-white font-mono">Telefono celular: </label>
            <input type="text" class="border border-gray-400 p-2 rounded-lg" name="phone_number" id="phone_number" value="{{old('phone_number')}}">
            @error('phone_number')
            <small style="color: red" class="font-bold">{{$message}}</small>
            @enderror
        </div>
        <br>
      
        <div class="flex flex-col">
             <button data-sitekey="6LdKd14pAAAAALImKcWipHFUS-Iw5vmEtlr0MeK2"
             data-callback='onSubmit'
             data-action='submit' class="g-recaptcha  bg-black hover:bg-gray-900 text-white font-bold py-2 px-4 rounded" type="submit">Crear</button> 
        </div>
    </form>
    <!-- REGRESAR A LOGIN -->
    <div class="flex flex-col text-center">
        <a href="{{route('login.view')}}" class="text-white font-mono">¿Ya tienes cuenta? Inicia sesion</a>
    </div>
    </div>
    @vite('resources/js/app.js')
</body>

<script src="https://www.google.com/recaptcha/enterprise.js?6LdKd14pAAAAALImKcWipHFUS-Iw5vmEtlr0MeK2"></script>

    <script>
        function onSubmit(token) {
     document.getElementById("register-form").submit();
   }

        function onClick(e) {
        e.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('reCAPTCHA_site_key', {action: 'submit'}).then(function(token) {
            
            let form = document.getElementById('register-form');
            let input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'g-recaptcha-response');
            input.setAttribute('value', token);
            form.appendChild(input);
            form.submit();


          });
        });
      }

  </script>
    

</html>
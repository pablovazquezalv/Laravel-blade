<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <h1>hola {{$user->name}}</h1>
    <h2>Confirma tu cuenta</h2>
    <p>estas a un paso de poder iniciar sesion</p>
    <br>
    <p>tu correo es valido!,ahora debemos verificar tu telefono,pulsando el siguiente boton, para recibir un codigo mediante <b>WhatssApp</b></p>
    <br>   
     <p><a href="{{$url}}" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Confirmar</a></p>

</body>
</html>
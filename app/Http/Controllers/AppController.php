<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Models\CodeAccess;
use Illuminate\Support\Str;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

class AppController extends Controller
{
    public function loginAppMobile(Request $request)
    {
        $validator = Validator::make($request->all(),
         [
            'email' => 'required|max:50|email',
            'password' => 'required|max:50|min:6',
        ],[
            'email.required' => 'El campo correo es requerido',
            'email.max' => 'El campo correo no debe ser mayor a 50 caracteres',
            'email.email' => 'El campo correo debe ser de tipo email',
            
            'password.required' => 'El campo contraseña es requerido',
            'password.max' => 'El campo contraseña no debe ser mayor a 50 caracteres',
            'password.min' => 'El campo contraseña no debe ser menor a 6 caracteres',
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['error' => $validator->errors()],404);
        }
        else
        {
            $user = User::where('email',$request->email)->first();


            if($user)
            {
                if(Hash::check($request->password,$user->password))
                {  
                    //DARLE TOKEN
                    $token = $user->createToken('token')->plainTextToken;
                    return response()->json(['token' => $token],200);
                }
                else
                {
                    return response()->json(['error' => 'Creedenciales incorrectas'],404);
                }
            }
            else
            {
                return response()->json(['error' => 'Credenciales incorrectas'],404);
            }
        }
    }

        public function loginCodeApp(Request $request)
        {
            $validator = Validator::make($request->all(),
             [
                'code' => 'required'
            ],[
                'code.required' => 'El campo codigo es requerido'
                
            ]);
            if($validator->fails())
            {
                return response()->json(['error' => $validator->errors()],404);
            }
            //obtener usuario del token
            $user = $request->user();

            if($user)
            {
                if($request->code == Crypt::decryptString($user->code))
                {
                    //puede acceder y permitimos al middleware
                    $user->access_app = 1;
                    //cambiar el codigo del primer acceso
                    $user->code = Crypt::encryptString(rand(10000,99999));
                    $user->save();

                    return response()->json(['success' => 'Acceso permitido'],200);
                    
                }
                else
                {
                    return response()->json(['error' => 'El codigo es incorrecto'],404);
                }
            }
    
        }
    
        public function getCodesAccess(Request $request)
        {

            $user = $request->user();

            if(!$user)
            {
                return response()->json(['error' => 'Usuario no encontrado'],404);
            }

            //mostrar solo las claves publicas
            $codes = CodeAccess::where('user_id',$user->id)->get(['code','status','user_id','expiration_time','created_at','updated_at']);

            return response()->json($codes,200,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
       
       
        }


        public function fillTableCodes()
        {
            CodeAccess::truncate(); // Elimina todos los registros existentes
        
            $users = User::where('rol_id', 1)->get();
            
            foreach ($users as $user) {
                // Generar múltiples códigos de acceso para el usuario
                $codes = [];
                for ($i = 0; $i < 5; $i++) {
                    $codes[] = [
                        'code' => rand(100000, 999999),
                        'status' => 1,
                        'user_public_key' => $user->public_key,
                        //'user_private_key' => $user->private_key,
                        'user_id' => $user->id,
                        'expiration_date' => now()->addDays(1),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
        
                // Insertar los códigos en la base de datos en una sola operación
                CodeAccess::insert($codes);
            }
            $allCodes = CodeAccess::all();
            return response()->json(['success' => 'Tabla llenada con éxito', 'codes' => $allCodes], 200);
      
        }

        public function logout(Request $request)
        {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['success' => 'Sesión cerrada con éxito'], 200);
        }

       //funcion para validar el token
         public function validateToken(Request $request)
         {
            $user = $request->user();

            if($user)
            {
                return response()->json(['success' => 'Token valido'],200);
            }
            else
            {
                return response()->json(['error' => 'Token invalido'],404);
            }
                
         }

         public function accessApp(Request $request)
         {
            $user = $request->user();

            if($user->access_app == 1)
            {
                return response()->json(['success' => 'Acceso permitido'],200);
            }
            else
            {
                return response()->json(['error' => 'Acceso denegado'],404);
            }
         }
        


}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\ReCapchat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Exceptions\MethodNotAllowed;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendEmail;

class UserController extends Controller
{
       
    
    public function register(Request $request)
    {   
       
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30|alpha|min:2',
            'last_name' => 'required|max:30|alpha|min:2',
            'email' => 'required|unique:users|max:50|email',
            'phone_number' => 'required|digits:10|numeric',
            'password' => 'required|max:50|min:6',
            'g-recaptcha-response' => ['required', new ReCapchat],
        ],[
            'name.required' => 'El campo nombre es requerido',
            'name.max' => 'El campo nombre no debe ser mayor a 30 caracteres',
            'name.min' => 'El campo nombre no debe ser menor a 2 caracteres',
            'name.alpha'=> 'El campo nombre debe ser de tipo alfabetico',
            
            'last_name.required' => 'El campo apellido es requerido',
            'last_name.max' => 'El campo apellido no debe ser mayor a 30 caracteres',
            'last_name.min' => 'El campo apellido no debe ser menor a 2 caracteres',
            'last_name.alpha'=> 'El campo apellido debe ser de tipo alfabetico',

            'email.required' => 'El campo correo es requerido',
            'email.unique' => 'El campo correo ya existe',
            'email.max' => 'El campo correo no debe ser mayor a 50 caracteres',
            'email.email' => 'El campo correo debe ser de tipo email',
            
            'phone_number.required' => 'El campo telefono es requerido',
            'phone_number.digits' => 'El campo telefono debe ser de 10 digitos',


            'password.required' => 'El campo contraseña es requerido',
            'password.max' => 'El campo contraseña no debe ser mayor a 50 caracteres',
            'password.min' => 'El campo contraseña no debe ser menor a 6 caracteres',
        ]);

        if ($validator->fails())
         {
            Log::info('Error al registrar usuario',[$validator->errors()]);
            return redirect('/register')
                        ->withErrors($validator)
                        ->withInput();

        }

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user_fist = User::first();

        if($user_fist->rol_id == null)
        {

            $user->rol_id = 1;
            $user->code = rand(1000,9999);
            Log::info('Usuario admin creado correctamente '.$user->id);
            
        }
        else
        {
            $user->rol_id = 2;
            Log::info('Usuario normal creado correctamente '.$user->id);
        }
        
        $user->save();

        if($user->save())
        {
            return redirect('/login');
        }
        else
        {
            Log::error('Error al registrar usuario '.$user->id);
            $validator->errors()->add('email', 'Error al registrar el usuario');
            return redirect('/auth/register')
                        ->withErrors($validator)
                        ->withInput();
        }
       
    }

    public function login(Request $request)
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
            return redirect()->route('login.view')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::where('email',$request->email)->first();

        if($user)
        {
            if(Hash::check($request->password,$user->password))
            {  
                //si es usuario 1 (admin) le pone contraseña (1), y correo de validacion .. (2)
                // puede meter telefono y otro codigo(3) entra al inicio

                if($user->rol_id==1)
                {
                  $url = URL::temporarySignedRoute('send.whatsapp', now()->addMinutes(15), ['id' => $user->id,'rol_id' => $user->rol_id,'phone_number' => $user->phone_number,'last_name'=>$user->last_name ]);

                 SendEmail::dispatch($user,$url)->delay(now()->addSeconds(10))->onQueue('emails')->onConnection('database');
                
                 
                 #Auth::login($user);
                 session(['user_id' => $user->id]);
                 return redirect('/information');
    
                }
                
                //si es usuario 2(guest) solo contraseña y entra al inicio
                else
                {
                    Auth::login($user);
                    
                    Log::info('Usuario normal sesion iniciada correctamente '.$user->id);
                    return redirect('/welcome');
                }

            }
            else
            {
                Log::error('Usuario no autenticado '.$user->id);
                $validator->errors()->add('password', 'Creedenciales incorrectas');
                return redirect('/login')
                        ->withErrors($validator)
                        ->withInput();
            }
        }
        else
        {
            Log::error('Error usuario no existente');

            $validator->errors()->add('email', 'Creedenciales incorrectas');
            return redirect('/login')
                        ->withErrors($validator)
                        ->withInput();
        }

    }

    public function sendWhatssApp(Request $request)
    {
        //verificar que la ruta este firmada
        if(!$request->hasValidSignature())
           {
            Log::error('Error al firmar la ruta');
            abort(401);
        }
        else
        {
           $user = User::find($request->id);

            //crear de twilio
            $sid = env('TWILIO_ACCOUNT_SID');
            $token = env('TWILIO_AUTH_TOKEN');

            //enviar mensaje
            $response = Http::asForm()->withBasicAuth($sid,$token)->post('https://api.twilio.com/2010-04-01/Accounts/'.$sid.'/Messages.json',[
            //'To' => 'whatsapp:+521'.$user->phone_number,
            'To' => 'whatsapp:+5218718458147',
            'From' => 'whatsapp:+'.env('TWILIO_FROM_NUMBER'),
            'Body' => 'Hola '.$user->name.' '.$user->last_name.' tu codigo de verificacion es:'.$user->code.'',
            ]);   

            if($response->successful())
            {
                Log::info('Servicio de twilio consumido correctamente para usuario');
                //regresar vista de todo bien que vaya a verificar su codigo
                return redirect()->route('email.view');
            }
            else
            {
                Log::error('Servicio de twilio fallando');
                return response()->json([
                    'message' => 'Error al enviar el SMS',
                    'error' => $response->json(),
                    'code' => 400,
                ]);
            }
        }
    }

    public function verifyCode(Request $request)
    {
       try
       {
        $user = User::find($request->user_id);

        $validator = Validator::make($request->all(),
         [
            'code' => 'required|max:4|min:4',
        ],[
            'code.required' => 'El campo codigo es requerido',
            'code.max' => 'El campo codigo no debe ser mayor a 4 caracteres',
            'code.min' => 'El campo codigo no debe ser menor a 4 caracteres',
        ]);
        if($validator->fails())
        {
            return redirect()->route('email.view')
                        ->withErrors($validator)
                        ->withInput();  
        }
        
        if($user->code == $request->code)
        {
            $user->code = rand(1000,9999);
            $user->save();

            //si es autenticado
            Auth::login($user);

            return redirect('/welcome');
        }
        else
        {
            $validator->errors()->add('code', 'El codigo es incorrecto');
            return redirect()->route('email.view')
                        ->withErrors($validator)
                        ->withInput();
        }

       }
       catch(\Exception $e)
       {
         Log::error('Uso de metodo no valido');
            throw new MethodNotAllowed();

       }
        
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }

   public function resendWhatssap(Request $request)
    {

        $user = User::find($request->user_id_2);

            //crear de twilio
            $sid = env('TWILIO_ACCOUNT_SID');
            $token = env('TWILIO_AUTH_TOKEN');

            //enviar mensaje
            $response = Http::asForm()->withBasicAuth($sid,$token)->post('https://api.twilio.com/2010-04-01/Accounts/'.$sid.'/Messages.json',[
            //'To' => 'whatsapp:+521'.$user->phone_number,
            'To' => 'whatsapp:+5218718458147',
            'From' => 'whatsapp:+'.env('TWILIO_FROM_NUMBER'),
            'Body' => 'Hola '.$user->name.' '.$user->last_name.' tu codigo de verificacion es:'.$user->code.'',
            ]);   

            if($response->successful())
            {
                Log::info('Servicio de twilio consumido correctamente para usuario');
                //regresar vista de todo bien que vaya a verificar su codigo
                return redirect()->route('email.view');
            }
            else
            {
                Log::error('Servicio de twilio fallando');
                return response()->json([
                    'message' => 'Error al enviar el SMS',
                    'error' => $response->json(),
                    'code' => 400,
                ]);
            }
        

    }
}

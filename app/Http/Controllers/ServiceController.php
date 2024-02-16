<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Exceptions\MethodNotAllowed;
use Illuminate\Support\Facades\Hash;

class ServiceController extends Controller
{
    public function sendWhatssApp(Request $request)
    {
        //verificar que la ruta este firmada // codigo comentando
       /* if(!$request->hasValidSignature())
           {
            Log::error('Error al firmar la ruta');
            abort(404);
        }
        else
        {*/
           $user = User::find($request->id);

            //crear de twilio
            $sid = env('TWILIO_ACCOUNT_SID');
            $token = env('TWILIO_AUTH_TOKEN');

            //generar codigo
            $code = rand(1000,9999);
            $code_send = $code;
            $phone_code = Hash::make($code);

            $user->code = $phone_code;
            $user->save();

            
            //enviar mensaje
            $response = Http::asForm()->withBasicAuth($sid,$token)->post('https://api.twilio.com/2010-04-01/Accounts/'.$sid.'/Messages.json',[
            //'To' => 'whatsapp:+521'.$user->phone_number,
            'To' => 'whatsapp:+5218718458147',
            'From' => 'whatsapp:+'.env('TWILIO_FROM_NUMBER'),
            'Body' => 'Hola '.$user->name.' '.$user->last_name.' tu codigo de verificacion es:'.$code_send.'',
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
       // }

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
        
        if(Hash::check($request->code,$user->code))
        {
            
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

    public function resendWhatssap(Request $request)
    {

            $user = User::find($request->user_id_2);
            //crear de twilio
            $sid = env('TWILIO_ACCOUNT_SID');
            $token = env('TWILIO_AUTH_TOKEN');

            //generar codigo
            $code = rand(1000,9999);
            $code_send = $code;

            $user->code = Hash::make($code);
            $user->save();


            //enviar mensaje
            $response = Http::asForm()->withBasicAuth($sid,$token)->post('https://api.twilio.com/2010-04-01/Accounts/'.$sid.'/Messages.json',[
            //'To' => 'whatsapp:+521'.$user->phone_number,
            'To' => 'whatsapp:+5218718458147',
            'From' => 'whatsapp:+'.env('TWILIO_FROM_NUMBER'),
            'Body' => 'Hola '.$user->name.' '.$user->last_name.' tu codigo de verificacion es:'.$code_send.'',
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

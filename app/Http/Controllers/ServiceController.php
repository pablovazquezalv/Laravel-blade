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
use Illuminate\Support\Facades\URL;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Crypt;

class ServiceController extends Controller
{
    public function resendEmail(Request $request)
    {
        $user = User::find($request->id);
         
       if($user)
       {
        if($user->email_verified_at != null)
        {
            return response()->json([
                'message' => 'El correo ya ha sido verificado',
                'code' => 400,
            ]);
        }
        else
        {
            $url = URL::temporarySignedRoute('send.whatsapp', now()->addMinutes(15), ['id' => $user->id,'rol_id' => $user->rol_id,'phone_number' => $user->phone_number,'last_name'=>$user->last_name ]);
       
            SendEmail::dispatch($user,$url)->delay(now()->addSeconds(10))->onQueue('emails')->onConnection('database');
            Log::info('Correo enviado correctamente');
            
            session(['user_id' => $user->id]);

            return redirect('/mailresend');
        }
       }
         else
         {
              return response()->json([
                'message' => 'El usuario no existe',
                'code' => 400,
              ]);
         }
    }



    //Ruta firmada
    public function sendWhatssApp(Request $request)
    {
           $user = User::find($request->id);

           if($user)
           {
            

            //crear de twilio
            $sid = env('TWILIO_ACCOUNT_SID');
            $token = env('TWILIO_AUTH_TOKEN');

            $codigoDescifrado = Crypt::decryptString($user->code);


            //enviar mensaje
            $response = Http::asForm()->withBasicAuth($sid,$token)->post('https://api.twilio.com/2010-04-01/Accounts/'.$sid.'/Messages.json',[
            //'To' => 'whatsapp:+521'.$user->phone_number,
            'To' => 'whatsapp:+5218718458147',
            'From' => 'whatsapp:+'.env('TWILIO_FROM_NUMBER'),
            'Body' => 'Hola '.$user->name.' '.$user->last_name.' tu codigo de verificacion es:'.$codigoDescifrado.'',
            ]);   
            //update email_verified_at
            $user->email_verified_at = now();

            $user->save();


            if($response->successful())
            {
                Log::info('Servicio de twilio consumido correctamente para usuario');
                //regresar vista de todo bien que vaya a verificar su codigo
                return view('email.mail_success',compact('user'));
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
        else
        {
            return response()->json([
                'message' => 'El usuario no existe',
                'code' => 400,
            ]);
        }

    }

    public function verifyCode(Request $request)
    {
        
        $user = User::find($request->user_id);

       if($user)
       {
        if($user->status === 1)
        {
            return response()->json([
                'message' => 'El usuario ya ha sido verificado',
                'code' => 400,
            ]);
        }
        else
        {
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
            return redirect()->route('verified.view')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        if($request->code == Crypt::decryptString($user->code))
        {
            
            $user->save();

            //si es autenticado
            //cambiar el status a 1
            $user->status = 1;
            //crear otro code
            $user->code = Crypt::encryptString(rand(1000,9999));
            $user->save();
            
            return redirect('/login');
        }
        else
        {
            $validator->errors()->add('code', 'El codigo es incorrecto');
            return redirect()->route('verified.view')
                        ->withErrors($validator)
                        ->withInput();
        }

        }
       } 
       else{
        return response()->json([
            'message' => 'El usuario no existe',
            'code' => 400,
        ]);
       }
    }

    public function resendWhatssap(Request $request)
    {
 
            $user = User::find($request->user_id);

            if($user)
            {
                if($user->email_verified_at === null)
            {
                return response()->json([
                    'message' => 'Tienes primero que activar dar de alta tu correo',
                    'code' => 400,
                ]);
            }      
            else if($user->status === 1)
            {
                return response()->json([
                    'message' => 'El usuario ya ha sido verificado',
                    'code' => 400,
                ]);
            }
            else
            {
                $sid = env('TWILIO_ACCOUNT_SID');
                $token = env('TWILIO_AUTH_TOKEN');

                $code = Crypt::decryptString($user->code);            
                
                //enviar mensaje
                $response = Http::asForm()->withBasicAuth($sid,$token)->post('https://api.twilio.com/2010-04-01/Accounts/'.$sid.'/Messages.json',[
                //'To' => 'whatsapp:+521'.$user->phone_number,
                'To' => 'whatsapp:+5218718458147',
                'From' => 'whatsapp:+'.env('TWILIO_FROM_NUMBER'),
                'Body' => 'Hola '.$user->name.' '.$user->last_name.' tu codigo de verificacion es:'.$code.'',
                ]);   

                if($response->successful())
                {
                    Log::info('Servicio de twilio consumido correctamente para usuari o');
                    //regresar vista de todo bien que vaya a verificar su codigo
                    //vista en la que esta el usuario
                    return redirect('/verified');
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
        else
        {
            return response()->json([
                'message' => 'El usuario no existe',
                'code' => 400,
            ]);
        }


    }
    
    
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    
    
    public function createTicket(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required', // Se agrega el campo 'priority
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('tickets.create.view')
                        ->withErrors($validator)
                        ->withInput();
        }

        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'priority' => $request->priority,
        ]);
        
        $ticket->save();

        if ($ticket->save())
        {
            
            return redirect('/welcome')->with('success', 'Ticket creado con exito');
        }
        else
        {
            return redirect()->route('tickets.create.view');            
        }

    }

    public function editTicket($id,Request $request)
    {
        
       $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required', 
            'user_id' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->route('tickets.edit.view', $id)
            ->withErrors($validator)
            ->withInput();  
        }



        $ticket = Ticket::find($id);
        
        if($ticket)
        {
            $ticket->title = $request->title;
            $ticket->description = $request->description;
            $ticket->priority = $request->priority;
            $ticket->user_id = $request->user_id;
            $ticket->save();

            if ($ticket->save())
            {
                return redirect('/welcome')->with('success', 'Ticket editado con exito');
            }
            else
            {
                return redirect()->route('tickets.create.view');
            }

        }
        else
        {
            return redirect()->route('tickets.create.view');
        }
    }

    public function resolveTicket($id)
    {
        $ticket = Ticket::find($id);
        $ticket->status = 'closed';
        $ticket->closed_at = now();

        $ticket->save();

        return redirect('/welcome')->with('success', 'Ticket resuelto con exito');
    }

    public function deleteTicket($id)
    {
        // Validate the request...
        
        $ticket = Ticket::find($id);
        
        if ($ticket->delete())
        {
            return redirect('/welcome')->with('success', 'Ticket eliminado con exito');
        }
        else
        {
            return redirect()->route('tickets.create.view');            
        }

    }


}

<?php

namespace Dvornikov\TQ;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dvornikov\TQ\File;
use Dvornikov\TQ\Ticket;

class TicketsController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();

        return view('tq::tickets.index', compact('tickets'));
    }

    public function create()
	{
        $id = substr(sha1(mt_rand()), 0, 5);
		return view('tq::tickets.create', compact('id'));
	}

    public function show(Ticket $ticket)
    {
        return view('tq::tickets.show', compact('ticket'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'description' => 'required'
        ]);

        $input = $request->all();

        $ticket = Ticket::create($input);

        if ($request->session()->has($input['_id'].'_photos')) {
            $files = $request->session()->get($input['_id'].'_photos');
            foreach ($files as $value) {
                $file = new File(['filename' => $value['filename']]);
                $ticket->files()->save($file);
            }
        }


        return redirect()->route('tickets.index')->withStatus('Ticket successfully added!');
    }
}

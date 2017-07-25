<?php

namespace App\Http\Controllers;

use Auth;
use App\Complaint;
use App\Device;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{

	public function __construct () 
	{
		Auth();
	}

    public function create (Request $request, $id) {

    	$complaint = new Complaint;
    	$complaint->text = $request->text;
		$complaint->dev_id = Device::where('dev_id', $id)->get()->first()->id;
		$complaint->user_id = Auth::id();
		$complaint->mai_id = $request->mai_id;
		$complaint->fixed = false;
		$complaint->save();

		return redirect('devices')->with('status', 'Complaint Sent.');
    }

    public function show () {
    	$complaints = Complaint::where([
    		'mai_id' => Auth::id(),
    		'fixed' => 0
    	])->orderBy('created_at', 'desc')->get();
		return view('complaints', compact('complaints'));
	}

	public function update (Request $request, $id) {

		$complaint = Complaint::find($id);
		$complaint->feedback = $request->feedback === NULL ? 'The device will be Repaired soon.' : $request->feedback;
		$complaint->save();

		return redirect('complaints')->with('status', 'Feedback Sent.');
	}

	public function delete (Request $request, $id) {

		$complaint = Complaint::where([
			'dev_id' => Device::where('dev_id', $id)->get()->first()->id,
			'fixed' => 0
		])->first();
		$complaint->fixed = 1;
		$complaint->save();

		return redirect('devices')->with('status', 'Device marked as Repaired.');
	}

	public function report () 
	{
		$complaints = Complaint::orderBy('updated_at', 'desc')->get();
		return view('report', compact('complaints'));
	}
}

<?php

namespace App\Http\Controllers;

use App\Participant;
use Illuminate\Http\Request;
use DataTables;

class ParticipantController extends Controller
{
  public function index(Request $request)
  {

      if ($request->ajax()) {
          $data = Participant::latest()->get();
          return Datatables::of($data)
                  ->addIndexColumn()
                  ->make(true);
      }

      return view('welcome', compact('participants'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      Participant::updateOrCreate(['idParticipant' => $request->idParticipant],
              ['nameParticipant' => $request->nameParticipant, 'numberParticipant' => $this->randomnumber()]);

      return response()->json(['success'=>'Participant saved successfully.']);
  }
  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Participant  $product
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $product = Participant::find($id);
      return response()->json($product);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Participant  $product
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      Participant::find($id)->delete();

      return response()->json(['success'=>'Participant deleted successfully.']);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Participant  $product
   * @return \Illuminate\Http\Response
   */
  public function randomnumber()
  {
    $number = mt_rand(1, 11);
    $res = 0;
    if ($this->barcodeNumberExists($number)) {
        return randomnumber();
    }

    // otherwise, it's valid and can be used
    return $number;
  }

  public function barcodeNumberExists($number) {
    // query the database and return a boolean
    // for instance, it might look like this in Laravel
    return Participant::where('numberParticipant', '=', $number)->exists();
  }
}

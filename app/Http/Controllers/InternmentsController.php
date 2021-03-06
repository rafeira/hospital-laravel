<?php

namespace App\Http\Controllers;

use App\Models\Internment;
use App\Models\MedicamentApplication;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InternmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $internments = Internment::all();

        return view('user.historic-patients', ['internments'=>$internments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $patient = Patient::find($request['patientid']);
        if($patient->isInterned()){
            return 'Patient is already interned';
        }else{

            $patient->internments()->create($request->only('disease'));

        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $internment = Internment::find($id);
        if($internment->departure_time != null){

            if($internment->patient->isInterned() == true){

                return 'Patient is already interned';
            }else{
                $internment->departure_time = null;
            }

        }else {
            $internment->departure_time = now();
        }
        $internment->save();
        return  back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function medicaments($id) {

        $applications = Internment::findOrFail($id)->medicamentApplications()->get();
        return view('user.internment-medicaments',['applications'=> $applications]);
    }
}

<?php

namespace App\Http\Controllers;


use auth;
use App\City;
use App\Grade;
use App\Tution;
use App\Subject;
use App\Location;
use Illuminate\Http\Request;

use App\Http\Requests\CreateTutionRequest;
use App\Http\Requests\UpdateTutionRequest;

class TutionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('tution.index')->with('tution',Tution::all())->with('subject',Subject::all())
        ->with('user',auth::user())->with('location',Location::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Tution.PostTution')->with('city',City::all())->with('subject',Subject::all())
        ->with('grade',Grade::all())->with('user',auth::user())->with('location',Location::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
    //dd($request->all());
       
     $cr=Tution::create([
        
         
         'city_id'=>$request->city,
         'description'=>$request->description,
         'status'=>$request->status,
         'user_id'=> auth()->user()->id
        

     ]);
        if($request->subject)
        {
            $cr->subject()->attach($request->subject);
        }
        if($request->grade)
        {
            $cr->grade()->attach($request->grade);
        }
        if($request->location)
        {
            $cr->location()->attach($request->location);
        }
       return redirect(route('tution.index'));
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
    public function edit(Tution $tution)
    {
        //
        return view('Tution.create')->with('tution',$tution)->with('city',City::all())
        ->with('subject',Subject::all())->with('grade',Grade::all())->with('user',auth::user())
        ->with('location',Location::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tution $tution)
    {
        //
        
        $cr=Tution::find($tution->id);
        $cr->city_id=$request->input('city');
        $cr->status=$request->input('status');

       // $cr->location=$request->input('location');
        $cr->description=$request->input('description');
        $cr->location()->sync($request->location);
        $cr->subject()->sync($request->subject); 

        $cr->grade()->sync($request->grade); 
        $cr->save();
        session()->flash('success','Tution updated Successfully.');
        return redirect(route('tution.index'));

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
        $cr=Tution::find($id);
        $cr->delete($id);

        session()->flash('success','Tution Deleted Successfully.');
        return redirect(route('tution.index'));
    }
}

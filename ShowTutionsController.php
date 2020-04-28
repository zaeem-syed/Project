<?php

namespace App\Http\Controllers;

use auth;
use App\City;
use App\User;
use App\Grade;
use App\Tution;
use App\Subject;
use App\Location;
use Illuminate\Http\Request;

class ShowTutionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $search=request()->query('search');
        
        if($search)
        {
            $city = City::where('name', request()->query('search'))->first();
            $tution = Tution::where('city_id', $city->id)->paginate(1);

           return view('ShowTutions.AllTutions')->with('tution',$tution)
        ->with('user',User::all())->with('city',City::all());   

        }
       
        
        else
        {
            return view('ShowTutions.AllTutions')->with('tution',Tution::Paginate(3))
            ->with('user',User::all())->with('city',City::all())
            ->with('subject',Subject::all());
        }     
       
      
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tution $tution)
    {
        //
        return view('ShowTutions.SingleTution')->with('tution',$tution)
        ->with('user',auth::user());
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
        //
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
    public function city(City $city)
    {
        $search=request()->query('search');
        if($search)
        {
            $tution=$city->tution()->where('name','LIKE',"%{$search}%")->Paginate(2);
            return view('ShowTutions.City')->with('city',City::all())->with('tution',$tution);
        }
        else
        {
            $tution=$city->tution()->Paginate(2);
        }
        return view('ShowTutions.City')->with('city',City::all())->with('tution',$tution);
    }
}

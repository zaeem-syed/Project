<?php

namespace App\Http\Controllers;

use auth;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $city=request()->query('city');
        $sub=request()->query('subject');
        if($city)
        {   
           $city1 = City::where('name', $request->query('city'))->first();
            $subject = Subject::where('name', $request->query('subject'))->first();
            $user=User::join('cities', 'city_id', 'id')->join('subjects', 'user_id', 'id')
            ->where('cities.id', $request->query('city'))
            ->where('specific_subjects.subject_id', $request->query('subject'))
            ->get();
            return view('Profile.alluser')->with('status',$user);
        }

        

        $status=User::where('status','=','teacher')->paginate(3);
    
        return view('Profile.alluser')->with('status',$user);
        
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
    public function show(User $user)
        {
        //
        return view('Profile.SingleProfile')
        ->with('user',$user->load('Ratings'));


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
}

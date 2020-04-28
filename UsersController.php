<?php

namespace App\Http\Controllers;

use auth;
use Image;
use App\City;
use App\User;
use App\Grade;
use App\Subject;
use App\Location;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
        //
        return view('user.index')
        ->with('user',auth::user())
        ->with('subject',Subject::all())
        ->with('city',City::all())
        ->with('grade',Grade::all())
        ->with('location',Location::all());
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
    public function update(Request $request,User $user)
    {
        //
      

        
        $up=User::find($user->id);
        $up->experince=$request->input('experince');
        $up->city_id=$request->input('city');
        $up->status=$request->input('account-type-radio');
        $up->gender=$request->input('gender');
        $up->Insta1=$request->input('Insta1');
        $up->Insta2=$request->input('Insta2');
        $up->degree1=$request->input('degree1');
        $up->degree2=$request->input('degree2');
        $up->year1=$request->input('year1');
        $up->year2=$request->input('year2');
        $up->save();
        if($request->subject)
        {
            $up->subject()->attach($request->subject);
        }
        if($request->grade)
        {
            $up->grade()->attach($request->grade);
        }
        if($request->location)
        {
            $up->location()->attach($request->location);
        }
       
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
    }
    public function ImageUpload(Request $request, $id) 

    {
        $maj=User::find($id);
        if($request->hasfile('image'))
        {
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time() ."." . $extension;
            $file->move('uploads/maj',$filename);
            $maj->image=$filename;
   
        }
        
        $maj->save();
        return redirect(route('user.index'));
        
    }
    public function ProfileUpdate(Request $request ,User $user)
    {
        $up=User::find($user->id);
        $up->experince=$request->input('experince');
        $up->city_id=$request->input('city');
        $up->status=$request->input('account-type-radio');
        $up->gender=$request->input('gender');
        $up->Insta1=$request->input('Insta1');
        $up->Insta2=$request->input('Insta2');
        $up->degree1=$request->input('degree1');
        $up->degree2=$request->input('degree2');
        $up->year1=$request->input('year1');
        $up->year2=$request->input('year2');
        $up->location()->sync($request->location);
        $up->subject()->sync($request->subject); 

        $up->grade()->sync($request->grade); 
        $up->save();
       // $up->save();
        return redirect(route('user.index'));

    }

}

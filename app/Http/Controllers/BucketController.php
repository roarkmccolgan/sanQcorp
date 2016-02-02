<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Carbon\Carbon;
use App\Bucket;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BucketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buckets = Bucket::all();
        return view('buckets.index', compact('buckets'));
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
        $input = $request->all();
        $name = explode("@",$input['sender']);
        $user = User::where('email',$input['sender'])->get();
        if(!$user->isEmpty()){
            Bucket::create([
                'username'=>$name[0],
                'fromEmail'=>$input['sender'],
                'message'=>$input['subject'],
                'calendar'=>Carbon::now(),
                'user_id' =>$user->id
            ]);
        }

        
        //return $input;
        //$input['calendar'] = Carbon::now();

        //Bucket::create($input);
        return (new Response('success', 200));
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

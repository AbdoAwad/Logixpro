<?php

namespace App\Http\Controllers;

use App\Demand;
use Illuminate\Http\Request;

class DemandController extends Controller
{
    public function index(Request $request)
    {
        $demands = Auth()->User()->demands->all();
        
        $passDemands = Demand::all()->where('user_id', '<' , Auth()->User()->id)->where('level', '>=' , Auth()->User()->id);
        $level = Auth()->User()->id-1; 

        if($request->ajax()) {
            $response ='
                        <div class="container-fluid mb-3">
	                        <div class="row clearfix">
		                        <div class="col-12">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-request">
                                        <i class="fa fa-plus mr-1"></i> Create Request
                                    </button>
                                </div>
                            </div>
                        <div class="section-body mt-3">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-header">
                <h3 class="card-title">My Requests</h3>
            </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table_custom border-style spacing5">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Level</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th> Action </th?
                                    </tr>
                                </thead>
                                <tbody>
                                ';
                                foreach($demands as $demand){
                                    $response = $response .'
                                        <tr>
                                            <td>'.$demand->title.'</td>
                                            <td>'.$demand->level.'</td>
                                            <td>'.$demand->status.'</td>
                                            <td>'.date('d-m-Y', strtotime($demand->created_at)).'</td>
                                            <td class="actions">
                                                <a class="btn btn-sm btn-icon on-default m-r-5 button-edit" href=""><i class="feather  fa fa-eye"></i></a>
                                                ';
                                                if($demand->level == Auth()->User()->id +1){
                                                    $response = $response .'
                                                    <a class="btn btn-sm btn-icon on-default m-r-5 button-edit" href=""><i class="icon-trash" aria-hidden="true"></i></a>
                                                    <a class="btn btn-sm btn-icon on-default m-r-5 button-edit" href=""><i class="icon-pencil" aria-hidden="true"></i></a>
                                                ';
                                            }
                                            $response = $response .'
                                                
                                            </td>
                                        </tr>
                                    ';
                                }
                                $response = $response .'
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>                
        </div>        </div>
        ';
        if (Auth()->User()->id != 1){
            $response = $response .'
            <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-header">
                <h3 class="card-title">Requests Passed From Level '.$level.'</h3>
            </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table_custom border-style spacing5">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Level</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th> Action </th?
                                    </tr>
                                </thead>
                                <tbody>
                                ';
                                foreach($passDemands as $demand){
                                    $response = $response .'
                                        <tr>
                                        <td>'.$demand->title.'</td>
                                        <td>'.$demand->level.'</td>
                                        <td>'.$demand->status.'</td>
                                        <td>'.date('d-m-Y', strtotime($demand->created_at)).'</td>
                                            <td class="actions">
                                                <a class="btn btn-sm btn-icon on-default m-r-5 button-edit" href=""><i class="feather  fa fa-eye"></i></a>
                                                ';
                                                if($demand->level == Auth()->User()->id ){
                                                $response = $response .'
                                                    <a class="btn btn-sm btn-icon on-default m-r-5 button-edit" href=""><i class="icon-pencil" aria-hidden="true"></i></a>
                                                ';
                                            }
                                            $response = $response .'
                                            </td>
                                        </tr>
                                    ';
                                }
                                $response = $response .'
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>                
        </div>
        </div>
                        ';
        }
        
            return $response;
        };
        return view('Requests.index', compact('demands'));
    }

    

    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|max:191',
            'items' => 'required',
            'quantities' => 'required',
        ]);

        if (sizeof( $request->items ) != sizeof( $request->quantities ) ){
            return response()->json([
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Check your input'
            ]);
        }

        for($i = 0; $i < sizeof( $request->items ); ++$i){
            if ($request->items[$i] && !$request->quantities[$i]){
                return response()->json([
                    'status' => 'error',
                    'title' => 'Error',
                    'message' => 'Check your input, Entered Itenm with no quantity'
                ]);
            }
            elseif(!$request->items[$i] && $request->quantities[$i]){
                return response()->json([
                    'status' => 'error',
                    'title' => 'Error',
                    'message' => 'heck your input, Entered quantity with no item'
                ]);
            }
        }
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'title' => 'Error',
                'message' => $validator->errors()->first()
            ]);
        }




       




        $demand = auth()->user()->demands()->create([
            'title' => $request->title,
            'level' =>  Auth()->User()->id+1,
            'status' =>  Auth()->User()->id-1,
        ]);

        for($i = 0; $i < sizeof( $request->items )-1; ++$i){
            $demand->items()->create([
                'name' => $request->items[$i],
                'quantity' =>  $request->quantities[$i],
                'status' =>  Auth()->User()->id-1,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'title' => 'Success',
            'message' => 'Data successfully added.'
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}

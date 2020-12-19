<?php

namespace App\Http\Controllers;

use App\Demand;
use App\Item;

use Illuminate\Http\Request;

class DemandController extends Controller
{
    public function index(Request $request)
    {
        $demands = Auth()->User()->demands()->where('level' ,'<',5 );
        
        $passDemands = Demand::all()->where('user_id', '<' , Auth()->User()->id)->where('level', '>=' , Auth()->User()->id)->where('level' ,'<',5 );
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

    ';

    if(Auth()->User()->id < 4){
        $response = $response .'
    
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
                                            <td>'.date('d-m-Y', strtotime($demand->created_at)).'</td>
                                            <td class="actions">
                                                <a class="btn btn-sm btn-icon on-default m-r-5 button-edit" href="'.route('demand.items', $demand->id).'"><i class="feather  fa fa-eye"></i></a>
                                                ';
                                                if($demand->level == Auth()->User()->id +1){
                                                    $response = $response .'
                                                    <a class="btn btn-sm btn-icon on-default m-r-5 button-edit" href="'.route('demand.items', $demand->id).'"><i class="icon-pencil" aria-hidden="true"></i></a>
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
        }
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
                                        <td>'.date('d-m-Y', strtotime($demand->created_at)).'</td>
                                            <td class="actions">
                                                <a class="btn btn-sm btn-icon on-default m-r-5 button-edit" href="'.route('demand.items', $demand->id).'"><i class="feather  fa fa-eye"></i></a>
                                                ';
                                                if($demand->level == Auth()->User()->id || $demand->level-1 == Auth()->User()->id){
                                                $response = $response .'
                                                    <a class="btn btn-sm btn-icon on-default m-r-5 button-edit" href="'.route('demand.items', $demand->id).'"><i class="icon-pencil" aria-hidden="true"></i></a>
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
        $demand =  Demand::findOrFail($request->id);
        $items = $demand->items;
        $status = ["", "Accepted", "Rejected", "Changed the value" ];
        

        if($request->ajax()) {
            if ($demand->level-1 > Auth()->User()->id){
                $response ='
                <div class="section-body mt-3">
                    <div class="container-fluid">
                        <div class="tab-content mt-3">
                            <div class="tab-pane fade show active" id="Departments-list" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Items List</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-vcenter table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                ';
                                                foreach($items as $item){
                                                    $response = $response . '
                                                    <tr>
                                                        <td>'.$item->name.'</td>
                                                        <td>'.$item->quantity.'</td>
                                                    </tr>

                                                    ';
                                                }

                                                $response = $response .'
                                </div>
                            </div>
                        </div>
                    </div>            
                </div> 
                            ';

            }
            else{
                $response ='
                    
                ';
                $i =0;
                foreach($items as $item){
                    $response = $response. '
                    <div class="card ">
                    <div class="card-header">
                            <h3 class="card-title">Edit Item</h3>
                        </div>
                        <div class="card-body">
                            <div class="row clearfix p-2">
                                <div class="col-sm-6">
                                <div class="form-group ">
                                        <div class="form-group ">
                                            <label class="form-label">Item</label>
                                            ';
                                            if(Auth()->User()->id == $demand->level-1 || Auth()->User()->id == 2 ||Auth()->User()->id == $demand->level){
                                                $response = $response. '
                                                <input name="items[]" autocomplete="off" required type="text" class="form-control circle"  value="'.$item->name .'">
                                            
                                                ';
                                            }
                                            else {
                                                $response = $response. '
                                                <input name="items[]" autocomplete="off" disabled type="text" class="form-control circle"  value="'.$item->name .'">
                                                <input name="items[]" autocomplete="off" hidden type="text" class="form-control circle"  value="'.$item->name .'">

                                            ';
                                            }
                                            $response = $response. '
                                        </div>
                                        <input name="ids[]" autocomplete="off" hidden type="text" class="form-control circle"  value="'.$item->id .'">
                                    </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group ">
                                        <div class="form-group ">
                                            <label class="form-label">Quantity</label>
                                        ';
                                        if(Auth()->User()->id == $demand->level-1 || Auth()->User()->id == 2|| Auth()->User()->id == $demand->level){
                                            $response = $response. '
                                            <input name="quantities[]" autocomplete="off" required type="text" class="form-control circle"  value="'.$item->quantity .'">
                                        ';
                                        }
                                        else {
                                            $response = $response. '
                                            <input name="quantities[]" autocomplete="off" disabled type="text" class="form-control circle"  value="'.$item->quantity .'">
                                            
                                            <input name="quantities[]" autocomplete="off" hidden type="text" class="form-control circle"  value="'.$item->quantity .'">
                                        ';
                                        }
                                        $response = $response. '
                                        </div>
                                    </div>
                                </div>
                            ';
                            if($demand->user_id != Auth()->User()->id){
                                $response = $response .'
                                <div class="col-sm-12">

                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" id ="status_'.$i.'_1" name="status_'.$i.'" value="1" class="selectgroup-input" checked="">
                                            <span class="selectgroup-button">Accepte</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" id ="status_'.$i.'_2" name="status_'.$i.'" value="2" class="selectgroup-input">
                                            <span class="selectgroup-button">Reject</span>
                                        </label>
                                        ';
                                        if(Auth()->User()->id ==2){
                                            $response = $response .'
                                        <label class="selectgroup-item">
                                            <input type="radio" id ="status_'.$i.'_3" name="status_'.$i.'" value="3" class="selectgroup-input">
                                            <span class="selectgroup-button">Change Value</span>
                                        </label>
                                        ';
                                        }
                                        $response = $response .'
                                    </div>
                                </div>
                                <label class="form-label">Last Level '.$status[$item->status].'</label>

                                
                            </div>
                                ';
                            }
                            $response = $response .' 
                        </div>
                    </div>
                    </div>
                ';
                ++$i;
                }
            }
            return $response;
        }
        
        $number = count($items);
        return view('Requests.view', compact('demand', 'number'));
    }

    
    public function update(Request $request)
    {
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
        $demand = Demand::findOrFail($request->id);
        if(Auth()->User()->id == $demand->level){
            $demand->update([
                'title' => $demand->title,
                'level' =>  $demand->level +1,
                'status' =>  Auth()->User()->id-1,
            ]);
        }

        $j = 0;

        for($i = 0; $i < sizeof( $request->ids ); ++$i){
            $name = 'status_' .$j;
            $item = Item::findOrFail($request->ids[$i]);
            $item = Item::findOrFail($request->ids[$i])->update([
                'name' => $request->items[$i],
                'quantity' =>  $request->quantities[$i],
                'status' =>  ($request->$name ? $request->$name: 0),
            ]);
            ++$j;
        }

        return response()->json([
            'status' => 'success',
            'title' => 'Success',
            'message' => 'Data successfully added.'
        ]);
        
        
    }
    



    public function createItem(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'item' => 'required',
            'quantity' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'title' => 'Error',
                'message' => $validator->errors()->first()
            ]);
        }

        $demand =  Demand::findOrFail($request->id);
    
        $demand->items()->create([
            'name' => $request->item,
            'quantity' =>  $request->quantity,
            'status' =>  Auth()->User()->id-1,
        ]);
        

        return response()->json([
            'status' => 'success',
            'title' => 'Success',
            'message' => 'Data successfully added.'
        ]);
    }
}



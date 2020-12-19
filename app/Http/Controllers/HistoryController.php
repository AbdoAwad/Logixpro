<?php

namespace App\Http\Controllers;
use App\Demand;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request){
        $demands = Demand::all()->where('level' ,'>',4 )->where('user_id' , Auth()->User()->id);
        $passedDemands = Demand::all()->where('level' ,'>',4 )->where('user_id' ,'<', Auth()->User()->id);

        return view('history.index', compact('demands', 'passedDemands'));

    }

    public function show(Request $request){
        $demand = Demand::findOrFail($request->id);
        $items = $demand->items;
        $status = ['ACCEPTED', 'REJACTE'];

        return view('history.view', compact('demand', 'items', 'status'));

    }
}

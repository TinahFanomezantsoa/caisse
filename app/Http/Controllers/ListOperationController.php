<?php
 
namespace App\Http\Controllers;

use App\Models\OperationType;
use Illuminate\Http\Request;
 
class ListOperationController extends Controller
{
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $operationTypes = OperationType::all();

        return view('list-operation', ['operationTypes' => $operationTypes]);
    }

    public function create(Request $request) {

        $operationType = new OperationType();

        $operationType->name = $request->name;

        $operationType->is_ajout = $request->mode == 'ajout' ? true : false;

        $operationType->save();

        return redirect()->route('list-operation');

    }

    public function update(Request $request) {
        $operationType = OperationType::find($request->id);

        $operationType->name = $request->name;

        $operationType->is_ajout = $request->mode == 'ajout' ? true : false;

        $operationType->save();

        return redirect()->route('list-operation');
        
    }

    public function delete(Request $request) {
        $operationType = OperationType::find($request->delete_id);
        $operationType->delete();

        return redirect()->route('list-operation');

    }
}
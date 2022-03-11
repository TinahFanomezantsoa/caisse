<?php
 
namespace App\Http\Controllers;

use App\Constants\Money as ConstantMoney;
use App\Models\Money;
use App\Models\Operation;
use App\Models\OperationType;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {

        //Get operationType
        $operationTypes = OperationType::all();

        $operationId = intval($request->id);
        $operation = new Operation();

        $moneysResult = [];

        if ($operationId) { 
            $operation = Operation::find($operationId);

            $moneys = $operation->moneys;

            //Format moneys

            foreach($moneys as $money) {
                $res = [];
                $res['id'] = $money->id;
                $res['type'] = $money->type;
                $res['nominal'] = $money->nominal;
                $res['quantity'] = $money->quantity;

                $moneysResult[] = $res;
            }

        }

        return view('operation',[
            'MONEY_BILLET' => ConstantMoney::$BILLET,
            'MONEY_PIECE' => ConstantMoney::$PIECE,
            'MONEY_CENTIME' => ConstantMoney::$CENTIME,
            'operationTypes' => $operationTypes,
            'operation' => $operation,
            'moneys' => json_encode($moneysResult)
        ]);
    }



    public function save(Request $request) {

        $operation = null;

        if ($request->operation_id) {
            $operation = Operation::find($request->operation_id);

        } else {
            $operation = new Operation();
        }

        $operation->date = $request->date;

        $operation->operation_type_id = $request->operation_type_id;

        $operation->note = $request->note;

        if ($operation->save()) {
            // Save moneys now 
            $moneys = json_decode($request->moneys,true);

            foreach($moneys as $key => $money) {
                $record = null;
                if (isset($money['id']) && intval($money['id']) > 0) {
                    $record = Money::find(intval($money['id']));

                } else {
                    $record = new Money();

                }
                $record->operation_id = $operation->id;
                $record->type = $money['type'];
                $record->nominal = $money['nominal'];
                $record->quantity = $money['quantity'];

                $record->save();
                
            }

        }


        return redirect()->route('dashboard');

    }
    


}
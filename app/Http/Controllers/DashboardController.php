<?php
 
namespace App\Http\Controllers;

use App\Models\Operation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $operations = null;

        if(!$request->date) {
            $operations = Operation::whereDate('date', Carbon::today())->get();
        } else {
            $operations = Operation::whereDate('date', $request->date)->get();

        }

        $totals = [
            'retrait' => 0,
            'ajout' => 0
        ];

        foreach($operations as $operation) {
            //get montant
            $query = DB::select('SELECT SUM(quantity * nominal) as montant FROM moneys WHERE operation_id = ?', [$operation->id]);
            $operation->total = $query[0]->montant;

            if($operation->operationType->is_ajout) {
                $totals['ajout'] += $operation->total;

            } else {
                $totals['retrait'] += $operation->total;
            }
        }

        return view('dashboard', ['operations' => $operations, 'totals' => $totals]);
    }

    public function deleteOperation(Request $request) {
        $operation = Operation::find($request->delete_id);

        $operation->delete();

        return redirect()->route('dashboard');

    }
}
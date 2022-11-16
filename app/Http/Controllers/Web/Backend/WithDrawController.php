<?php 
namespace VanguardLTE\Http\Controllers\Web\Backend
{
    class WithDrawController extends \VanguardLTE\Http\Controllers\Controller
    {
        public function __construct()
        {
            $this->middleware('auth');
            $this->middleware('permission:withdraw.manage');
        }
        public function index(\Illuminate\Http\Request $request)
        {
            $transactions =  \VanguardLTE\Transaction::leftJoin('users','users.id','=','transactions.user_id')
                                                    ->where('transactions.type','out')
                                                    ->get();
            foreach ($transactions as $transaction) {
                $transaction->wager_count = \VanguardLTE\StatGame::where('user_id', $transaction->user_id)->count();
                $wager = \VanguardLTE\StatGame::where('user_id', $transaction->user_id)->sum('bet');
                $transaction->wager = $wager;
                if($wager > 28000){
                    $transaction->approve = true;
                }else{
                    $transaction->approve = false;
                }

            }
            return view('backend.withdraw.list', compact('transactions'));
        }
        public function reject($id)
        {
            $reject =  \VanguardLTE\Transaction::leftJoin('users','users.id','=','transactions.user_id')
                                                    ->where('transactions.type','out')
                                                    ->where('transactions.id', $id)
                                                    ->get();
            return view('backend.withdraw.reject', compact('reject'));                                        
        }
        public function edit_reject(Request $request, $id)
        {
            $reject = \VanguardLTE\Transaction::find($id);
            $reject->reject_comment = $request->reject_text;
            $reject->status = 2;
            $reject->save();
            return redirect()->route('backend.withdraw.list')->withSuccess(trans('app.reject_success'));
        }
    }

}
namespace 
{
    function onkXppk3PRSZPackRnkDOJaZ9()
    {
        return 'OkBM2iHjbd6FHZjtvLpNHOc3lslbxTJP6cqXsMdE4evvckFTgS';
    }

}

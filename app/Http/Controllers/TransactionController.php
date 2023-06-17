<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Http\Requests\TransactionRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('transactions.index');
    }

    public function getTransactions(): View
    {
        $transactions = Auth::user()->role == 'admin' ? DB::table('transactions')->paginate(15) :
                        DB::table('transactions')->where('cashier_id', Auth::user()->id)->paginate(15);
        return view('transactions.index', ['transactions' => $transactions]);
    }

    public function createTransactionPage()
    {
        if (!session()->has('items')) {
            return redirect('/home')->with('status', [
                'message' => 'No items in cart'
            ]);
        }
        $total_amount = 0;
        $items = session()->get('items');
        foreach ($items as $item) {
            $total_amount += $item['total_amount'];
        }
        return view('transactions.create', ['total_amount' => $total_amount]);
    }

    public function createTransaction(TransactionRequest $request)
    {
        $total_amount = $request->total_amount * (100 - $request->discount) / 100;
        $transaction = Transaction::create([
            'discount' => $request->discount ?? 0,
            'transaction_method' => $request->transaction_method,
            'total_amount' => $total_amount,
            'cashier_id' => auth()->user()->id,
        ]);

        $items = session()->get('items');
        foreach ($items as $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total_amount' => $item['total_amount'],
            ]);
        }

        session()->forget('items');
        return redirect('/transactions')->with('status', [
            'message' => 'Transaction successfully created'
        ]);

    }

    public function getTransaction($id)
    {
        $transaction = Transaction::find($id);
        return view('/transactions.items', ['transaction' => $transaction]);
    }

    public function getTransactionsByMonth(Request $request)
    {
        $month = $request->month;
        $transactions = DB::table('transactions')
            ->whereYear('created_at', 2023)
            ->whereMonth('created_at', $month)
            ->get();
        return view('/transactions.report', ['transactions' => $transactions]);
    }
}

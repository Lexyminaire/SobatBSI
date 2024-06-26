<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Display all transactions
    public function index()
    {
        $transactions = Transaction::with('user', 'detailTransactions.menu')->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    // Show a specific transaction
    public function show($id)
    {
        $transaction = Transaction::with('user', 'detailTransactions.menu')->findOrFail($id);
        $total = $transaction->detailTransactions->sum(function ($detail) {
            return $detail->menu->price * $detail->qty; // Assuming each menu item has a 'price' attribute
        });

        return view('admin.transactions.show', compact('transaction', 'total'));
    }

    // Update the payment status of a transaction
    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|string'
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->payment_status = $request->payment_status;
        $transaction->save();

        return redirect()->route('admin.transactions.index', $transaction->id)
            ->with('success', 'Payment status updated successfully.');
    }
}

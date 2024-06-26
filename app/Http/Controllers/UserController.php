<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DetailTransaction;
use Illuminate\Http\Request;
use App\Models\Transaction;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|integer',
        ]);

        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role_id' => $request->get('role_id'),
        ]);
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User saved!');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|integer',
        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }
        $user->role_id = $request->get('role_id');
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted!');
    }

    public function changeRole(Request $request, $userId)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($userId);
        $user->role_id = $request->input('role_id');
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Role changed');
    }
    
    public function order()
    {
        $user_id = auth()->user()->id;
        $transaction = Transaction::where('user_id', $user_id)->where('payment_status', 'unpaid')->latest()->first();
        if ($transaction) {
            $details = DetailTransaction::where('transaction_id', $transaction->id)->get();
            return view('user.order.index', compact('details'));
        } else {
            return view('user.order.index');
        }
    }

    public function addOrder(Request $request)
    {
        $user_id = auth()->user()->id;
        $transaction = Transaction::where('user_id', $user_id)->latest()->first();

        if (!$transaction || $transaction->payment_status != 'unpaid') {
            $transaction = new Transaction();
            $transaction->user_id = $user_id;
            $transaction->payment_status = 'unpaid';
            $transaction->save();
        }

        $transactionId = $transaction->id;
        $validatedData = $request->validate([
            'menu_id' => 'required',
            'qty' => 'required|integer|min:1',
        ]);

        $existingDetailTransaction = DetailTransaction::where('transaction_id', $transactionId)
            ->where('menu_id', $validatedData['menu_id'])
            ->first();

        if ($existingDetailTransaction) {
            $existingDetailTransaction->qty += $validatedData['qty'];
            $existingDetailTransaction->save();
        } else {
            $validatedData['transaction_id'] = $transactionId;
            DetailTransaction::create($validatedData);
        }

        return redirect()->route('user.menu.index')->with('success', 'Order added successfully.');
    }

    public function deleteOrder($id)
    {
        $order = DetailTransaction::findOrFail($id);

        if (auth()->id() !== $order->transaction->user_id) {
            return back()->with('error', 'You do not have permission to delete this order.');
        }

        $order->delete();

        return redirect()->route('user.order')->with('success', 'Order deleted successfully.');
    }

    public function updateQuantity(Request $request, $id)
    {
        $detail = DetailTransaction::findOrFail($id);
        $quantity = $request->input('quantity', 0);
        if ($quantity <= 0) {
            $detail->delete();
            return back()->with('success', 'Order detail deleted successfully.');
        } else {
            $detail->qty = $quantity;
            $detail->save();
            return back()->with('success', 'Quantity updated successfully.');
        }
    }

    public function history()
    {
        $user_id = auth()->user()->id;
        $transactions = Transaction::where('user_id', $user_id)->where('payment_status', 'paid')->get();
        $histories = $transactions->map(function ($transaction) {
            $details = $this->getTransactionDetails($transaction);
            return array_merge(['transaction_id' => $transaction->id], $details);
        });
        return view('user.history.index', compact('histories'));
    }

    public function showHistory($transactionId)
    {
        $user_id = auth()->user()->id;
        $transaction = Transaction::where('id', $transactionId)
            ->where('user_id', $user_id)
            ->where('payment_status', 'paid')
            ->firstOrFail();

        $details = $this->getTransactionDetails($transaction, true);

        $totalPayment = collect($details)->sum('total_price');

        return view('user.history.show', compact('details', 'totalPayment'));
    }

    private function getTransactionDetails($transaction, $isSingle = false)
    {
        $details = DetailTransaction::where('transaction_id', $transaction->id)
            ->get()
            ->map(function ($detail) use ($isSingle) {
                $formattedDetail = [
                    'transaction_id' => $detail->transaction_id,
                    'qty' => $detail->qty,
                    'total_price' => $detail->qty * $detail->menu->price,
                    'menu' => $isSingle ? null : $detail->menu
                ];
                if ($isSingle) {
                    $formattedDetail['menu_name'] = $detail->menu->name;
                    $formattedDetail['price'] = $detail->menu->price;
                }
                return $formattedDetail;
            });
    
        if (!$isSingle) {
            return [
                'total_items' => $details->sum('qty'),
                'top_item' => $details->sortByDesc('total_price')->first(),
                'total_price' => $details->sum('total_price')
            ];
        }
        return $details->values()->all();
    }
}


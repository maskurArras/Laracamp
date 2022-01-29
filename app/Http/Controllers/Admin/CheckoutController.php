<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function update(Request $request, Checkout $checkout)
    {
        // merubah status is_paid dari false menjadi true
        $checkout->is_paid = true;
        $checkout->save();
        // memberikan pesan checkout telah diupdate
        $request->session()->flash('success', "Checkout with ID {$checkout->id} has been updated!");
        return redirect(route('admin.dashboard'));
    }
}

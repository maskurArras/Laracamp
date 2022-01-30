<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;
// menggunakan mail
use Mail;
// menggunakan Paid untuk send mail to user
use App\Mail\Checkout\Paid;

class CheckoutController extends Controller
{
    public function update(Request $request, Checkout $checkout)
    {
        // merubah status is_paid dari false menjadi true
        $checkout->is_paid = true;
        $checkout->save();

        // sand email to user
        Mail::to($checkout->User->email)->send(new Paid($checkout));

        // memberikan pesan checkout telah diupdate
        $request->session()->flash('success', "Checkout with ID {$checkout->id} has been updated!");

        return redirect(route('admin.dashboard'));
    }
}

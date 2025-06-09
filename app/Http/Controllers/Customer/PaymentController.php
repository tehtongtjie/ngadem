<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer\Payment;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $payments = Payment::whereHas('order', function ($query) {
                            $query->where('user_id', Auth::id());
                        })
                        ->with('order')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('pages.customer.payments.index', compact('payments'));
    }

    /**
     * 
     *
     * @param  \App\Models\Customer\Payment 
     * @return \Illuminate\View\View
     */
    public function show(Payment $payment)
    {
        $payment->load('order');

        if ($payment->order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan melihat detail pembayaran ini.');
        }

        return view('pages.customer.payments.show', compact('payment'));
    }

    /**
     *
     *
     *
     * @param  \App\Models\Customer\Payment  $payment
     * @return \Illuminate\View\View
     */
    public function uploadProof(Payment $payment)
    {
        if ($payment->order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan mengunggah bukti pembayaran ini.');
        }
        if ($payment->status_pembayaran === 'berhasil') {
            return redirect()->route('customer.payments.show', $payment->id)
                             ->with('error', 'Pembayaran ini sudah berhasil dikonfirmasi.');
        }

        return view('pages.customer.payments.upload-proof', compact('payment'));
    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request
     * @param  \App\Models\Customer\Payment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeProof(Request $request, Payment $payment)
    {
        if ($payment->order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan mengunggah bukti pembayaran ini.');
        }
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($payment->bukti_pembayaran) {
            Storage::disk('public')->delete($payment->bukti_pembayaran);
        }

        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            
            if ($path) {
                $payment->bukti_pembayaran = $path;
                $payment->status_pembayaran = 'pending';
                $payment->save();

                return redirect()->route('customer.payments.show', $payment->id)
                                 ->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu konfirmasi admin.');
            } else {
                return redirect()->back()->with('error', 'Gagal mengunggah bukti pembayaran. Coba lagi!');
            }
        }
    }
}

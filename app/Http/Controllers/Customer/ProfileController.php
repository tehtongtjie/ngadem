<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        return view('pages.customer.profile.index', compact('user'));
    }

    /**
     * 
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        return view('pages.customer.profile.edit', compact('user'));
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',

            'current_password' => 'nullable|required_with:password|current_password',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        try {
            $user->save();
            return redirect()->route('customer.profile.index')->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            \Log::error('Error updating customer profile: ' . $e->getMessage(), ['user_id' => $user->id, 'request_data' => $request->all()]);
            return redirect()->back()->with('error', 'Gagal memperbarui profil: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('pages.customer.profile.index', compact('user'));
    }
}

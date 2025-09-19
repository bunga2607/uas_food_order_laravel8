<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Tampilkan form edit kontak di admin
    public function edit()
    {
        $contact = Contact::first();
        return view('admin.kontak', compact('contact'));
    }

    // Update kontak dari admin
    public function update(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|min:10',
            'email' => 'required|email',
            'bank_account' => 'required|string|min:5',
        ]);

        $contact = Contact::first();
        if (!$contact) {
            $contact = new Contact();
        }

        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->bank_account = $request->bank_account;
        $contact->save();

        return redirect()->route('admin.kontak.edit')->with('success', 'Kontak berhasil diperbarui.');
    }

    // ✅ Ditambahkan: Menampilkan info kontak untuk user
    public function showUser()
    {
        $contact = Contact::first();
        return view('user.kontak', compact('contact'));
    }
}

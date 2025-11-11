<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
    // Kita tidak perlukan constructor kerana middleware sudah ada di routes/web.php

{
    /**
     * Display a listing of the users (ADMIN).
     */
    public function index()
    {
        // Ambil semua user kecuali user yang tengah login sekarang (self-protection)
        $users = User::where('id', '!=', Auth::id())->latest()->get(); 
        
        // Hantar ke view admin
        return view('admin.users.index', compact('users'));
    }

    // Kita buang create() dan store() sebab user register sendiri

    /**
     * Show the form for editing the specified user (ADMIN).
     */
    public function edit(User $user)
    {
        // SELF-PROTECTION: Admin tak boleh edit role/deactivate akaun sendiri
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'Akses ditolak: Anda tidak boleh mengedit role atau status akaun sendiri.');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user (ADMIN).
     */
    public function update(Request $request, User $user)
    {
        // SELF-PROTECTION: Double check sebelum update
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'Akses ditolak: Anda tidak boleh mengemaskini akaun anda melalui borang ini.');
        }

        $validated = $request->validate([
            'role' => ['required', 'string', Rule::in(['admin', 'user'])],
            'is_active' => ['required', 'boolean'],
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);
        
        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Akaun pengguna ' . $user->name . ' berjaya dikemaskini.');
    }

    /**
     * Remove the specified user from storage (ADMIN).
     */
    public function destroy(User $user)
    {
        // SELF-PROTECTION: Admin tak boleh delete akaun sendiri
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'Akses ditolak: Anda tidak boleh memadam akaun anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Akaun pengguna ' . $user->name . ' berjaya dipadam.');
    }
}
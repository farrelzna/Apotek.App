<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required | min:5',
            'email' => 'required |unique:users',
            'password' => 'required |min:5',
        ], [
            'name.required' => 'NAMA HARUS DI ISI !',
            'name.min' => 'NAMA TERLALU PENDEK!',
            'email.required' => 'EMAIL HARUS DI ISI!',
            'email.unique' => 'EMAIL SUDAH TERDAFTAR!',
            'password.min' => 'NAMA TERLALU PENDEK!',
            'password.required' => 'PASSWORD HARUS DI ISI!',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::User();

            if ($user->role === 'Admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login Successfully');
            } elseif ($user->role === 'Apoteker') {
                return redirect()->route('apoteker.dashboard')->with('success', 'Login Successfully');
            } elseif ($user->role === 'Users') {
                return redirect()->route('users.dashboard')->with('success', 'Login Successfully');
            }
        };
        return back()->withErrors([
            'email' => 'email or password incorrect',
        ])->withInput($request->only('email'));

        // return redirect()->route('login')->with('error', 'Invalid email or password');
    }

    // Menampilkan form login
    public function showLogin()
    {
        return view('auth.login'); // Pastikan view 'page-login' sesuai
    }

    // Proses login
    public function processLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek apakah user ada dan password sesuai
        if (Auth::attempt($request->only('email', 'password'))) {
            // Login berhasil, redirect ke halaman apotek (medicines)
            return redirect()->route('home');
        }

        // Jika gagal login
        return redirect()->back()->with('error', 'Akun Belum Terdaftar');
    }

    ///////////////////////////////////////////////////////////////////////////////////

    public function createAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validasi untuk nama
            'email' => 'required|email|unique:users,email',
            'password' => 'required_with:password_confirmation|same:password_confirmation|min:5', // Validasi untuk password dengan konfirmasi
            'password_confirmation' => 'required|min:5', // Validasi untuk konfirmasi password
            'role' => 'required',
        ], [
            'name.required' => 'NAMA HARUS DIISI!',
            'email.required' => 'EMAIL HARUS DIISI!',
            'email.unique' => 'EMAIL SUDAH TERDAFTAR!',
            'password.confirmed' => 'PASSWORD DAN KONFIRMASI PASSWORD TIDAK SESUAI!',
            'password.min' => 'PASSWORD HARUS MINIMAL 5 KARAKTER!',
            'role.required' => 'ROLE HARUS DIISI!',
        ]);

        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password-confirmation' => $request->password_confirmation,
            'role' => $request->role,
        ]);

        Auth::login($user);

        return redirect()->route('users')->with('success', 'Akun Berhasil Dibuat');
    }

    public function showCreateAccount()
    {
        $users = User::all();
        return view('account.create', compact('users'));
    }

    // Proses logout
    public function logout()
    {
        Auth::logout();  // Logout menggunakan facade Auth
        return redirect()->route('login')->with('success', 'Anda sudah logout.');
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function indexProfile(Request $request)
    {
        $users = User::all();
        return view('account.profile', compact('users'));
    }

    public function index(Request $request)
    {
        $users = User::all();
        $users = User::where('name', 'like', '%' . $request->search . '%')->orderBy('name', 'asc')->simplePaginate(5);
        return view('account.index', compact('users'));
    }

    // Menampilkan form register
    public function create()
    {
        return view('auth.register'); // Pastikan view 'page-register' sesuai
    }

    // Proses registrasi
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255', // Menambahkan validasi untuk nama
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role' => 'required',
        ]);

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,  // Menambahkan name
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Login otomatis setelah register
        Auth::login($user);

        // Redirect ke halaman apotek (medicines)
        return redirect()->route('login')->with('success', 'Registrasi berhasil, silahkan login.');
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::where('id', $id)->first();
        //  compact : mengirim data ke blade : compact('namavariable')
        return view('account.edit', compact('users'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'requireD',
            'email' => 'required |min:5',
            'password' => 'required |min:5',
            'role' => 'required',
        ], [
            'name.required' => 'NAMA HARUS DI ISI !',
            'email.required' => 'EMAIL HARUS DI ISI!',
            'email.min' => 'EMAIL MINIMAL 5 KARAKTER!',
            'password.min' => 'PASSWORD TERLALU PENDEK!',
            'password.required' => 'PASSWORD HARUS DI ISI!',
        ]);

        //  mengubah data
        $userBefore = User::where('id', $id)->first();
        $proses = $userBefore->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
        if ($proses) {
            return redirect()->route('users')->with('success', 'Data Berhasil Diubah');
        } else {
            return redirect()->route('users.add')->with('failed', 'Data Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //  menghapus data, mencari dengan where, lalu hapus dengan delete()
        $proses = User::find($id)->delete();
        if ($proses) {
            return redirect()->back()->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->back()->with('failed', 'Data Gagal Dihapus');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Admin_UserController extends Controller
{
     public function index()
    {
         $data = User::select('id','name', 'email', 'jenis_kelamin', 'umur', 'nomor_telepon',)
        ->orderBy('id','DESC')
        ->get();

        return view('layout-dashboard/users/user', [
            'title' => 'ini user',
        ], compact('data'));
    }

    public function tambahDataUser(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'jenis_kelamin' => 'required|in:L,P',
            'umur'          => 'required|integer|min:1',
            'nomor_telepon' => 'required|string|max:20',
            'password'      => 'required|string|min:6',
        ]);

        DB::beginTransaction();
        try {
            User::create([
                'name'           => $validated['name'],
                'email'          => $validated['email'],
                'jenis_kelamin'  => $validated['jenis_kelamin'],
                'umur'           => $validated['umur'],
                'nomor_telepon'  => $validated['nomor_telepon'],
                'password'       => Hash::make($validated['password']),
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Data User berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan User: ' . $e->getMessage());
        }
    }

    public function hapusDataUser(Request $request)
    {
        DB::beginTransaction();
        try {
            $users = User::findOrFail($request->id);
            $users->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Users berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus Users: ' . $e->getMessage());
        }
    }

    public function editDataUser(Request $request)
    {
        $validated = $request->validate([
            'id'            => 'required|exists:users,id',
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $request->id,
            'jenis_kelamin' => 'required|in:L,P',
            'umur'          => 'required|integer|min:1',
            'nomor_telepon' => 'required|string|max:20',
        ]);

        DB::beginTransaction();
        try {
            $user = User::findOrFail($validated['id']);
            $user->update($validated);

            DB::commit();
            return redirect()->back()->with('success', 'Data User berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui User: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'title' => 'Profile'
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'jabatan' => 'required',
        ]);

        $id = $request->id;

        $output = DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'jabatan' => $request->jabatan,
                'nohp' => $request->nohp,
                'alamat' => $request->alamat,
                'biografi' => $request->biografi,
            ]);
        if ($output == true) {
            $response['success'] = true;
            $response['message'] = 'Anda Berhasil Memperbarui Profile Diri';
        } else {
            $response['success'] = false;
            $response['message'] = 'Tidak Terdapat Perubahan Dalam Profile Diri';
        }

        return $response;
    }

    public function changefoto(Request $request)
    {
        $id = auth()->user()->id;
        $request->validate([
            'file_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if (auth()->user()->photo == null) {
            if ($request->hasfile('file_photo')) {
                $filename = $request->file('file_photo')->getClientOriginalName();
                $request->file('file_photo')->move(public_path('assets\profile'), $filename);
                $output = DB::table('users')
                    ->where('id', $id)
                    ->update([
                        'photo' => $filename,
                    ]);
                if ($output == true) {
                    $response['success'] = true;
                    $response['message'] = 'Anda Berhasil Mengupdate Foto Profile';
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Anda Gagal Mengupdate Foto Profile';
                }
            } else {
                $response['success'] = false;
                $response['message'] = 'Hanya dapat menerima jenis file JPEG, JPG, PNG dengan ukuran file maksimal: 2MB';
            }
        } else {
            if (User::where('id', $id)->exists()) {
                if ($request->hasFile('file_photo') && $request->file_photo != '') {
                    $image = User::where('id', $id)->first();
                    $file_path = public_path() . '\assets\profile\\' . $image['photo'];
                    if ($file_path != null) {
                        unlink($file_path);
                    }
                    $filename = $request->file('file_photo')->getClientOriginalName();
                    $request->file('file_photo')->move(public_path('assets\profile'), $filename);
                    $output = DB::table('users')
                        ->where('id', $id)
                        ->update([
                            'photo' => $filename,
                        ]);
                    if ($output == true) {
                        $response['success'] = true;
                        $response['message'] = 'Anda Berhasil Mengupdate Foto Profile';
                    } else {
                        $response['success'] = false;
                        $response['message'] = 'Anda Gagal Mengupdate Foto Profile';
                    }
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Hanya dapat menerima jenis file JPEG, JPG, PNG dengan ukuran file maksimal: 2MB';
                }
            }
        }

        return $response;
    }

    public function changepassword(Request $request)
    {
        $id = $request->id;
        $this->validate($request, [
            'passwordLama' => 'required|string',
            'passwordBaru' => 'required|string',
            'konfirmasiPassword' => 'required|string'
        ]);
        $auth = DB::table('users')->find($id);

        $passwordbaru = preg_replace("/[^a-zA-Z0-9]/", "", $request->passwordBaru);
        $konfirmasipassword = preg_replace("/[^a-zA-Z0-9]/", "", $request->konfirmasiPassword);

        $data = strlen($passwordbaru);
        $data2 = strlen($konfirmasipassword);

        if ($data < 6 && $data2 < 6) {
            $response['success'] = false;
            $response['message'] = 'Password harus berisi minimal 6 karakter';
            return $response;
        }

        // The passwords matches
        if (!Hash::check($request->get('passwordLama'), $auth->password)) {
            $response['success'] = false;
            $response['message'] = 'Password Lama Tidak Benar';
            return $response;
        }

        // Current password and new password same
        if (strcmp($request->get('passwordLama'), $request->passwordBaru) == 0) {
            $response['success'] = false;
            $response['message'] = 'Password baru sama dengan password lama';
            return $response;
        }

        if ($request->passwordBaru != $request->konfirmasiPassword) {
            $response['success'] = false;
            $response['message'] = 'Password baru dan konfirmasi password tidak sama';
            return $response;
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->passwordBaru);
        $output = $user->save();
        if ($output == true) {
            $response['success'] = true;
            $response['message'] = 'Anda Berhasil Memperbarui Password';
        } else {
            $response['success'] = false;
            $response['message'] = 'Anda Gagal Memperbarui Password';
        }
        return $response;
    }
}

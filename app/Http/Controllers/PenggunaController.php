<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Gate;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GrahamCampbell\ResultType\Success;

class PenggunaController extends Controller
{
    public function __construct()
    {
        // $this->middleware('can:crate pengguna')->only('create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(auth()->user());
        // dd($request);
        // $this->authorize('read pengguna');
        // return 'page pengguna';

        // return view('pengguna.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
        // dd($data);
        // return view('pengguna.index', [
        //     'title' => 'Data Pengguna'
        // ]);
        $pengguna = User::all();
        // dd($pengguna[0]->name);
        // dd(count($pengguna));
        if ($request->ajax()) {
            $allData = DataTables::of($pengguna)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle-"tooltip" data-id="' . $row->id . '" data-original-title="edit" class="mr-1 edit btn btn-primary btn-sm editPengguna">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg></a>' . '
                    <a href="/pengguna/detail/' . $row->id . '" data-toggle-"tooltip" data-id="' . $row->id . '" data-original-title="detail" class="mr-1 detail btn btn-info btn-sm detailPengguna"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm48 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm56 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg></a>' .
                        '<a href="javascript:void(0)" data-toggle-"tooltip" data-id="' . $row->id . '" data-original-title="delete" class="delete btn btn-danger btn-sm deletePengguna"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><style>svg{fill:#ffffff}</style><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $allData;
        }

        return view('pengguna.index', compact('pengguna'), [
            'title' => 'Data Pengguna'
        ]);
    }

    public function changestatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        if ($status == 1) {
            $data = DB::table('users')->where('id', $id)->update(['is_active' => '0']);
        } else if ($status == 0) {
            $data = DB::table('users')->where('id', $id)->update(['is_active' => '1']);
        }
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'create pengguna';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->name);
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'jabatan' => 'required',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->jabatan = $request->jabatan;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->nohp = $request->nohp;
        $user->alamat = $request->alamat;
        $user->role = $request->role;
        $user->password = Hash::make('12345678');
        $output = $user->save();

        if ($output == true) {
            $response['success'] = true;
            $response['message'] = 'Anda Berhasil Menambahkan Data Pengguna';
        } else {
            $response['success'] = false;
            $response['message'] = 'Anda Gagal Menambahkan Data Pengguna';
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table('users')->find($id);
        return response()->json([
            'success' => true,
            'message' => 'Detail Data User',
            'data'    => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'jabatan' => 'required',
        ]);

        $id = $request->id;

        $output = DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'jabatan' => $request->jabatan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nohp' => $request->nohp,
                'alamat' => $request->alamat,
                'role' => $request->role,
            ]);

        if ($output == true) {
            $response['success'] = true;
            $response['message'] = 'Anda Berhasil Mengupdate Data Pengguna';
        } else {
            $response['success'] = false;
            $response['message'] = 'Anda Gagal Mengupdate Data Pengguna';
        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = DB::table('users')->where('id',  $id)->delete();
        if ($deleted == true) {
            $response['success'] = true;
            $response['message'] = 'Anda Berhasil Menghapus Data Pengguna';
        } else {
            $response['success'] = false;
            $response['message'] = 'Anda Gagal Menghapus Data Pengguna';
        }

        return $response;
    }

    public function detail(Request $request)
    {
        $user = DB::table('users')->find($request->id);
        return view('pengguna.detail', compact('user'), [
            'title' => 'Data Pengguna'
        ]);
    }
}

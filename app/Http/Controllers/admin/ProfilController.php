<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // untuk deteksi session
        detect_role_session($this->session, session()->has('roles'), 'admin');
    }

    public function index()
    {
        $data = [
            'user' => User::find($this->session['id_users']),
        ];
        return Template::load('admin', 'Profil', 'profil', 'view', $data);
    }

    public function save_picture(Request $request)
    {
        try {
            $rules = [
                'i_foto' => 'required',
            ];

            $messages = [
                'i_foto.required' => 'Foto harus diisi!',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                $response = ['title'  => 'Gagal!', 'text'   => 'Data gagal ditambahkan!', 'type'   => 'error', 'button' => 'Okay!', 'class'  => 'danger', 'errors' => $validator->errors()];

                return Response::json($response);
            }

            $user = User::find($this->session['id_users']);

            // hapus foto
            del_picture($user->picture);

            // nama foto
            $nama_foto = generate_random_name_file($request->i_foto);

            // upload foto
            $request->i_foto->move(upload_path('picture'), $nama_foto);

            $user->picture = $nama_foto;

            $request->session()->put('foto', $nama_foto);

            $user->save();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Simpan!', 'type' => 'success', 'button' => 'Okay!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Simpan!', 'type' => 'error', 'button' => 'Okay!', 'class' => 'danger'];
        }

        return Response::json($response);
    }

    public function save_account(Request $request)
    {
        try {
            $rules = [
                'i_nama'     => 'required',
                'i_email'    => 'required|email',
            ];

            $messages = [
                'i_nama.required'     => 'Nama harus diisi!',
                'i_email.required'    => 'Email harus diisi!',
                'i_email.email'       => 'Email tidak valid!',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                $response = ['title'  => 'Gagal!', 'text'   => 'Data gagal ditambahkan!', 'type'   => 'error', 'button' => 'Okay!', 'class'  => 'danger', 'errors' => $validator->errors()];

                return Response::json($response);
            }

            $user = User::find($this->session['id_users']);

            $user->name     = $request->i_nama;
            $user->email    = $request->i_email;

            $request->session()->put('nama', $request->i_nama);

            $user->save();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Simpan!', 'type' => 'success', 'button' => 'Okay!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Simpan!', 'type' => 'error', 'button' => 'Okay!', 'class' => 'danger'];
        }

        return Response::json($response);
    }

    public function save_security(Request $request)
    {
        $rules = [
            'i_pass_lama'      => 'required',
            'i_pass_baru'      => 'required',
            'i_pass_baru_lagi' => 'required',
        ];

        $messages = [
            'i_pass_lama.required'      => 'Password lama harus diisi!',
            'i_pass_baru.required'      => 'Password baru harus diisi!',
            'i_pass_baru_lagi.required' => 'Konfirmasi password baru harus diisi!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $response = ['title'  => 'Gagal!', 'text'   => 'Data gagal ditambahkan!', 'type'   => 'error', 'button' => 'Okay!', 'class'  => 'danger', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        $user = User::find($this->session['id_users']);

        if (Hash::check($request->i_pass_lama, $user->password)) {
            if ($request->i_pass_baru === $request->i_pass_baru_lagi) {
                try {
                    $user->password = Hash::make($request->i_pass_baru);
                    $user->save();

                    $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Simpan!', 'type' => 'success', 'button' => 'Okay!', 'class' => 'success'];
                } catch (\Exception $e) {
                    $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Simpan!', 'type' => 'error', 'button' => 'Okay!', 'class' => 'danger'];
                }
            } else {
                $response = ['title' => 'Gagal!', 'text' => 'Password baru dan konfirmasi password baru tidak sama!', 'type' => 'warning', 'button' => 'Okay!', 'class' => 'warning'];
            }
        } else {
            $response = ['title' => 'Gagal!', 'text' => 'Password lama yang Anda masukkan tidak sama!', 'type' => 'warning', 'button' => 'Okay!', 'class' => 'warning'];
        }

        return Response::json($response);
    }
}

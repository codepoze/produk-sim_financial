<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        return Template::load('admin', 'Category', 'category', 'view');
    }

    public function list()
    {
        $data = Category::where('id_users', $this->session['id_users'])->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_category) . '" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-upd" data-bs-backdrop="static" data-bs-keyboard="false"><i class="fa fa-edit"></i>&nbsp;Ubah</button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_category) . '" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                ';
            })
            ->make(true);
    }

    public function get(Request $request)
    {
        $query = Category::query();

        if ($request->type !== null) {
            $query->where('type', $request->type);
        }

        $query->select('id_category AS id', 'id_category AS value', 'name AS label')
            ->where('id_users', $this->session['id_users'])
            ->orderBy('id_category', 'desc');

        $response = $query->get();

        return Response::json($response);
    }

    public function show(Request $request)
    {
        $response = Category::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(Request $request)
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->where('id_users', $this->session['id_users'])->where('type', $request->type),
            ],
            'type' => ['required', 'in:expense,income'],
        ];

        $messages = [
            'name.required' => 'Nama harus diisi!',
            'name.unique'   => 'Nama kategori dengan tipe ini sudah ada!',
            'type.required' => 'Tipe harus diisi!',
            'type.in'       => 'Tipe harus diisi dengan expense atau income!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $response = ['title'  => 'Gagal!', 'text'   => 'Data gagal ditambahkan!', 'type'   => 'error', 'button' => 'Okay!', 'class'  => 'danger', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        try {
            Category::updateOrCreate(
                [
                    'id_category' => $request->id_category,
                ],
                [
                    'id_users' => $this->session['id_users'],
                    'name'     => $request->name,
                    'type'     => $request->type,
                ]
            );

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Simpan!', 'type' => 'success', 'button' => 'Okay!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Simpan!', 'type' => 'error', 'button' => 'Okay!', 'class' => 'danger'];
        }

        return Response::json($response);
    }

    public function del(Request $request)
    {
        try {
            $data = Category::find(my_decrypt($request->id));

            $data->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Okay!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Hapus!', 'type' => 'error', 'button' => 'Okay!', 'class' => 'danger'];
        }

        return Response::json($response);
    }
}

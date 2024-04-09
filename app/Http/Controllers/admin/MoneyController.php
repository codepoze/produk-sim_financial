<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Category;
use App\Models\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class MoneyController extends Controller
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
            'category' => Category::all(),
        ];

        return Template::load($this->session['roles'], 'Money', 'money', 'view', $data);
    }

    public function get_data_dt()
    {
        $data = Money::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return $row->status == 'income' ? '<span class="badge bg-success">Income</span>' : '<span class="badge bg-danger">Expense</span>';
            })
            ->addColumn('amount', function ($row) {
                return create_separator($row->amount);
            })
            ->addColumn('description', function ($row) {
                return $row->description ?? '-';
            })
            ->addColumn('date', function ($row) {
                return tgl_indo($row->date);
            })
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_money) . '" class="btn btn-primary btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#modal-add-upd" data-bs-backdrop="static" data-bs-keyboard="false"><i class="fa fa-edit"></i>&nbsp;Ubah</button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_money) . '" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                ';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function show(Request $request)
    {
        $data = Money::find(my_decrypt($request->id));

        $response = [
            'id_money'    => $data->id_money,
            'id_category' => $data->id_category,
            'name'        => $data->name,
            'status'      => $data->status,
            'amount'      => create_separator($data->amount),
            'description' => $data->description,
            'date'        => $data->date,
        ];

        return Response::json($response);
    }

    public function save(Request $request)
    {
        $rules = [
            'id_category' => 'required',
            'name'        => 'required',
            'status'      => 'required',
            'amount'      => 'required',
            'date'        => 'required',
        ];

        $messages = [
            'id_category.required' => 'Kategori harus diisi!',
            'name.required'        => 'Judul harus diisi!',
            'status.required'      => 'Status harus diisi!',
            'amount.required'      => 'Jumlah harus diisi!',
            'date.required'        => 'Waktu harus diisi!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $response = ['title'  => 'Gagal!', 'text'   => 'Data gagal ditambahkan!', 'type'   => 'error', 'button' => 'Okay!', 'class'  => 'danger', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        try {
            Money::updateOrCreate(
                [
                    'id_money' => $request->id_money,
                ],
                [
                    'id_category' => $request->id_category,
                    'name'        => $request->name,
                    'status'      => $request->status,
                    'amount'      => remove_separator($request->amount),
                    'description' => $request->description,
                    'date'        => $request->date,
                    'by_users'    => $this->session['id_users'],
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
            $data = Money::find(my_decrypt($request->id));

            $data->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Okay!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Hapus!', 'type' => 'error', 'button' => 'Okay!', 'class' => 'danger'];
        }

        return Response::json($response);
    }
}

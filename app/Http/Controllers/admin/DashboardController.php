<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Category;
use App\Models\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    public $months = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];

    public function __construct()
    {
        parent::__construct();
        // untuk deteksi session
        detect_role_session($this->session, session()->has('roles'), 'admin');
    }

    public function index()
    {
        $from_year = '2021';
        $to_year   = date('Y');
        $years     = [];

        for ($i = $from_year; $i <= $to_year; $i++) {
            $years[] = $i;
        }

        $categories = Category::all();

        $data = [
            'categories' => $categories,
            'months'     => $this->months,
            'years'      => $years,
        ];

        return Template::load($this->session['roles'], 'Dashboard', 'dashboard', 'view', $data);
    }

    public function count_income_expense_balance(Request $request)
    {
        $data = $request->all();

        // get income
        $income = Money::query();

        if ($data['id_category'] !== null) {
            $income->where('id_category', $data['id_category']);
        }

        if ($data['month'] !== null) {
            $income->whereMonth('date', $data['month']);
        }

        if ($data['year'] !== null) {
            $income->whereYear('date', $data['year']);
        }

        $income->where('status', 'income');
        $income = $income->sum('amount');

        // get expense
        $expense = Money::query();

        if ($data['id_category'] !== null) {
            $expense->where('id_category', $data['id_category']);
        }

        if ($data['month'] !== null) {
            $expense->whereMonth('date', $data['month']);
        }

        if ($data['year'] !== null) {
            $expense->whereYear('date', $data['year']);
        }

        $expense->where('status', 'expense');
        $expense = $expense->sum('amount');

        // get balance
        $balance = ($income - $expense);

        $response = [
            'income'  => rupiah($income),
            'expense' => rupiah($expense),
            'balance' => rupiah($balance),
        ];

        return Response::json($response);
    }

    public function count_income(Request $request)
    {
        $data = $request->all();

        $income = Money::query();
        $income->select(DB::raw('id_category, sum(amount) as amount'));
        $income->where('status', 'income');

        if ($data['id_category'] !== null) {
            $income->where('id_category', $data['id_category']);
        }

        if ($data['month'] !== null) {
            $income->whereMonth('date', $data['month']);
        }

        if ($data['year'] !== null) {
            $income->whereYear('date', $data['year']);
        }

        $income->groupBy('id_category');
        $income = $income->get();

        $response = [];
        foreach ($income as $key => $value) {
            $response[] = [
                'key'   => $value->toCategory->name,
                'value' => $value->amount
            ];
        }

        return Response::json($response);
    }

    public function count_expense(Request $request)
    {
        $data = $request->all();

        $expense = Money::query();
        $expense->select(DB::raw('id_category, sum(amount) as amount'));
        $expense->where('status', 'expense');

        if ($data['id_category'] !== null) {
            $expense->where('id_category', $data['id_category']);
        }

        if ($data['month'] !== null) {
            $expense->whereMonth('date', $data['month']);
        }

        if ($data['year'] !== null) {
            $expense->whereYear('date', $data['year']);
        }

        $expense->groupBy('id_category');
        $expense = $expense->get();

        $response = [];
        foreach ($expense as $key => $value) {
            $response[] = [
                'key'   => $value->toCategory->name,
                'value' => $value->amount
            ];
        }

        return Response::json($response);
    }

    public function count_balance(Request $request)
    {
        $data = $request->all();

        $balance = Money::query();
        $balance->select(DB::raw('id_category, sum(amount) as amount'));

        if ($data['status'] !== null) {
            $balance->where('status', $data['status']);
        }

        if ($data['id_category'] !== null) {
            $balance->where('id_category', $data['id_category']);
        }

        if ($data['month'] !== null) {
            $balance->whereMonth('date', $data['month']);
        }

        if ($data['year'] !== null) {
            $balance->whereYear('date', $data['year']);
        }

        $balance->groupBy('id_category');
        $balance = $balance->get();

        $response = [];
        foreach ($balance as $key => $value) {
            $response[] = [
                'key'   => $value->toCategory->name,
                'value' => $value->amount
            ];
        }

        return Response::json($response);
    }
}

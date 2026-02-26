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

    public function index()
    {
        $from_year = '2021';
        $to_year   = date('Y');
        $years     = [];

        for ($i = $from_year; $i <= $to_year; $i++) {
            $years[] = $i;
        }

        $data = [
            'months'     => $this->months,
            'years'      => $years,
        ];

        return Template::load('admin', 'Dashboard', 'dashboard', 'view', $data);
    }

    public function count_income_expense_balance(Request $request)
    {
        $data = $request->all();

        // base query builder
        $baseQuery = function ($type) use ($data) {
            $query = Money::query()
                ->join('categories', 'money.id_category', '=', 'categories.id_category')
                ->where('categories.type', $type);

            if ($data['id_category'] !== null) {
                $query->where('money.id_category', $data['id_category']);
            }

            if ($data['month'] !== null) {
                $query->whereMonth('money.date', $data['month']);
            }

            if ($data['year'] !== null) {
                $query->whereYear('money.date', $data['year']);
            }

            return $query->sum('money.amount');
        };

        $income  = $baseQuery('income');
        $expense = $baseQuery('expense');
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

        $income = Money::query()
            ->select(DB::raw('money.id_category, sum(money.amount) as amount'))
            ->join('categories', 'money.id_category', '=', 'categories.id_category')
            ->where('categories.type', 'income');

        if ($data['id_category'] !== null) {
            $income->where('money.id_category', $data['id_category']);
        }

        if ($data['month'] !== null) {
            $income->whereMonth('money.date', $data['month']);
        }

        if ($data['year'] !== null) {
            $income->whereYear('money.date', $data['year']);
        }

        $income->groupBy('money.id_category');
        $income = $income->get();

        $response = [];
        foreach ($income as $value) {
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

        $expense = Money::query()
            ->select(DB::raw('money.id_category, sum(money.amount) as amount'))
            ->join('categories', 'money.id_category', '=', 'categories.id_category')
            ->where('categories.type', 'expense');

        if ($data['id_category'] !== null) {
            $expense->where('money.id_category', $data['id_category']);
        }

        if ($data['month'] !== null) {
            $expense->whereMonth('money.date', $data['month']);
        }

        if ($data['year'] !== null) {
            $expense->whereYear('money.date', $data['year']);
        }

        $expense->groupBy('money.id_category');
        $expense = $expense->get();

        $response = [];
        foreach ($expense as $value) {
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

        $balance = Money::query()
            ->select(DB::raw('money.id_category, sum(money.amount) as amount'))
            ->join('categories', 'money.id_category', '=', 'categories.id_category');

        if ($data['status'] !== null) {
            $balance->where('categories.type', $data['status']);
        }

        if ($data['id_category'] !== null) {
            $balance->where('money.id_category', $data['id_category']);
        }

        if ($data['month'] !== null) {
            $balance->whereMonth('money.date', $data['month']);
        }

        if ($data['year'] !== null) {
            $balance->whereYear('money.date', $data['year']);
        }

        $balance->groupBy('money.id_category');
        $balance = $balance->get();

        $response = [];
        foreach ($balance as $value) {
            $response[] = [
                'key'   => $value->toCategory->name,
                'value' => $value->amount
            ];
        }

        return Response::json($response);
    }
}

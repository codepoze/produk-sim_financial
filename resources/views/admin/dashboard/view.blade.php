<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
    <style>
        .chartdiv {
            width: 100%;
            height: 500px;
        }
    </style>
    @endpush
    <!-- end:: css local -->

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 p-2">
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="">Pilih Status</option>
                                <option value="income">Income</option>
                                <option value="expense">Expense</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 p-2">
                            <select name="id_category" id="id_category" class="form-control form-control-sm">
                                <option value="">Pilih Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id_category }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 p-2">
                            <select name="month" id="month" class="form-control form-control-sm">
                                <option value="">Pilih Bulan</option>
                                @foreach ($months as $key => $month)
                                <option value="{{ $key }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 p-2">
                            <select name="year" id="year" class="form-control form-control-sm">
                                <option value="">Pilih Tahun</option>
                                @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Balance</p>
                            <h4 class="mb-0" id="balance">{{ rupiah(0) }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                <span class="avatar-title">
                                    <i class="bx bx-money font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Income</p>
                            <h4 class="mb-0" id="income">{{ rupiah(0) }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                <span class="avatar-title">
                                    <i class="bx bx-plus font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Expense</p>
                            <h4 class="mb-0" id="expense">{{ rupiah(0) }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                <span class="avatar-title">
                                    <i class="bx bx-minus font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card mini-stats-wid">
                <div class="card-header bg-transparent border-bottom align-items-center">
                    <h4 class="card-title">Income</h4>
                </div>
                <div class="card-body">
                    <div class="chartdiv" id="chartIncome"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card mini-stats-wid">
                <div class="card-header bg-transparent border-bottom align-items-center">
                    <h4 class="card-title">Expense</h4>
                </div>
                <div class="card-body">
                    <div class="chartdiv" id="chartExpense"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card mini-stats-wid">
                <div class="card-header bg-transparent border-bottom align-items-center">
                    <h4 class="card-title">Balance</h4>
                </div>
                <div class="card-body">
                    <div class="chartdiv" id="chartBalance"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- begin:: js local -->
    @push('js')
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <script>
        var rootIncome = am5.Root.new("chartIncome");

        rootIncome.setThemes([
            am5themes_Animated.new(rootIncome)
        ]);

        var chartIncome = rootIncome.container.children.push(
            am5percent.PieChart.new(rootIncome, {
                endAngle: 270
            })
        );

        var seriesIncome = chartIncome.series.push(
            am5percent.PieSeries.new(rootIncome, {
                valueField: "value",
                categoryField: "key",
                endAngle: 270
            })
        );

        seriesIncome.states.create("hidden", {
            endAngle: -90
        });

        var rootExpense = am5.Root.new("chartExpense");

        rootExpense.setThemes([
            am5themes_Animated.new(rootExpense)
        ]);

        var chartExpense = rootExpense.container.children.push(
            am5percent.PieChart.new(rootExpense, {
                endAngle: 270
            })
        );

        var seriesExpense = chartExpense.series.push(
            am5percent.PieSeries.new(rootExpense, {
                valueField: "value",
                categoryField: "key",
                endAngle: 270
            })
        );

        seriesExpense.states.create("hidden", {
            endAngle: -90
        });

        var rootBalance = am5.Root.new("chartBalance");

        rootBalance.setThemes([
            am5themes_Animated.new(rootBalance)
        ]);

        var chartBalance = rootBalance.container.children.push(
            am5percent.PieChart.new(rootBalance, {
                endAngle: 270
            })
        );

        var seriesBalance = chartBalance.series.push(
            am5percent.PieSeries.new(rootBalance, {
                valueField: "value",
                categoryField: "key",
                endAngle: 270
            })
        );

        seriesBalance.states.create("hidden", {
            endAngle: -90
        });

        $(document).ready(function() {
            loadIncomeExpenseBalance();

            loadIncome(seriesIncome);

            loadExpense(seriesExpense);

            loadBalance(seriesBalance);
        });

        $(document).on('change', '#status', function(e) {
            e.preventDefault();

            loadBalance(seriesBalance);
        });

        $(document).on('change', '#id_category', function(e) {
            e.preventDefault();

            loadIncomeExpenseBalance();

            loadIncome(seriesIncome);

            loadExpense(seriesExpense);

            loadBalance(seriesBalance);
        });

        $(document).on('change', '#month', function(e) {
            e.preventDefault();

            loadIncomeExpenseBalance();

            loadIncome(seriesIncome);

            loadExpense(seriesExpense);

            loadBalance(seriesBalance);
        });

        $(document).on('change', '#year', function(e) {
            e.preventDefault();

            loadIncomeExpenseBalance();

            loadIncome(seriesIncome);

            loadExpense(seriesExpense);

            loadBalance(seriesBalance);
        });

        function loadIncomeExpenseBalance() {
            $.post("{{ route('admin.dashboard.count_income_expense_balance') }}", {
                id_category: $('#id_category').val(),
                month: $('#month').val(),
                year: $('#year').val()
            }, function(response) {
                $('#income').text(response.income);
                $('#expense').text(response.expense);
                $('#balance').text(response.balance);
            });
        }

        function loadIncome(series) {
            $.post("{{ route('admin.dashboard.count_income') }}", {
                id_category: $('#id_category').val(),
                month: $('#month').val(),
                year: $('#year').val()
            }, function(response) {
                series.data.setAll(response);

                series.appear(1000, 100);
            });
        }

        function loadExpense(series) {
            $.post("{{ route('admin.dashboard.count_expense') }}", {
                id_category: $('#id_category').val(),
                month: $('#month').val(),
                year: $('#year').val()
            }, function(response) {
                series.data.setAll(response);

                series.appear(1000, 100);
            });
        }

        function loadBalance(series) {
            $.post("{{ route('admin.dashboard.count_balance') }}", {
                status: $('#status').val(),
                id_category: $('#id_category').val(),
                month: $('#month').val(),
                year: $('#year').val()
            }, function(response) {
                series.data.setAll(response);

                series.appear(1000, 100);
            });
        }
    </script>
    @endpush
    <!-- end:: js local -->
</x-admin-layout>
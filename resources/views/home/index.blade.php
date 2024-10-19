@extends('layout.app')
@section('container')

<div class="row gy-4">

    <!-- Dashboard Widget Start -->
    <div class="col-xxl-3 col-sm-6">
        <div class="card px-24 py-16 shadow-none radius-8 border h-100 bg-gradient-start-3">
            <div class="card-body p-0">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                    <div class="d-flex align-items-center">

                        <div class="w-64-px h-64-px radius-16 bg-base-50 d-flex justify-content-center align-items-center me-20">
                            <span class="mb-0 w-40-px h-40-px bg-primary-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center radius-8 h6 mb-0">
                                <iconify-icon icon="flowbite:users-group-solid" class="icon"></iconify-icon>
                            </span>
                        </div>

                        <div>
                            <span class="mb-2 fw-medium text-secondary-light text-md">New Users</span>
                            <h6 class="fw-semibold my-1">5000</h6>
                            <p class="text-sm mb-0">Increase by
                                <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+200</span> this week
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard Widget End -->

    <!-- Dashboard Widget Start -->
    <div class="col-xxl-3 col-sm-6">
        <div class="card px-24 py-16 shadow-none radius-8 border h-100 bg-gradient-start-2">
            <div class="card-body p-0">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                    <div class="d-flex align-items-center">

                        <div class="w-64-px h-64-px radius-16 bg-base-50 d-flex justify-content-center align-items-center me-20">
                            <span class="mb-0 w-40-px h-40-px bg-purple flex-shrink-0 text-white d-flex justify-content-center align-items-center radius-8 h6 mb-0">
                                <iconify-icon icon="solar:wallet-bold" class="text-white text-2xl mb-0"></iconify-icon>
                            </span>
                        </div>

                        <div>
                            <span class="mb-2 fw-medium text-secondary-light text-md">Total Deposit</span>
                            <h6 class="fw-semibold my-1">15,000</h6>
                            <p class="text-sm mb-0">Increase by
                                <span class="bg-danger-focus px-1 rounded-2 fw-medium text-danger-main text-sm">-200</span> this week
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard Widget End -->

    <!-- Dashboard Widget Start -->
    <div class="col-xxl-3 col-sm-6">
        <div class="card px-24 py-16 shadow-none radius-8 border h-100 bg-gradient-start-5">
            <div class="card-body p-0">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                    <div class="d-flex align-items-center">

                        <div class="w-64-px h-64-px radius-16 bg-base-50 d-flex justify-content-center align-items-center me-20">
                            <span class="mb-0 w-40-px h-40-px bg-red flex-shrink-0 text-white d-flex justify-content-center align-items-center radius-8 h6 mb-0">
                                <iconify-icon icon="fa6-solid:file-invoice-dollar" class="text-white text-2xl mb-0"></iconify-icon>
                            </span>
                        </div>

                        <div>
                            <span class="mb-2 fw-medium text-secondary-light text-md">Total Expense</span>
                            <h6 class="fw-semibold my-1">15,000</h6>
                            <p class="text-sm mb-0">Increase by
                                <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+200</span> this week
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard Widget End -->

    <!-- Dashboard Widget Start -->
    <div class="col-xxl-3 col-sm-6">
        <div class="card px-24 py-16 shadow-none radius-8 border h-100 bg-gradient-start-4">
            <div class="card-body p-0">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                    <div class="d-flex align-items-center">

                        <div class="w-64-px h-64-px radius-16 bg-base-50 d-flex justify-content-center align-items-center me-20">
                            <span class="mb-0 w-40-px h-40-px bg-success-main flex-shrink-0 text-white d-flex justify-content-center align-items-center radius-8 h6 mb-0">
                                <iconify-icon icon="streamline:bag-dollar-solid" class="icon"></iconify-icon>
                            </span>
                        </div>

                        <div>
                            <span class="mb-2 fw-medium text-secondary-light text-md">Total Earning</span>
                            <h6 class="fw-semibold my-1">15,000</h6>
                            <p class="text-sm mb-0">Increase by
                                <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+200</span> this week
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard Widget End -->

    <!-- Revenue Statistics Start -->
    <div class="col-xxl-8">
        <div class="card h-100 radius-8 border-0">
            <div class="card-body p-24">
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                    <div>
                        <h6 class="mb-2 fw-bold text-lg">Revenue Statistics</h6>
                        <span class="text-sm fw-medium text-secondary-light">Yearly earning overview</span>
                    </div>
                    <div class="">
                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                            <option>Yearly</option>
                            <option>Monthly</option>
                            <option>Weekly</option>
                            <option>Today</option>
                        </select>
                    </div>
                </div>

                <div class="mt-24 mb-24 d-flex flex-wrap">
                    <div class="me-40">
                        <span class="text-secondary-light text-sm mb-1">Income</span>
                        <div class="">
                            <h6 class="fw-semibold d-inline-block mb-0">$26,201</h6>
                            <span class="text-success-main fw-bold d-inline-flex align-items-center gap-1">10% <iconify-icon icon="iconamoon:arrow-up-2-fill" class="icon"></iconify-icon> </span>
                        </div>
                    </div>
                    <div>
                        <span class="text-secondary-light text-sm mb-1">Expenses</span>
                        <div class="">
                            <h6 class="fw-semibold d-inline-block mb-0">$18,120</h6>
                            <span class="text-danger-main fw-bold d-inline-flex align-items-center gap-1">10% <iconify-icon icon="iconamoon:arrow-down-2-fill" class="icon"></iconify-icon> </span>
                        </div>
                    </div>
                </div>

                <div id="upDownBarchart"></div>

            </div>
        </div>
    </div>
    <!-- Revenue Statistics End -->

    <!-- Statistics Start -->
    <div class="col-xxl-4">
        <div class="card h-100 radius-8 border-0">
            <div class="card-body p-24">
                <h6 class="mb-2 fw-bold text-lg">Statistic</h6>

                <div class="mt-24">
                    <div class="d-flex align-items-center gap-1 justify-content-between mb-44">
                        <div>
                            <span class="text-secondary-light fw-normal mb-12 text-xl">Daily Conversions</span>
                            <h5 class="fw-semibold mb-0">%60</h5>
                        </div>
                         <div class="position-relative">
                            <div id="semiCircleGauge"></div>

                            <span class="w-36-px h-36-px rounded-circle bg-neutral-100 d-flex justify-content-center align-items-center position-absolute start-50 translate-middle top-100">
                              <iconify-icon icon="mdi:emoji" class="text-primary-600 text-md mb-0"></iconify-icon>
                            </span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-1 justify-content-between mb-44">
                        <div>
                            <span class="text-secondary-light fw-normal mb-12 text-xl">Visits By Day</span>
                            <h5 class="fw-semibold mb-0">20k</h5>
                        </div>
                        <div id="areaChart"></div>
                    </div>

                    <div class="d-flex align-items-center gap-1 justify-content-between">
                        <div>
                            <span class="text-secondary-light fw-normal mb-12 text-xl">Today Income</span>
                            <h5 class="fw-semibold mb-0">$5.5k</h5>
                        </div>
                        <div id="dailyIconBarChart"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Statistics End -->

</div>

@endsection
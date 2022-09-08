@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#document" role="tab"
                        aria-controls="preview" aria-selected="true">
                        <i class="ni ni-badge text-sm me-2"></i> All Policy
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#security" role="tab"
                        aria-controls="code" aria-selected="false">
                        <i class="ni ni-laptop text-sm me-2"></i> Policy per Department
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#addSecurity" role="tab"
                        aria-controls="code" aria-selected="false">
                        <i class="ni ni-laptop text-sm me-2"></i> Map Representation
                    </a>
                </li>
            </ul>
        </div>


        <div class="tab-content">

            <div id="document" class="tab-pane fade  my-4 active show">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4 mx-4">
                            <div class="card-header pb-0">
                                <div class="d-flex flex-row justify-content-between">
                                    <div>
                                        <h5 class="mb-0">All Questions</h5>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">

                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    ID
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    description
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Evaluation
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Percent
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Comment
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($questions as $question)
                                                <tr>
                                                    <td class="ps-4">
                                                        <p class="text-xs font-weight-bold mb-0">{{ $question->id }}</p>
                                                        <input type="text" name="question_id"
                                                            value="{{ $question->id }}" required hidden>
                                                        <input type="text" name="department_id" value="1" required
                                                            hidden>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $question->description }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $question->evaluation }}</p>
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="progress-wrapper w-75 mx-auto">
                                                            <div class="progress-info">
                                                                <div class="progress-percentage">
                                                                    <span
                                                                        class="text-xs font-weight-bold">{{ $question->percent }}%</span>
                                                                </div>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-{{ $question->type }} w-{{ $question->percent }} "
                                                                        role="progressbar" aria-valuenow="60"
                                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <input href="#" class="form-control" data-bs-toggle="tooltip"
                                                            data-bs-original-title="Save as security policy"
                                                            placeholder="Comment..." />
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="security" class="tab-pane fade ">

                <div class="row my-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="card-header pb-0">
                                <h6>Departments</h6>
                            </div>
                            <div class="card-body p-3">
                                <div class="timeline timeline-one-side">
                                    @foreach ($departments as $department)
                                        <div class="timeline-block mb-3 cursor-pointer">
                                            <a href="/audit?id={{ $department->id }}">
                                                <span class="timeline-step">
                                                    <i class="ni ni-bell-55 text-success text-gradient"></i>
                                                </span>
                                                <div class="timeline-content">
                                                    <h6 class="text-dark text-sm font-weight-bold mb-0">
                                                        {{ $department->name }}</h6>
                                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                        {{ $department->created_at }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="row">
                                    <div class="col-lg-6 col-7">
                                        <h6>Policy</h6>
                                    </div>
                                    <div class="col-lg-6 col-5 my-auto text-end">
                                        <div class="dropdown float-lg-end pe-4">
                                            <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-secondary"></i>
                                            </a>
                                            <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5"
                                                aria-labelledby="dropdownTable">
                                                <li><a class="dropdown-item border-radius-md"
                                                        href="javascript:;">Action</a>
                                                </li>
                                                <li><a class="dropdown-item border-radius-md" href="javascript:;">Another
                                                        action</a>
                                                </li>
                                                <li><a class="dropdown-item border-radius-md"
                                                        href="javascript:;">Something
                                                        else
                                                        here</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (isset($_GET['id']))
                                <div class="card-body px-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">

                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        ID
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        description
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Evaluation
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Percent
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Comment
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($departmentQuestions as $question)
                                                    <tr>
                                                        <td class="ps-4">
                                                            <p class="text-xs font-weight-bold mb-0">{{ $question->id }}
                                                            </p>
                                                            <input type="text" name="question_id"
                                                                value="{{ $question->id }}" required hidden>
                                                            <input type="text" name="department_id" value="1"
                                                                required hidden>
                                                        </td>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $question->description }}</p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $question->evaluation }}</p>
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="progress-wrapper w-75 mx-auto">
                                                                <div class="progress-info">
                                                                    <div class="progress-percentage">
                                                                        <span
                                                                            class="text-xs font-weight-bold">{{ $question->percent }}%</span>
                                                                    </div>
                                                                </div>
                                                                <div class="progress">
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-{{ $question->type }} w-{{ $question->percent }} "
                                                                            role="progressbar" aria-valuenow="60"
                                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input href="#" class="form-control"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-original-title="Save as security policy"
                                                                placeholder="Comment..." />
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <div id="addSecurity" class="tab-pane fade">

                <div class="row mt-4">
                    <div class="col-lg-5 mb-lg-0 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body p-3">

                                <div class="card-header pb-0">
                                    <h6>Percentage done graphe per Department</h6>
                                </div>
                                <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                                    <div class="chart">
                                        <canvas id="chart-bars" class="chart-canvas" height="300"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card z-index-2">
                            <div class="card-header pb-0">
                                <h6>Department Statistics</h6>
                            </div>
                            <div class="card-body p-3">
                                <div class="chart">
                                    <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection


<script>
    window.onload = function() {
        var ctx = document.getElementById("chart-bars").getContext("2d");
        var depArray = @json($depArray);
        var doneDep = @json($doneDep);
        var notDoneDep = @json($notDoneDep);
        var perDoneDep = @json($perDoneDep);


        new Chart(ctx, {
            type: "bar",
            data: {
                labels: depArray,
                datasets: [{
                    label: "Percent Done",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "#fff",
                    data: perDoneDep,
                    maxBarThickness: 6
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 15,
                            font: {
                                size: 14,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#fff"
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false
                        },
                        ticks: {
                            display: false
                        },
                    },
                },
            },
        });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: depArray,
                datasets: [{
                        label: "Done",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: doneDep,
                        maxBarThickness: 6

                    },
                    {
                        label: "Not done",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#3A416F",
                        borderWidth: 3,
                        backgroundColor: gradientStroke2,
                        fill: true,
                        data: notDoneDep,
                        maxBarThickness: 6
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#b2b9bf',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#b2b9bf',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    }
</script>

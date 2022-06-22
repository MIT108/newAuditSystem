@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#document" role="tab"
                        aria-controls="preview" aria-selected="true">
                        <i class="ni ni-badge text-sm me-2"></i> Document
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#security" role="tab" aria-controls="code"
                        aria-selected="false">
                        <i class="ni ni-laptop text-sm me-2"></i> List Security
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#addSecurity" role="tab"
                        aria-controls="code" aria-selected="false">
                        <i class="ni ni-laptop text-sm me-2"></i> Add Security
                    </a>
                </li>
            </ul>
        </div>


        <div class="tab-content">

            <div id="document" class="tab-pane fade active show">
                <div class="row my-4">
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    name</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    description</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Created at</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($documents as $document)
                                                @php
                                                    $department_id = $_GET['id'];
                                                    $document_id = $document->id;
                                                    $url = URL::current() . '?id=' . $department_id . '&document=' . $document_id;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <a href="{{ env('APP_URL') . $document->image }}"
                                                                    target="_blank">
                                                                    <img src="{{ env('APP_URL') . $document->image }}"
                                                                        class="avatar avatar-sm me-3">
                                                                </a>
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $document->name }}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="avatar-group mt-2">

                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $document->description }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span class="text-xs font-weight-bold">
                                                            {{ $document->created_at->diffForHumans() }}</span>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <a href={{ $url }} class="btn btn-secondary"> view</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (isset($_GET['document']))
                        <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
                            <div class="card">
                                {{ Form::open(['route' => 'create.courier.security', 'method' => 'post']) }}

                                <div class="card-header pb-0">
                                    <div class="row">
                                        <div class="col-lg-6 col-7">
                                            <h4>Document : {{ $doc->name }}</h4>
                                            <div>
                                                <div>
                                                    <h6>Description : {{ $doc->description }}</h6>
                                                    <h6>Serial Number : {{ $doc->serial_number }}</h6>

                                                </div>
                                                <div>

                                                    <a href="{{ env('APP_URL') . $doc->image }}" target="_blank">
                                                        <img src="{{ env('APP_URL') . $doc->image }}" width="100"
                                                            height="100" class="avatar avatar-xl me-3">
                                                    </a>
                                                </div>
                                            </div>

                                            <input type="text" value="{{ $doc->id }}" required name="courier_id"
                                                hidden />

                                            <input type="text" value="{{ $_GET['id'] }}" required name="department_id"
                                            hidden />
                                        </div>
                                        <div class="col-lg-6 col-5 my-auto text-end">
                                            <div class="d-flex justify-content-end pr-5" style="width: 100%;">
                                                <button type="submit" class="btn btn-primary mr-5">
                                                    save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 pb-2">
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        action</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        description</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        created at</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($securities as $security)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" name="{{ $security->id }}"
                                                                        id="fcustomCheck1">
                                                                        <input type="text" name="Q".{{ $security->question_id }} value="{{ $security->question_id }}" required hidden/>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="avatar-group mt-2">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">
                                                                        {{ $security->description }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span class="text-xs font-weight-bold">
                                                                {{ $security->created_at->diffForHumans() }} </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{ Form::close() }}

                            </div>
                        </div>
                    @endif
                </div>
            </div>


            <div id="security" class="tab-pane fade">

                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4 mx-4">
                            <div class="card-header pb-0">
                                <div class="d-flex flex-row justify-content-between">
                                    <div>
                                        <h5 class="mb-0">All Policies</h5>
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
                                                    title
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Creation Date
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($securities as $security)
                                                <tr>
                                                    <td class="ps-4">
                                                        <p class="text-xs font-weight-bold mb-0">{{ $security->id }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $security->description }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">

                                                            @if ($security->title == 0)
                                                                question
                                                            @endif
                                                            @if ($security->title == 1)
                                                                Title
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $security->created_at->diffForHumans() }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="#" class="mx-3" data-bs-toggle="tooltip"
                                                            data-bs-original-title="Edit user">
                                                            <i class="fas fa-user-edit text-secondary"></i>
                                                        </a>
                                                        <span>
                                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                        </span>
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


            <div id="addSecurity" class="tab-pane fade">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4 mx-4">
                            <div class="card-header pb-0">
                                <div class="d-flex flex-row justify-content-between">
                                    <div>
                                        <h5 class="mb-0">All Questions</h5>
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
                                                    type
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Creation Date
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($questions as $question)
                                                {{ Form::open(['route' => 'department.security.create', 'method' => 'post']) }}
                                                <tr>
                                                    <td class="ps-4">
                                                        <p class="text-xs font-weight-bold mb-0">{{ $question->id }}</p>
                                                        <input type="text" name="question_id" value="{{ $question->id }}"
                                                            required hidden>
                                                        <input type="text" name="department_id" value="{{ $_GET['id'] }}"
                                                            required hidden>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $question->description }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            @if ($question->title == 0)
                                                                question
                                                            @endif
                                                            @if ($question->title == 1)
                                                                Title
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $question->created_at->diffForHumans() }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($question->title == 0)
                                                            <button href="#" class="btn btn-primary"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-original-title="Save as security policy">
                                                                Save
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                {{ Form::close() }}
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

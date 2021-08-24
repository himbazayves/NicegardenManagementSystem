{{-- @extends('layouts.app', ['page' => 'List of Requests', 'pageSlug' => 'requests', 'section' => 'requests'])
@extends('layouts.app', ['page' => __('Request Management'), 'pageSlug' => 'requests', 'section' => 'requests'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Requests</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('requests.create') }}" class="btn btn-sm btn-primary">New requests</a>
</div>
</div>
</div>
<div class="card-body">
    @include('alerts.success')

    <div class="">
        <table class="table tablesorter " id="">
            <thead class=" text-primary">
                <td>Date</td>
                <th scope="col">Title</th>
                <th scope="col">Requested to</th>

                <th scope="col">Requested by</th>

                <th scope="col"></th>

            </thead>
            <tbody>
                @foreach ($productRequests as $request)
                <tr>
                    <td>{{$request->created_at->diffForHumans()}}</td>
                    <td>{{ $request->title }}</td>
                    <td>{{$request->requestedTo->name}}</td>

                    <td>
                        @if(Auth::user()->userable_type=="App\Admin")
                        {{$request->user->name}}
                        @else
                        Me
                        @endif
                    </td>


                    <td class="td-actions text-right">
                        <a href="{{ route('requests.show', $request) }}" class="btn btn-link" data-toggle="tooltip"
                            data-placement="bottom" title="More Details">
                            <i class="tim-icons icon-zoom-split"></i>
                        </a>
                        <a href="{{ route('requests.edit', $request) }}" class="btn btn-link" data-toggle="tooltip"
                            data-placement="bottom" title="Edit Provider">
                            <i class="tim-icons icon-pencil"></i>
                        </a>
                        <form action="{{ route('requests.destroy', $request) }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom"
                                title="Delete Provider"
                                onclick="confirm('Are you sure you want to delete this provider? Records of payments made to him will not be deleted.') ? this.parentElement.submit() : ''">
                                <i class="tim-icons icon-simple-remove"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="card-footer py-4">
    <nav class="d-flex justify-content-end" aria-label="...">
        {{ $productRequests->links() }}
    </nav>
</div>
</div>
</div>
</div>
@endsection
--}}


@extends('layouts.app', ['page' => __('Request Management'), 'pageSlug' => 'requests', 'section' => 'requests'])

@section('content')



@if(Auth::user()->userable_type=="App\Admin")
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">Requests</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('requests.create') }}" class="btn btn-sm btn-primary">New requests</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('alerts.success')

                <div class="">
                    <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                            <td>Date</td>
                            <th scope="col">Title</th>
                            <th scope="col">Requested to</th>

                            <th scope="col">Requested by</th>

                            <th scope="col"></th>

                        </thead>
                        <tbody>
                            @foreach ($productRequests as $request)
                            <tr>
                                <td>{{$request->created_at->diffForHumans()}}</td>
                                <td>{{ $request->title }}</td>
                                <td>
                                    {{-- {{$request->requestedTo->name}} --}}
                                    @php


                                   $requestedTo= \App\User::where(['id' => $request->requested_to])->first();

                                    @endphp

                                  {{$requestedTo->name}}
                                </td>

                                <td>
                                    @if(Auth::user()->userable_type=="App\Admin")
                                    {{$request->user->name}}
                                    @else
                                    Me
                                    @endif
                                </td>


                                <td class="td-actions text-right">
                                    <a href="{{ route('product-request.download', $request) }}" class="btn btn-link"
                                        data-toggle="tooltip" data-placement="bottom" title="Download">
                                        <i class="tim-icons icon-cloud-download-93"></i>
                                    </a>
                                    <a href="{{ route('requests.show', $request) }}" class="btn btn-link"
                                        data-toggle="tooltip" data-placement="bottom" title="More Details">
                                        <i class="tim-icons icon-zoom-split"></i>
                                    </a>
                                    <a href="{{ route('requests.edit', $request) }}" class="btn btn-link"
                                        data-toggle="tooltip" data-placement="bottom" title="Edit Provider">
                                        <i class="tim-icons icon-pencil"></i>
                                    </a>
                                    <form action="{{ route('requests.destroy', $request) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-link" data-toggle="tooltip"
                                            data-placement="bottom" title="Delete Provider"
                                            onclick="confirm('Are you sure you want to delete this provider? Records of payments made to him will not be deleted.') ? this.parentElement.submit() : ''">
                                            <i class="tim-icons icon-simple-remove"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end" aria-label="...">
                    {{ $productRequests->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>
@else

<div class="row">
    <div class="col-md-7">
        <div class="card card-tasks">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">My requests</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('requests.create') }}" class="btn btn-sm btn-primary">New request</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-full-width table-responsive">
                    <table class="table">
                        <thead>
                            <td>Date</td>
                            <th>Title</th>
                            <th>Requested to</th>

                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($myRequests as $request)
                            <tr>
                                <td>{{$request->created_at->diffForHumans()}}</td>
                                <td>{{ $request->title }}</td>
                                <td>{{$request->requestedTo->name}}</td>


                                <td>
                                    {{-- <a href="{{ route('clients.transactions.add', $client) }}" class="btn btn-link"
                                    data-toggle="tooltip" data-placement="bottom" title="Register Transation">
                                    <i class="tim-icons icon-simple-add"></i>
                                    </a>
                                    <a href="{{ route('requests.show', $request) }}" class="btn btn-link"
                                        data-toggle="tooltip" data-placement="bottom" title="See Client">

                                        <i class="tim-icons icon-zoom-split"></i>
                                    </a> --}}


                                    <a href="{{ route('product-request.download', $request) }}" class="btn btn-link"
                                        data-toggle="tooltip" data-placement="bottom" title="Download">
                                        <i class="tim-icons icon-cloud-download-93"></i>
                                    </a>
                                    <a href="{{ route('requests.show', $request->id) }}" class="btn btn-link"
                                        data-toggle="tooltip" data-placement="bottom" title="More Details">
                                        <i class="tim-icons icon-zoom-split"></i>
                                    </a>
                                    <a href="{{ route('requests.edit', $request->id) }}" class="btn btn-link"
                                        data-toggle="tooltip" data-placement="bottom" title="Edit Provider">
                                        <i class="tim-icons icon-pencil"></i>
                                    </a>
                                    <form action="{{ route('requests.destroy', $request) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-link" data-toggle="tooltip"
                                            data-placement="bottom" title="Delete Provider"
                                            onclick="confirm('Are you sure you want to delete this provider? Records of payments made to him will not be deleted.') ? this.parentElement.submit() : ''">
                                            <i class="tim-icons icon-simple-remove"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card card-tasks">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">My requested</h4>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-full-width table-responsive">
                    <table class="table">
                        <thead>
                            <td>Date</td>
                            <th>Title</th>

                            <th>Requested by</th>
                            <th></th>

                        </thead>
                        <tbody>
                            @foreach ($requestedProducts as $request)
                            <tr>
                                <td>{{$request->created_at->diffForHumans()}}</td>
                                <td>{{ $request->title }}</td>
                                <td>{{$request->requestedTo->name}}</td>

                                <td>

                                    {{$request->user->name}}

                                </td>
                                <td>
                                    <a href="{{ route('product-request.download', $request) }}" class="btn btn-link"
                                        data-toggle="tooltip" data-placement="bottom" title="Download">
                                        <i class="tim-icons icon-cloud-download-93"></i>
                                    </a>
                                    <a href="{{ route('requests.show', $request->id) }}" class="btn btn-link"
                                        data-toggle="tooltip" data-placement="bottom" title="More Details">
                                        <i class="tim-icons icon-zoom-split"></i>
                                    </a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endif

@endsection

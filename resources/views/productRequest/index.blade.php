@extends('layouts.app', ['page' => 'List of Providers', 'pageSlug' => 'providers', 'section' => 'providers'])

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
                                {{-- <th scope="col">Requested to</th> --}}
                                <th scope="col">Description</th>
                                <th scope="col"></th>
                                
                            </thead>
                            <tbody>
                                @foreach ($productRequests as $request)
                                    <tr>
                                        <td>{{$request->created_at->diffForHumans()}}</td>
                                        <td>{{ $request->title }}</td>
                                        {{-- <td>{{$request->userable->names}}</td> --}}
                                        {{-- <td>{{ $request->description }}</td> --}}
                                        <td>{!! $request->description !!}</td>
                                       
                                        <td class="td-actions text-right">
                                            <a href="{{ route('requests.show', $request) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="More Details">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            <a href="{{ route('requests.edit', $request) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Provider">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('requests.destroy', $request) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Provider" onclick="confirm('Are you sure you want to delete this provider? Records of payments made to him will not be deleted.') ? this.parentElement.submit() : ''">
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


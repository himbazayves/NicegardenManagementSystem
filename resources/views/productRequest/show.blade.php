{{-- @extends('layouts.app', ['page' => 'List of Providers', 'pageSlug' => 'providers', 'section' => 'providers']) --}}
@extends('layouts.app', ['page' => __('Request Management'), 'pageSlug' => 'show_request', 'section' => 'requests'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Show Request</h4>
                        </div>
                        <div class="col-4 text-right">
                          <a href="{{ route('requests.index') }}" class="btn btn-sm btn-primary">Back to the list</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                  <center>
                    <input class="btn btn-success btn-sm " type="button" id="create_pdf" value="download">
                    <form class="form" style="max-width: none; width: 1005px;">
                        <div id="content" class="">


                        <h2>{{$productRequest->title}}</h1>
                        <h3>Date:{{$productRequest->created_at}}</h3>
                        <h3>From:{{$productRequest->user->name}}</h4>

                        {!! $productRequest->description !!}
                        
                    </div>
                   </form>
                    
                </center>  
                </div>
                <div class="card-footer py-4">
                    
                </div>
            </div>
        </div>
    </div>
@endsection


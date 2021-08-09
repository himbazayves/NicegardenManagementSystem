{{-- @extends('layouts.app', ['page' => 'New Request', 'pageSlug' => 'request', 'section' => 'requests']) --}}
@extends('layouts.app', ['page' => __('Request Management'), 'pageSlug' => 'create_requests', 'section' => 'requests'])
@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">New requests</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('requests.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('requests.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Request Information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Title</label>
                                    <input type="text" name="title" id="input-name" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('title') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'title'])
                                </div>

                                <div class="form-group{{ $errors->has('resquestTo') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">Request to</label>
                                    <select type="text" name="requestTo" id="requestTo" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Description" required>
                                        <option value="">Select who you want to request</option>
                                        <option value="chef">Chef</option>
                                        <option value="restoChef">Restaurent</option>
                                        <option value="waiter">Waiter</option>
                                        <option value="stockManager">Stock Manager</option>
                                        <option value="accountant">Accountant</option>
                                        <option value="houseKeeper">House keeper</option>
                                        
                                    </select>    
                                    @include('alerts.feedback', ['field' => 'requestTo'])
                                </div>

                                <div class="form-group{{ $errors->has('person') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">Select person </label>
                                    <select type="text" name="person" id="person" class="form-control form-control-alternative{{ $errors->has('person') ? ' is-invalid' : '' }}"  required>
                                        {{-- <option value="">Select who you want to request</option> --}}
                                        
                                        
                                    </select>    
                                    @include('alerts.feedback', ['field' => 'requestTo'])
                                </div>

                               
                                <div class="form-group{{ $errors->has('reference') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone">Reference</label>
                                    <input type="text" name="reference" id="input-phone" class="form-control form-control-alternative{{ $errors->has('reference') ? ' is-invalid' : '' }}" placeholder="Reference" value="{{ old('reference') }}" required>
                                    @include('alerts.feedback', ['field' => 'reference'])
                                </div>
                                <div class="form-group">
                                    <label class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">Description</label>
                                    <textarea class="ckeditor form-control " name="description"></textarea>
                                    @include('alerts.feedback', ['field' => 'description'])
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

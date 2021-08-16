{{-- @extends('layouts.app', ['page' => 'New Request', 'pageSlug' => 'request', 'section' => 'requests']) --}}
@extends('layouts.app', ['page' => __('Request Management'), 'pageSlug' => 'edit_requests', 'section' => 'requests'])
@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Edit request</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('requests.update', $product) }}" class="btn btn-sm btn-primary">Back to List</a>
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
                                <input type="text" name="title" id="input-name"
                                    class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    value="{{ $product->title }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'title'])
                            </div>

                            <div class="form-group{{ $errors->has('resquestTo') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-description">Request to</label>
                                <select type="text" name="requestTo" id="requestTo"
                                    class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                    placeholder="Description" required>
                                    <option value="{{$product->requestedTo->id}}" selected>

                                        @if ($product->requestedTo->userable_type=="App\StockManager")
                                        Stock Manager
                                        @elseif($product->requestedTo->userable_type=="App\Waiter")
                                        Waiter

                                        @elseif($product->requestedTo->userable_type=="App\restoChef")
                                        Restaurent
                                        @elseif($product->requestedTo->userable_type=="App\Chef")
                                        Chef
                                        @elseif($product->requestedTo->userable_type=="App\Accountant")
                                        Accountant
                                        @else
                                        House keeper

                                        @endif
                                    </option>
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
                                <select type="text" name="person" id="person"
                                    class="form-control form-control-alternative{{ $errors->has('person') ? ' is-invalid' : '' }}"
                                    required>
                                    <option value="{{$product->requestedTo->id}}"> {{$product->requestedTo->name}}
                                    </option>


                                </select>
                                @include('alerts.feedback', ['field' => 'requestTo'])
                            </div>
                           <center>Requested products </center>
                            @foreach ($product->requested_products as $product)
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group mb-3">

                                        <select name="product[]" class="form-control m-input" required>
                                            <option value="{{ $product->product_list->id}}"  selected> {{ $product->product_list->name}}</option>
                                            @foreach ($products as $product_list)
                                            <option value="{{$product_list->id}}">{{$product_list->name}}</option>
                                            @endforeach
                                        </select>


                                        <input type="number" name="quantity[]" class="form-control m-input"
                                            value="{{ $product->quantity}}" autocomplete="off" required>

                                    </div>
                                </div>
                            </div>

                            @endforeach
                           

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">Update </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('javascript')





@endsection

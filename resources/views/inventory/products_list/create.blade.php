@extends('layouts.app', ['page' => 'New ProductList', 'pageSlug' => 'productsList', 'section' => 'inventory'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">New Product</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('productsList.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('productsList.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Product Information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Name</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>

                                <div class="form-group{{ $errors->has('product_category_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Category</label>
                                    <select name="product_category_id" id="input-category" class="form-select form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required>
                                        @foreach ($categories as $category)
                                            @if($category['id'] == old('document'))
                                                <option value="{{$category['id']}}" selected>{{$category['name']}}</option>
                                            @else
                                                <option value="{{$category['id']}}">{{$category['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'product_category_id'])
                                </div>

                                {{-- <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">Description</label>
                                    <input type="text" name="description" id="input-description" class="form-control form-control-alternative" placeholder="Description" value="{{ old('description') }}" required>
                                    @include('alerts.feedback', ['field' => 'description'])
                                </div> --}}
                                <div class="row">
                                    <div class="col-6">                                    
                                        <div class="form-group{{ $errors->has('product_measurement_id') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">Measurement</label>
                                            <select name="product_measurement_id" id="product_measurement_id" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required>
                                                @foreach ($measurements as $measurement)
                                                    @if($measurement['id'] == old('document'))
                                                        <option value="{{$measurement['id']}}" selected>{{$measurement['name']}}</option>
                                                    @else
                                                        <option value="{{$measurement['id']}}">{{$measurement['name']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @include('alerts.feedback', ['field' => 'product_measurement_id'])
                                        </div>
                                    </div>                            
                                    
                                    <div class="col-6">                                    
                                        <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-price">Price</label>
                                            <input type="number" step=".01" name="price" id="input-price" class="form-control form-control-alternative" placeholder="Price" value="{{ old('price') }}" required>
                                            @include('alerts.feedback', ['field' => 'price'])
                                        </div>
                                    </div>                            
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        })
    </script>
@endpush
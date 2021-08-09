@extends('layouts.app', ['page' => 'Edit Product', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edit Product</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('products.update', $product) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">Product Information</h6>
                            <div class="pl-lg-4">

                                <div class="form-group{{ $errors->has('product') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Seclect product type</label>
                                    <select name="product" id="product" class="form-select form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required>
                                        @foreach ($produtLists as $produtList)
                                            @if($produtList['id'] == old('document'))
                                                <option value="{{$produtList['id']}}" selected>{{$produtList['name']}} </option>
                                            @else
                                                <option value="{{$produtList['id']}}">{{$produtList['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'product_category_id'])
                                </div>

                              


                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">Description</label>
                                    <input type="text" name="description" id="input-description" class="form-control form-control-alternative" placeholder="Description" value="{{ old('description', $product->description) }}" required>
                                    @include('alerts.feedback', ['field' => 'description'])

                                </div>
                                <div class="row">
                                    <div class="col-4">                                    
                                        <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-stock">Stock</label>
                                            <input type="number" name="stock" id="input-stock" class="form-control form-control-alternative" placeholder="Stock" value="{{ old('stock', $product->stock) }}" required>
                                            @include('alerts.feedback', ['field' => 'stock'])
                                        </div>
                                    </div>                            
                                    <div class="col-4">                                    
                                        <div class="form-group{{ $errors->has('stock_defective') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-stock_defective">Defective Stock</label>
                                            <input type="number" name="stock_defective" id="input-stock_defective" class="form-control form-control-alternative" placeholder="Defective Stock" value="{{ old('stock_defective', $product->stock_defective) }}" required>
                                            @include('alerts.feedback', ['field' => 'stock_defective'])
                                        </div>
                                    </div>
                                    <div class="col-4">                                    
                                        <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-price">Price</label>
                                            <input type="number" step=".01" name="price" id="input-price" class="form-control form-control-alternative" placeholder="Price" value="{{ old('price', $product->price) }}" required>
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
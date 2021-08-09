@extends('layouts.app', ['page' => 'New Product', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Stock Topup </h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('products.stock.topUpInsert',$product->id) }}" autocomplete="off">
                        @csrf

                        <h6 class="heading-small text-muted mb-4">Product Stock [{{$product->name}}]</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-12">
                                  
                                    <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-stock">Stock</label>
                                        <input type="number" name="stock" id="input-stock"
                                            class="form-control form-control-alternative" placeholder="Stock"
                                            value="{{ old('stock') }}" required>
                                        @include('alerts.feedback', ['field' => 'stock'])
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">Top up</button>
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

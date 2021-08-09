@extends('layouts.app', ['page' => 'List of Products', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">Products</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">New product stock</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('alerts.success')

                <div class="">
                    <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                            <th scope="col">Category</th>
                            <th scope="col">Product</th>
                            <th scope="col">Base Price</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Faulty</th>
                            <th scope="col">Total Sold</th>
                            <th scope="col">Action</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td><a
                                        href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a>
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ format_money($product->price) }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->stock_defective }}</td>
                                <td>{{ $product->solds->sum('qty') }}</td>
                                <td><a data-toggle="modal" data-target="#{{$product->name }}" class="btn btn-sm btn-success"> <i
                                            class="tim-icons icon-simple-add"></i> Top uP</a></td>
                                <td class="td-actions text-right">

                                    <a href="{{ route('products.show', $product) }}" class="btn btn-link"
                                        data-toggle="tooltip" data-placement="bottom" title="More Details">
                                        <i class="tim-icons icon-zoom-split"></i>
                                    </a>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-link"
                                        data-toggle="tooltip" data-placement="bottom" title="Edit Product">
                                        <i class="tim-icons icon-pencil"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-link" data-toggle="tooltip"
                                            data-placement="bottom" title="Delete Product"
                                            onclick="confirm('Are you sure you want to remove this product? The records that contain it will continue to exist.') ? this.parentElement.submit() : ''">
                                            <i class="tim-icons icon-simple-remove"></i>
                                        </button>
                                    </form>
                                </td>



                                <!-- top up Modal -->
                                <div id="{{$product->name }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Top up form for {{$product->name }} </h4>
                                            </div>
                                            <div class="modal-body">
                                              <form action="post" method="{{route('products.topUp')}}">
                                                @csrf
                                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-description">Top up amount</label>
                                                    <input type="text" name="stock" id="{{$product->name }}" class="form-control form-control-alternative" placeholder="Description" value="{{ old('stock') }}" required>
                                                    @include('alerts.feedback', ['field' => 'stock'])
                                                </div>
                                                  <button class="btn btn-primary">Top up</button>
                                            </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- end of modal-->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end">
                    {{ $products->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

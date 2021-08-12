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
                                <input type="text" name="title" id="input-name"
                                    class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    placeholder="Name" value="{{ old('title') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'title'])
                            </div>

                            <div class="form-group{{ $errors->has('resquestTo') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-description">Request to</label>
                                <select type="text" name="requestTo" id="requestTo"
                                    class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                    placeholder="Description" required>
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
                                <select type="text" name="person" id="person"
                                    class="form-control form-control-alternative{{ $errors->has('person') ? ' is-invalid' : '' }}"
                                    required>
                                    {{-- <option value="">Select who you want to request</option> --}}


                                </select>
                                @include('alerts.feedback', ['field' => 'requestTo'])
                            </div>


                            <div class="form-group{{ $errors->has('reference') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-phone">Reference</label>
                                <input type="text" name="reference" id="input-phone"
                                    class="form-control form-control-alternative{{ $errors->has('reference') ? ' is-invalid' : '' }}"
                                    placeholder="Reference" value="{{ old('reference') }}" required>
                                @include('alerts.feedback', ['field' => 'reference'])
                            </div>

                            <div class="form-group{{ $errors->has('reference') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-phone">Description</label>
                                {{-- <input type="text" name="reference" id="input-phone"
                                    class="form-control form-control-alternative{{ $errors->has('reference') ? ' is-invalid' : '' }}"
                                    placeholder="Reference" value="{{ old('reference') }}" required> --}}

                                    <textarea name="description" id="" cols="30" rows="10" value="{{ old('description') }}"
                                    class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" required>
                                   </textarea>
                                @include('alerts.feedback', ['field' => 'description'])
                            </div>







                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="inputFormRow">
                                        <div class="input-group mb-3">
                                          

                                            <select name="product[]" id="" class="form-control m-input" required>
                                                <option value="" disabled selected> Select product</option>
                                                @foreach ($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            </select>


                                            <input type="number" name="quantity[]" class="form-control m-input"
                                                placeholder="quantity" autocomplete="off" required>
                                            <div class="input-group-append">

                                                <button id="addRow" type="button"> <i
                                                        class="tim-icons icon-simple-add"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="newRow"></div>
                                   
                                </div>
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


@section('javascript')




<script type="text/javascript">
    // add row
    $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';

        html += '<select name="product[]" id="" class="form-control m-input" required>'
        html += '<option value="" disabled selected > Select product</option> '
        html += '@foreach ($products as $product) '
        html += '<option value="{{$product->id}}">{{$product->name}}</option>'
        html += ' @endforeach'
        html += '</select>'

        html +=
            '<input type="number" name="quantity[]" class="form-control m-input" placeholder="quantity" required>';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" > <i class="tim-icons icon-simple-remove"></i></button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });

</script>
@endsection


@extends('layouts.app', ['page' => __('Request Management'), 'pageSlug' => 'show_request', 'section' => 'requests'])

@section('style')
<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(n+2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.item input {
        padding-left: 5px;
    }

    .invoice-box table tr.item td:first-child input {
        margin-left: -5px;
        width: 100%;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    .invoice-box input[type=number] {
        width: 60px;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }


    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }

</style>

@endsection

@section('content')




<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h3 class="mb-0">Show  request</h3>
                        </div>

                        
                        <div class="col-4 text-right">
                            <a href="{{ route('requests.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form" style="max-width: none; width: 1005px;">
                        <div class="invoice-box">
                            <table cellpadding="0" cellspacing="0">
                                <tr class="top">
                                    <td colspan="4">

                                        <table>
                                            <tr>
                                                <td class="title">
                                                    <img src="https://www.sparksuite.com/images/logo.png"
                                                        style="width:100%; max-width:300px;">
                                                </td>

                                                <td>
                                                    Request by : <br> Names: {{$product->user->name}} <br>
                                                    Email:{{$product->user->email}} <br> Created:
                                                    
                                                    {{date_format($product->created_at, 'g:ia \o\n l jS F Y')}} <br>
                                                    
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr class="information">
                                    <td colspan="4">
                                        <table>
                                            <tr>
                                                <td>
                                                    Sparksuite, Inc.<br> 12345 Sunny Road<br> Sunnyville, CA 12345
                                                </td>

                                                <td>
                                                    Request To : <br> Names: {{$product->requestedTo->name}} <br>
                                                    Email:{{$product->requestedTo->email}} <br>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr class="heading">
                                    <td colspan="3">
                                        Invoice type
                                    </td>

                                    <td>
                                        Number #
                                    </td>
                                </tr>

                                <tr class="details">
                                    <td colspan="3">
                                        Bon de Command
                                    </td>

                                    <td>
                                       {{$product->id}}
                                    </td>
                                </tr>

                                <tr class="heading">
                                    <td>
                                        Item
                                    </td>

                                    <td>
                                        Unit Cost
                                    </td>

                                    <td>
                                        Quantity
                                    </td>

                                    <td>
                                        Price
                                    </td>
                                </tr>
                                <tbody id="tbody">

                                    @php
                                    $total=0
                                    
                                    @endphp

                                    @foreach ($product->requested_products as $product)
                                    @php
                                    $subtotal=0;
                                    $subtotal=$product->quantity * $product->product_list->price;
                                    $total=$total+$subtotal; 
                                    @endphp 

                                    <tr class="item">
                                        <td>
                                            {{$product->product_list->name}}

                                        </td>

                                        <td>
                                            FRW {{number_format($product->product_list->price)}}.
                                        </td>

                                        <td>
                                            {{$product->quantity}}
                                        </td>

                                        <td>
                                            FRW {{number_format($product->quantity * $product->product_list->price )}}.
                                        </td>
                                    </tr>
                                    @endforeach





                                </tbody>


                                <tr class="total">
                                    <td colspan="3"></td>

                                    <td>
                                        Total: FRW {{number_format($total)}}.
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('javascript')

<script>
    (function () {
        var
            form = $('.form'),
            cache_width = form.width(),
            a4 = [595.28, 841.89]; // for a4 size paper width and height

        $('#create_pdf').on('click', function () {
            $('body').scrollTop(0);
            // $('#table');
            createPDF();
        });
        //create pdf
        function createPDF() {
            getCanvas().then(function (canvas) {
                var
                    img = canvas.toDataURL("image/png"),
                    doc = new jsPDF({
                        unit: 'px',
                        format: 'a4'
                    });
                doc.addImage(img, 'JPEG', 20, 20);
                doc.save('product-request.pdf');
                form.width(cache_width);
            });
        }

        // create canvas object
        function getCanvas() {
            form.width((a4[0] * 1.33333) - 80).css('max-width', 'none');
            return html2canvas(form, {
                imageTimeout: 2000,
                removeContainer: true
            });
        }

    }());

</script>

@endsection

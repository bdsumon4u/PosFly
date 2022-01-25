<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sale {{$sale['Ref']}}</title>
    <link rel="stylesheet" href="{{url('/css/invoice_style.css')}}" media="all" />
</head>

<body>
<header>
    <div class="clearfix">
        <div style="float: left">
            <img src="{{ url($setting['logo']) }}" />
        </div>
        <div style="float: right; margin-left: 10px; width: 250px;">
            <div><strong>Company: </strong>{{$setting['CompanyName']}}</div>
            <div><strong>Phone: </strong><a href="tel:{{$setting['CompanyPhone']}}">{{$setting['CompanyPhone']}}</a></div>
            <div><strong>Email: </strong><a href="mailto:{{$setting['email']}}">{{$setting['email']}}</a></div>
            <div><strong>Address: </strong>{{$setting['CompanyAdress']}}</div>
        </div>
    </div>
    <div class="clearfix">
        <div style="float: left; margin-right: 10px; width: 250px;">
            <div><strong>Recipient:</strong></div>
            <div><strong>Name: </strong>{{$sale['client_name']}}</div>
            <div><strong>Phone: </strong><a href="tel:{{$sale['client_phone']}}">{{$sale['client_phone']}}</a></div>
            <div><strong>Email: </strong><a href="mailto:{{$sale['client_email']}}">{{$sale['client_email']}}</a></div>
            <div><strong>Address: </strong>{{$sale['client_adr']}}</div>
        </div>
        <div style="float: right; margin-left: 10px; width: 250px;">
            <div><strong>Date: </strong>{{$sale['date']}}</div>
            <div><strong>Time: </strong>{{$sale['time']}}</div>
            <div><strong>Invoice: </strong>{{$sale['Ref']}}</div>
            <div><strong>Payment Status: </strong><span style="text-transform: uppercase;">{{$sale['payment_status']}}</span></div>
            <div><strong>Served by: </strong>{{$sale['served_by']}}</div>
        </div>
    </div>
</header>
<main>
    <h1>INVOICE</h1>
    <table style="width: 100%;">
        <thead>
        <tr>
            <th>PRODUCT</th>
            <th class="text-right">PRICE</th>
            <th class="text-right">QTY</th>
            <th class="text-right">DISCOUNT</th>
            <th class="text-right">TAX</th>
            <th class="text-right">TOTAL</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($details as $detail)
            <tr>
                <td>{{$detail['code']}} ({{$detail['name']}})</td>
                <td class="text-right">{{$detail['price']}} </td>
                <td class="text-right">{{$detail['quantity']}}/{{$detail['unitSale']}}</td>
                <td class="text-right">{{$detail['DiscountNet']}} </td>
                <td class="text-right">{{$detail['taxe']}} </td>
                <td class="text-right">{{$detail['total']}} </td>
            </tr>
        @endforeach
        </tbody>
        <tbody class="meta">
            <tr>
                <td colspan="5" class="b-top text-right">Sub Total</td>
                <td class="b-top text-right">{{$sale['subtotal']}}</td>
            </tr>
            <tr>
                <td colspan="5" class="text-right">Order Tax</td>
                <td class="text-right">+{{$sale['TaxNet']}}</td>
            </tr>
            <tr>
                <td colspan="5" class="text-right">Service Charge</td>
                <td class="text-right">+{{$sale['shipping']}}</td>
            </tr>
            <tr>
                <td colspan="5" class="text-right">Discount</td>
                <td class="text-right">-{{$sale['discount']}}</td>
            </tr>
            <tr>
                <td colspan="5" class="grand text-right">TOTAL</td>
                <td class="grand text-right">{{ $symbol }} {{$sale['GrandTotal']}}</td>
            </tr>
            <tr>
                <td colspan="5" class="grand text-right">PAID</td>
                <td class="grand text-right">{{ $symbol }} {{$sale['PaidAmount']}}</td>
            </tr>
            <tr>
                <td colspan="5" class="grand text-right">DUE</td>
                <td class="grand text-right">{{ $symbol }} {{$sale['due']}}</td>
            </tr>
        </tbody>
    </table>
    @if($sale['note'])
    <div id="notices">
        <div class="notice"><strong>NOTE:</strong>&nbsp;<span style="white-space: pre-line">{{ $sale['note'] }}</span></div>
    </div>
    @endif
</main>
<footer style="left: 25px">
    <small>Sincerely,</small><br>
    <strong>Cyber 32 Team</strong>
</footer>
<footer style="right: 25px">
    <span>-------------------------------------------</span>
    <p style="margin: .15rem 0 .5rem 0; font-weight: bold;">Received By,</p>
    <span>Received the above items in good condition.</span>
</footer>
</body>
</html>

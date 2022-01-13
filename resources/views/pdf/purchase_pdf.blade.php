<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Purchase {{$purchase['Ref']}}</title>
    <link rel="stylesheet" href="{{url('/css/invoice_style.css')}}" media="all" />
</head>

<body>
<header>
    <div class="clearfix">
        <div style="float: left">
            <img src="{{ url($setting['logo']) }}" />
        </div>
        <div style="float: right; margin-left: 10px; width: 200px;">
            <div><strong>Date: </strong>{{$purchase['date']}}</div>
            <div><strong>Serial: </strong>{{$purchase['Ref']}}</div>
            <div><strong>Status: </strong><span style="text-transform: uppercase;">{{$purchase['statut']}}</span></div>
            <div><strong>Payment Status: </strong><span style="text-transform: uppercase;">{{$purchase['payment_status']}}</span></div>
        </div>
    </div>
    <div class="clearfix">
        <div style="float: left; margin-right: 10px; width: 250px;">
            <div><strong>TO:</strong></div>
            <div><strong>Company: </strong>{{$setting['CompanyName']}}</div>
            <div><strong>Phone: </strong><a href="tel:{{$setting['CompanyPhone']}}">{{$setting['CompanyPhone']}}</a></div>
            <div><strong>Email: </strong><a href="mailto:{{$setting['email']}}">{{$setting['email']}}</a></div>
            <div><strong>Address: </strong>{{$setting['CompanyAdress']}}</div>
        </div>
        <div style="float: right; margin-left: 10px; width: 200px;">
            <div><strong>FROM:</strong></div>
            <div><strong>Name: </strong>{{$purchase['supplier_name']}}</div>
            <div><strong>Phone: </strong><a href="tel:{{$purchase['supplier_phone']}}">{{$purchase['supplier_phone']}}</a></div>
            <div><strong>Email: </strong><a href="mailto:{{$purchase['supplier_email']}}">{{$purchase['supplier_email']}}</a></div>
            <div><strong>Address: </strong>{{$purchase['supplier_adr']}}</div>
        </div>
    </div>
</header>
<main>
    <table>
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
                <td class="text-right">{{$detail['cost']}} </td>
                <td class="text-right">{{$detail['quantity']}}/{{$detail['unit_purchase']}}</td>
                <td class="text-right">{{$detail['DiscountNet']}} </td>
                <td class="text-right">{{$detail['taxe']}} </td>
                <td class="text-right">{{$detail['total']}} </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5" class="text-right">Order Tax</td>
            <td class="text-right">{{$purchase['TaxNet']}}</td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">Discount</td>
            <td class="text-right">{{$purchase['discount']}}</td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">Shipping</td>
            <td class="text-right">{{$purchase['shipping']}}</td>
        </tr>
        <tr>
            <td colspan="5" class="grand text-right">GRAND TOTAL</td>
            <td class="grand text-right">{{ $symbol }} {{$purchase['GrandTotal']}}</td>
        </tr>
        </tbody>
    </table>
    <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">Thank you for being with us.</div>
    </div>
</main>
<footer>
    Invoice was created on a computer and is valid without the signature and seal.
</footer>
</body>
</html>

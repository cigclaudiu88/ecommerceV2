<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .font {
            font-size: 12px;
        }

        .authority {
            /*text-align: center;*/
            float: right
        }

        .authority h5 {
            margin-top: -10px;
            color: green;
            /*text-align: center;*/
            margin-left: 35px;
        }

        .thanks p {
            color: green;
            ;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }

    </style>

</head>

<body>

    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">
                <!-- {{-- <img src="" alt="" width="150"/> --}} -->
                <h2 style="color: green; font-size: 26px;"><strong>eShop UPT</strong></h2>
            </td>
            <td align="right">
                <pre class="font">
               <strong>SC. eShop UPT SRL</strong>
               CUI 123456 Reg.C J40/1709/2012<br>
               <strong>Email: </strong>suport@eshopupt.ro
               <strong>Telefon:</strong> 0722 223 331
              <strong>Adresa: </strong> Str. Vasile Parvan Nr.9 Timisoara <br>
            </pre>
            </td>
        </tr>
    </table>


    <table width="100%" style="background:white; padding:2px;""></table>

  <table width=" 100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                    <strong>Nume client:</strong> {{ $order->shipping_first_name }}<span>
                    </span>{{ $order->shipping_last_name }}<br>
                    <strong>Adresa e-mail:</strong> {{ $order->shipping_email }} <br>
                    <strong>Telefon:</strong> {{ $order->shipping_phone }} <br>

                    @php
                        // preluam judetul si localitatea
                        $div = $order->division->division_name;
                        $dis = $order->district->district_name;
                    @endphp

                    <strong>Adresa:</strong>Str.{{ $order->shipping_street }}<span>
                        Nr.</span>{{ $order->shipping_street_number }}<span> Bloc
                    </span>{{ $order->shipping_building }}
                    <span>Apartament Nr.</span>{{ $order->shipping_apartment }} <br><span>Judet:</span>
                    {{ $div }}<span> Localitate: </span>{{ $dis }}<br>
                </p>
            </td>
            <td>
                <p class="font" style="margin-left: 20px;">
                <h3><span style="color: green;">Factura:</span> <strong>{{ $order->invoice_no }}</strong></h3>
                <strong>Data comanda: </strong>{{ $order->order_date }} <br>
                <strong>Modalitate de plata: <br></strong>{{ $order->payment_method }} </span>
                </p>
            </td>
        </tr>
    </table>
    <br />
    <h3>Produse</h3>

    <table width="100%">
        <thead style="background-color: green; color:#FFFFFF;">
            <tr class="font">
                <th>Poza Produs</th>
                <th>Nume Produs</th>
                {{-- <th>Code Produs</th> --}}
                <th>Cantitate</th>
                <th>Pret Unitar </th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItem as $item)
                <tr class="font">
                    <td align="center">
                        <img src="{{ public_path($item->product->product_thumbnail) }}" height="60px;" width="60px;"
                            alt="">
                    </td>
                    <td align="left">{{ $item->product->product_name }}</td>
                    {{-- <td align="center">{{ $item->product->product_code }}</td> --}}
                    <td align="center">{{ $item->qty }} BUC</td>
                    <td align="center">{{ number_format($item->price, 2, '.', ',') }} RON</td>
                    <td align="center">{{ number_format($item->price * $item->qty, 2, '.', ',') }} RON</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table width="100%" style=" padding:0 10px 0 10px;">

        <tr>
            <td align="right">
                {{-- <h2><span style="color: green;">Subtotal:</span> Subtotal RON</h2>
                <h2><span style="color: green;">TVA:</span> TVA RON</h2> --}}
                <h2><span style="color: green;">Total:</span> {{ $order->amount }} RON</h2>
                <h2><span style="color: green;">Plata efectuata</h2>
            </td>
        </tr>

    </table>
    <div class="thanks mt-3">
        <strong>
            <p>Multumim pentru ca a-ti cumparat de la eShop UPT</p>
        </strong>
    </div>
</body>

</html>

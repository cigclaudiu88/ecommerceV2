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
            font-size: 15px;
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
                    <strong>Nume client:</strong> Name <br>
                    <strong>Adresa e-mail:</strong> Email <br>
                    <strong>Telefon:</strong> Phone <br>
                    <strong>Adresa:</strong> Address <br>
                </p>
            </td>
            <td>
                <p class="font">
                <h3><span style="color: green;">Factura:</span> #Invoice</h3>
                <strong>Data comanda</strong> : Order Date <br>
                <strong>Modalitate de plata</strong> : Payment Type </span>
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
                <th>Code Produs</th>
                <th>Cantitate</th>
                <th>Pret Unitar </th>
                <th>Total </th>
            </tr>
        </thead>
        <tbody>
            <tr class="font">
                <td align="center">
                    <img src=" " height="60px;" width="60px;" alt="">
                </td>
                <td align="center">product_name</td>
                <td align="center">product_code</td>
                <td align="center">cantitate</td>
                <td align="center">pret</td>
                <td align="center">price Tk</td>

            </tr>

        </tbody>
    </table>
    <br>
    <table width="100%" style=" padding:0 10px 0 10px;">
        <tr>
            <td align="right">
                <h2><span style="color: green;">Subtotal:</span> Subtotal RON</h2>
                <h2><span style="color: green;">TVA:</span> TVA RON</h2>
                <h2><span style="color: green;">Total:</span> Total RON</h2>
                <h2><span style="color: green;">Plata efectuata</h2>
            </td>
        </tr>
    </table>
    <div class="thanks mt-3">
        <p>Multumim pentru ca a-ti cumparat de la eShop UPT</p>
    </div>
</body>

</html>

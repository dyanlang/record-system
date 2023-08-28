<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Report</title>

    <style>

        #customers , p, h4 {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;

        }
    </style>
</head>
<body>


<header>
    <?php

        $path = public_path('/logo/seventh-day-adventist-logo.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    
    ?>

    <center>
        <h4>
            <img src="{{ $base64 }}" style="vertical-align: text-bottom; width: 60px; height: 60px;">
            The Seventh Day Adventist Church
        </h4>
    </center>
</header>

<div class="container" style="margin-top: 5%; font-size: 13px;">

    <p style="text-align:left;">Generated Report
        <span style="float: right; font-size: 13px;">
            <?php
                #to display the current date, time of the generated report
                $current_date = \Carbon\Carbon::now()->toDateString(); 
                echo "Date : ".$current_date;

            ?>
        </span>
    </p>

</div>

<br>

<div class="container mt-3 ml-3">

    <table id="customers" style="font-size: 12px;">
        <tr>
            <th scope="col">
                No
            </th>
            <th scope="col">
                Processed By
            </th>
            <th scope="col">
                Disbursement / Expenses Purpose
            </th>
            <th scope="col">
                Amount
            </th>
            <th scope="col">
                Date Created
            </th>
        </tr>

        <?php

            $no = 0;
            
        ?>

        @foreach ($exportDSMENT as $dsment)
            <tr>
                <td>
                    <?php $no++; ?>

                    {{ $no }}
                </td>
                <td>
                    {{ $dsment->firstname }} {{ $dsment->lastname }}
                </td>
                <td>
                    {{ $dsment->disbursement_purpose }}
                </td>
                <td>

                    Php {{ number_format($dsment->disbursement_amount, 2) }}

                </td>
                <td>
                    {{ $dsment->disbursement_date }}
                </td>
            </tr>

        @endforeach

        
    </table>
</div>

<div class="container" style="margin-top: 5%; font-size: 13px;">
    <p>Prepared By :

        {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                
    </p>

</div>
    
</body>
</html>
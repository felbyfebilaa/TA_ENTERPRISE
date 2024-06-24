<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"> -->
    <title>Laporan Costumer - <?= date('d-m-Y') ?></title>
    <style>
        .data-customer {
            float: left;
            position: absolute;
            top: 66;
        }

        .data-tranksaksi {
            float: right;
            position: absolute;
            top: 60;
        }
    </style>
</head>

<body>
<h2 style="text-align: center;">Data Costumer </h2>
<table border="1" cellpadding="1" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th style="text-align: center; width:6%;">No</th>
        <th style="text-align: center; width:30%;">Nama Customer</th>
        <th style="text-align: center; width:20%;">KTP</th>
        <th style="text-align: center; width:20%;">No Telepon</th>
        <th style="text-align: center; width:24%;">Alamat</th>
    </tr>
    </thead>
    <tbody class="first">
    <?php
    $no = 1;
    foreach ($costumer as $c => $customer) :
        ?>
        <tr>
            <td style="text-align: left;"><?= $no++; ?></td>
            <td style="text-align: left;"><?= $customer['Nama']; ?></td>
            <td style="text-align: left;"><?= $customer['NIK']; ?></td>
            <td style="text-align: left;"><?= $customer['No_HP']; ?></td>
            <td style="text-align: left;"><?= $customer['Alamat']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</div>
</body>

</html>
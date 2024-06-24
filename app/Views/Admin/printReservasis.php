<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"> -->
    <title>Laporan Reservasi - <?= date('d-m-Y') ?></title>
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
<h2 style="text-align: center;">Laporan Reservasi </h2>
<table border="1" cellpadding="1" cellspacing="0" style="width:100%;">
    <thead>
    <tr>
        <th style="text-align: center; width:6%;">No</th>
        <th style="text-align: center; width:25%;">Nama Customer</th>
        <th style="text-align: center; width:15%;">KTP</th>
        <th style="text-align: center; width:15%;">No Telepon</th>
        <th style="text-align: center; width:24%;">Paket Makeup</th>
        <th style="text-align: center; width:15%;">harga Paket</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $no = 1;
    foreach ($reservasis as $c => $r) :
        ?>
        <tr>
            <td style="text-align: left;" ><?= $no++; ?></td>
            <td style="text-align: left;"><?= $r['Nama']; ?></td>
            <td style="text-align: center;"><?= $r['NIK']; ?></td>
            <td style="text-align: center;"><?= $r['No_HP']; ?></td>
            <td style="text-align: left;"><?= $r['nama_paket_makeup']; ?></td>
            <td style="text-align: right;"><?= $r['harga_paket_makeup']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</div>
</body>

</html>
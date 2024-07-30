<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <style>
        #table {
            font-family: "times new roman", Times, serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div style="text-align:center">
        <h3>Laporan Daftar Inventaris Barang HIMA-TI POLITALA</h3>
    </div>
    <table id="table">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Tanggal Masuk</th>
                <th>Kondisi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barang as $brg) : ?>
                <tr>
                    <td scope="row"><?= $brg['kdbarang']; ?></td>
                    <td><?= $brg['nama_barang']; ?></td>
                    <td><?= $brg['nama_kategori']; ?></td>
                    <td><?= date('d-m-Y', strtotime($brg['tgl_masuk'])); ?></td>
                    <td><?= $brg['kondisi_barang']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
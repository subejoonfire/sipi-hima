<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Nota Penitipan Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            /* Sesuaikan ukuran font */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
            /* Sesuaikan padding */
            text-align: left;
        }

        .heading {
            text-align: center;
            margin-bottom: 10px;
            /* Sesuaikan margin */
        }

        .peringatan {
            margin-top: 20px;
            font-size: 10px;
            /* Sesuaikan ukuran font */
            color: red;
            /* Sesuaikan warna teks */
        }
    </style>
</head>

<body>
    <h2 class="heading">Nota Penitipan Barang</h2>
    <table>
        <tr>
            <th>ID</th>
            <td><?= $penitipan['id_penitipan'] ?></td>
        </tr>
        <tr>
            <th>Nama Pelanggan</th>
            <td><?= $pelanggan['nama_pelanggan'] ?></td>
        </tr>
        <tr>
            <th>Delegasi</th>
            <td><?= $pelanggan['delegasi'] ?></td>
        </tr>
        <tr>
            <th>Nama Barang</th>
            <td><?= $penitipan['nama_barang'] ?></td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td><?= $penitipan['jumlah_barang'] ?></td>
        </tr>
        <tr>
            <th>Tanggal Titip</th>
            <td><?= $penitipan['tgl_titip'] ?></td>
        </tr>
        <tr>
            <th>Tanggal Kembali</th>
            <td><?= $penitipan['tgl_kembali'] ?></td>
        </tr>
    </table>
    <div class="peringatan">
        <p>Peringatan: Kami tidak bertanggung jawab atas kehilangan atau kerusakan barang jika barang tidak diambil selama 3 hari setelah tenggat waktu.</p>
    </div>
</body>

</html>
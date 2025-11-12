<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perhitungan Nilai Akhir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
        }

        input[type="number"],
        select {
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 10px;
            background-color: #c24f71ff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #882148ff;
        }

        h4 {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #c24f71ff;
            color: white;
        }

        .hasil {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>PERHITUNGAN NILAI AKHIR KULIAH</h2>
        <hr>
        <p style="font-size: 13px; color: black; text-align: center;">NAMA: Al AMANI ABAS</p>
        <p style="font-size: 13px; color: black; text-align: center;">NIM: 202404020</p>
        <hr>

        <?php
        $persentase = array(
            "kehadiran" => 0.10,
            "tugas" => 0.30,
            "uts" => 0.30,
            "uas" => 0.30
        );

        $mahasiswa = array("Almani", "Abas", "Dean", "Muhammad", "Alnizar");

        function hitungNilaiAkhir($kehadiran, $tugas, $uts, $uas, $persentase)
        {
            $nilaiAkhir = ($kehadiran * $persentase['kehadiran']) +
                ($tugas * $persentase['tugas']) +
                ($uts * $persentase['uts']) +
                ($uas * $persentase['uas']);
            return $nilaiAkhir;
        }
        function grade($nilaiAkhir)
        {
            if ($nilaiAkhir >= 90) {
                return "A";
            } elseif ($nilaiAkhir >= 80) {
                return "AB";
            } elseif ($nilaiAkhir >= 70) {
                return "B";
            } elseif ($nilaiAkhir >= 60) {
                return "BC";
            } elseif ($nilaiAkhir >= 50) {
                return "C";
            } elseif ($nilaiAkhir >= 40) {
                return "D";
            } else {
                return "E";
            }
        }
        ?>
        <form action="" method="post">
            <label for="mahasiswa">Pilih Mahasiswa</label>
            <select name="mahasiswa" required>
                <option value="" disabled selected>Pilih Mahasiswa</option>
                <?php
                foreach ($mahasiswa as $mhs) {
                    echo "<option value='$mhs'>$mhs</option>";
                }
                ?>
            </select>

            <label for="kehadiran">Nilai Kehadiran (0-100):</label>
            <input type="number" name="kehadiran" id="kehadiran" required>

            <label for="tugas">Nilai Tugas (0-100):</label>
            <input type="number" name="tugas" id="tugas" required>

            <label for="uts">Nilai UTS (0-100):</label>
            <input type="number" name="uts" id="uts" required>

            <label for="uas">Nilai UAS (0-100):</label>
            <input type="number" name="uas" id="uas" required>

            <input type="submit" name="hitung" value="Hitung Nilai Akhir">
        </form>

        <?php
        if (isset($_POST['hitung'])) {
            $namaMahasiswa = $_POST['mahasiswa'];
            $kehadiran = $_POST['kehadiran'] ?? 0;
            $tugas = $_POST['tugas'] ?? 0;
            $uts = $_POST['uts'] ?? 0;
            $uas = $_POST['uas'] ?? 0;

            $nilaiAkhir = hitungNilaiAkhir($kehadiran, $tugas, $uts, $uas, $persentase);
            $gradeNilai = grade($nilaiAkhir);

            echo "
            <div class='hasil'>
                <h3>Hasil Nilai Akhir</h3>
                <h4>Nama Mahasiswa: $namaMahasiswa</h4>
                <table>
                    <tr>
                        <th>Komponen</th>
                        <th>Bobot</th>
                        <th>Nilai</th>
                        <th>Kontribusi</th>
                    </tr>
                    <tr>
                        <td>Kehadiran</td>
                        <td>" . ($persentase['kehadiran'] * 100) . "%</td>
                        <td>$kehadiran</td>
                        <td>" . number_format(($kehadiran * $persentase['kehadiran']), 2) . "</td>
                    </tr>
                    <tr>
                        <td>Tugas</td>
                        <td>" . ($persentase['tugas'] * 100) . "%</td>
                        <td>$tugas</td>
                        <td>" . number_format($tugas * $persentase['tugas'], 2) . "</td>
                    </tr>
                    <tr>
                        <td>UTS</td>
                        <td>" . ($persentase['uts'] * 100) . "%</td>
                        <td>$uts</td>
                        <td>" . number_format($uts * $persentase['uts'], 2) . "</td>
                    </tr>
                    <tr>
                        <td>UAS</td>
                        <td>" . ($persentase['uas'] * 100) . "%</td>
                        <td>$uas</td>
                        <td>" . number_format($uas * $persentase['uas'], 2) . "</td>
                    </tr>
                    <tr>
                        <th colspan='3'>Nilai Akhir</th>
                        <th>" . number_format($nilaiAkhir, 2) . "</th>
                    </tr>
                    <tr>
                        <th colspan='3'>Nilai Huruf</th>
                        <th>$gradeNilai</th>
                    </tr>
                </table>
            </div>";
        }
        ?>
    </div>
</body>

</html>
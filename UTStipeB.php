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
    </style>
</head>

<body>
    <div class="container">
        <h2>PERHITUNGAN NILAI AKHIR KULIAH</h2>

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

            <label for="kehadiran">Nilai Kehadiran</label>
            <input type="number" name="kehadiran" id="kehadiran" required>

            <label for="tugas">Nilai Tugas</label>
            <input type="number" name="tugas" id="tugas" required>

            <label for="uts">Nilai UTS</label>
            <input type="number" name="uts" id="uts" required>

            <label for="uas">Nilai UAS</label>
            <input type="number" name="uas" id="uas" required>

            <input type="submit" name="hitung" value="Hitung Nilai Akhir">
        </form>

        <?php
        if (isset($_POST['hitung'])) {
            $namaMahasiswa = $_POST['mahasiswa'];
            $kehadiran = $_POST['kehadiran'];
            $tugas = $_POST['tugas'];
            $uts = $_POST['uts'];
            $uas = $_POST['uas'];

            $nilaiAkhir = hitungNilaiAkhir($kehadiran, $tugas, $uts, $uas, $persentase);
            $gradeNilai = grade($nilaiAkhir);

            echo "<h3>Hasil Nilai Akhir</h3>";
            echo "<table border='0' cellpadding='5'>";
            echo "<tr><td>Nama Mahasiswa</td><td>: <b>$namaMahasiswa</b></td></tr>";
            echo "<tr><td>Kehadiran</td><td>: $kehadiran x " . ($persentase['kehadiran'] * 100) . "% = " . number_format($kehadiran * $persentase['kehadiran'], 2) . "</td></tr>";
            echo "<tr><td>Tugas</td><td>: $tugas x " . ($persentase['tugas'] * 100) . "% = " . number_format($tugas * $persentase['tugas'], 2) . "</td></tr>";
            echo "<tr><td>UTS</td><td>: $uts x " . ($persentase['uts'] * 100) . "% = " . number_format($uts * $persentase['uts'], 2) . "</td></tr>";
            echo "<tr><td>UAS</td><td>: $uas x " . ($persentase['uas'] * 100) . "% = " . number_format($uas * $persentase['uas'], 2) . "</td></tr>";
            echo "<tr><td><b>Nilai Akhir</b></td><td>: <b>" . number_format($nilaiAkhir, 2) . "</b></td></tr>";
            echo "<tr><td><b>Nilai Huruf</b></td><td>: <b>$gradeNilai</b></td></tr>";
            echo "</table>";
        }
        ?>
    </div>
</body>

</html>
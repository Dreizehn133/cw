<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- <style>
        table, th, td {
        border: 1px solid black;
    }
    </style> -->
</head>
<body>
<form action="cari.php" method="POST">
    <table>
        <tr><td colspan="2">PENCARIAN</td></tr>
        <tr>
            <td>FROM</td>
            <td><input type="date" name="mulai"/></td>
        </tr>
        <tr>
            <td>TO</td>
            <td><input type="date" name="akhir"/></td>
        </tr>
        <tr>
            <td>Absen</td>
            <td><select name="pilihan">
                <option value="0">Semua</option>
                <option value="1">Masuk</option>
                <option value="2">Pulang??</option>
                <option value="3">Break IN</option>
                <option value="4">Break OUT</option>
                <option value="5">Lembur Masuk</option>
                <option value="6">ot_out/PULANG</option>
            </select></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit"></td>
        </tr>
    </table>
</form>

<table  cellpadding="2" border="1">

<tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Tanggal Absen</th>
    <th>Type Attendance</th>
    <th>keterangan</th>
    <th>Tanggal Input</th>
    <th>HAPUS</td>
</tr>

<?php
    $x = date('Y-m-d');
    require_once('koneksi.php');
    echo "Absen Tanggal ".$x;
    $sql = "SELECT a.id as id,a.employee_id as eid, a.dt as finger, a.created as serper, b.first_name as nama1, c.name as atd, b.last_name as nama2, a.attendance_type_id as tipe  FROM attendances a, biodata b, attendance_types c WHERE a.employee_id=b.id && a.created LIKE '$x%' && a.attendance_type_id=c.id ORDER BY a.employee_id";
    $res = mysqli_query($koneksi,$sql);
  
  $idd=0;
  $tipe=0;
  $ket='';
    while($row = mysqli_fetch_array($res)){
        // echo "<tr><td>".$row['nama1']."</td>
        // <td>".$row['nama2']."</td>
        // <td>".$row['finger']."</td>
        // <td>".$row['tipe']."</td>
        // </tr>";
        if($row['eid']==$idd && $row['tipe']==$tipe){
            $ket='Double Absen';
        }else {
            $idd=$row['eid'];
            $tipe=$row['tipe'];
            $ket='';
        }
        ?>
            <tr>
                <td><?=$row['nama1']?></td>
                <td><?=$row['nama2']?></td>
                <td><?=$row['finger']?></td>
                <td><?=$row['tipe']?> - <?=$row['atd']?></td>
                <td><?=$ket?></td>
                <td><?=$row['serper']?></td>
                <td><a href="delete.php?q=<?=$row['id']?>" >Hapus</a></td>
            </tr>
        <?php
    }
?>
</table>
</body>
</html>


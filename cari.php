<a href="index.php">Kembali</a>
<table  cellpadding="2" border="1">

<tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Tanggal Absen</th>
    <th>Jam Absen</th>
    <th>Type Attendance</th>
    <th>keterangan</th>
    <th>Tanggal Input</th>
    <th>HAPUS</td>
</tr>

<?php
require_once('koneksi.php');
if($_SERVER['REQUEST_METHOD']=='POST') {
    $mulai = $_POST['mulai'];
    $akhir = $_POST['akhir'];
    $p=$_POST['pilihan'];
    echo $mulai.' Sampai '.$akhir;
    $sql='';
    if($p==0){
        $sql = "SELECT a.id as id,a.employee_id as eid, a.dt as finger, a.created as serper, 
    b.first_name as nama1, c.name as atd, b.last_name as nama2,
    a.attendance_type_id as tipe  
    FROM attendances a, biodata b, attendance_types c 
    WHERE a.employee_id=b.id && 
    a.dt BETWEEN '".$mulai." 00:00:00' and '".$akhir." 23:59:59' && 
    a.attendance_type_id=c.id ORDER BY a.employee_id";    
    }else{ 
        $sql = "SELECT a.id as id,a.employee_id as eid, a.dt as finger, a.created as serper, 
    b.first_name as nama1, c.name as atd, b.last_name as nama2,
    a.attendance_type_id as tipe  
    FROM attendances a, biodata b, attendance_types c 
    WHERE a.employee_id=b.id && 
    a.dt BETWEEN '".$mulai." 00:00:00' and '".$akhir." 23:59:59' && 
    a.attendance_type_id=c.id && a.attendance_type_id=".$p." ORDER BY a.employee_id";
    }
    
    $res = mysqli_query($koneksi,$sql);
  
  $idd=0;
  $ket='';
  $tgl='';
    while($row = mysqli_fetch_array($res)){
        // echo "<tr><td>".$row['nama1']."</td>
        // <td>".$row['nama2']."</td>
        // <td>".$row['finger']."</td>
        // <td>".$row['tipe']."</td>
        // </tr>";
        $newDate = date("d-m-Y", strtotime($row['finger']));
        if($row['eid']==$idd && $row['tipe']==$tipe&&$tgl==$newDate){
            $ket='Double Absen';
        }else {
            $idd=$row['eid'];
            $tipe=$row['tipe'];
            $ket='';
            $tgl=$newDate;
        }
        ?>
            <tr>
                <td><?=$row['nama1']?></td>
                <td><?=$row['nama2']?></td>
                <td><?=date("l, d M Y",strtotime($row['finger']))?></td>
                <td><?=date("H:i:s",strtotime($row['finger']))?></td>
                <td><?=$row['tipe']?> - <?=$row['atd']?></td>
                <td><?=$ket?></td>
                <td><?=$row['serper']?></td>
                <td><a href="delete.php?q=<?=$row['id']?>" >Hapus</a></td>
            </tr>
        <?php
    }
    
}
?>
</table>
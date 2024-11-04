<a href="<?php echo "?p=kategori"; ?>"><button type="button" class="btn btn-add">KATEGORI</button></a>
<button type="button" class="btn btn-dis">Tambah Kategori</button>
<br>
<div class="card">
<div class="kepalacard">Tambah Kategori</div>
<div class="isicard" style="text-align:center;">
<form name="form1" method="post" action="" enctype="multipart/form-data">
    <input type="text" name="namakat" id="namakat" placeholder="Nama Kategori">
    <textarea name="ketkat" id="ketkat" placeholder="Keterangan Kategori"></textarea>
    <input type="submit" value="SIMPAN KATEGORI" id="simpan" name="simpan">
</form>

<?php
if(isset($_POST["simpan"])){
    if(!empty($_POST["namakat"]) && !empty($_POST["ketkat"])){
        $sqlk = mysqli_query($kon, "insert into kategori (idadmin,namakat,ketkat,tglkat) values ('$ra[idadmin]','$_POST[namakat]','$_POST[ketkat]',NOW())");

        if($sqlk){
            echo "Kategori Berhasil Disimpan";
        }else{
            echo "Gagal Menyimpan";
        }
        echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=kategori'>";
        }else{
            echo "Isi Data dengan Lengkap";
    }
    }
    ?>
</div>
</div>
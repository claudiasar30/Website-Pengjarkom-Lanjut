<a href="<?php echo "?p=produk"; ?>"><button type="button" class="btn btn-add">PRODUK</button></a>
<button type="button" class="btn btn-dis">Tambah Produk</button>
<br>
<div class="card">
<div class="kepalacard">Tambah Produk</div>
<div class="isicard" style="text-align:center;">
<form action="" name="form1" method="post" enctype="multipart/form-data">
    <?php
    $sqlk = mysqli_query($kon,"select * from kategori order by namakat asc");
    echo "<select name='idkat'>";
    echo "<option value=''>Kategori</option>";
    while($rk = mysqli_fetch_array($sqlk)){
        echo "<option value='$rk[idkat]'>$rk[namakat]</option>";
    }
    echo "</select>";
    ?>
    <input type="text" name="nama" id="nama" placeholder="Nama Produk">
    <input type="text" name="harga" id="harga" placeholder="Harga Produk(Dalam Rp.)">
    <input type="text" name="stok" id="stok" placeholder="Stok Produk">
    <textarea name="spesifikasi" id="spesifikasi" placeholder="Spesifikasi Produk"></textarea>
    <textarea name="detail" id="detail" placeholder="Detail Produk"></textarea>
    <input name="diskon" id="diskon" placeholder="Diskon Produk(Dalam %)">
    <input type="text" name="berat" id="berat" placeholder="Berat Produk(dalam Kg)">
    <textarea name="isikotak" id="isikotak" placeholder="Isi dalam Kotak Produk"></textarea>
    <input type="file" name="foto1" id="foto1">
    <input type="file" name="foto2" id="foto2">
    <input type="submit" value="SIMPAN PRODUK" name="simpan" id="simpan">
</form>

<?php
if($_POST["simpan"]){
    if(!empty($_POST["idkat"]) and !empty($_POST["nama"]) and !empty($_POST["harga"]) and !empty($_POST["stok"]) and !empty($_POST["spesifikasi"]) and !empty($_POST["detail"]) and !empty($_POST["berat"]) and !empty($_POST["isikotak"])){
        $nmfoto1 = $_FILES["foto1"]["name"];
        $lokfoto1 = $_FILES["foto1"]["tmp_name"];
        if(!empty($lokfoto1)){
            move_uploaded_file($lokfoto1, "../fotoproduk/$nmfoto1");
        }

        $nmfoto2 = $_FILES["foto2"]["name"];
        $lokfoto2 = $_FILES["foto2"]["tmp_name"];
        if(!empty($lokfoto2)){
            move_uploaded_file($lokfoto2, "../fotoproduk/$nmfoto2");
        }

        $spek = nl2br($_POST["spesifikasi"]);
        $detail = nl2br($_POST["detail"]);
        $isi = nl2br($_POST["isikotak"]);

        $sqlp = mysqli_query($kon,"insert into produk (idkat, idadmin, nama, harga, stok, spesifikasi, detail, diskon, berat, isikotak, foto1, foto2, tglproduk) values ('$_POST[idkat]','$ra[idadmin]', '$_POST[nama]','$_POST[harga]','$_POST[stok]','$spek','$detail','$_POST[diskon]','$_POST[berat]','$isi','$nmfoto1','$nmfoto2',NOW())");

        if($sqlp){
            echo "Produk Berhasil Disimpan";
        }else{
            echo "Gagal Menyimpan";
        }
        echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=produk'>";
    }else{
        echo "Data harus diisi dengan lengkap !!!";
    }
    }
    ?>
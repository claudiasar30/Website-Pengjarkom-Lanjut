<?php
$sqlp = mysqli_query($kon,"select * from produk where idproduk='$_GET[id]'");
$rp = mysqli_fetch_array($sqlp);
?>
<a href="<?php echo "?p=produk"; ?>"><button type="button" class="btn btn-add">PRODUK</button></a>
<button type="button" class="btn btn-dis">Ubah Produk</button>
<br>
<div class="card">
<div class="kepalacard">Ubah Produk</div>
<div class="isicard" style="text-align:center;">
<form action="" method="post" name="form1" enctype="multipart/form-data">
    <input type="hidden" name="idproduk" value="<?php echo "$rp[idproduk]"; ?>"/>
    <?php
    $sqlk = mysqli_query($kon, "select * from kategori where idkat='$rp[idkat]'");
    $rk = mysqli_fetch_array($sqlk);
    ?>
    <input type="text" name="namakat" id="" disabled value="<?php echo "$rk[namakat]"; ?>"/>
    <input type="text" name="nama" id="nama" placeholder="Nama Produk" value="<?php echo "$rp[nama]"; ?>">
    <input type="text" name="harga" id="harga" placeholder="Harga Produk (dalam Rp.)" value="<?php echo "$rp[harga]"; ?>">
    <input type="text" name="stok" id="stok" placeholder="Stok Produk" value="<?php echo "$rp[stok]"; ?>">
    <textarea name="spesifikasi" id="spesifikasi" placeholder="Spesifikasi produk"><?php echo "$rp[spesifikasi]"; ?></textarea>
    <textarea name="detail" id="detail" placeholder="Detail produk"><?php echo "$rp[detail]"; ?></textarea>
    <input type="text" name="diskon" id="diskon" placeholder="Diskon Produk (dalam %)" value="<?php echo "$rp[diskon]"; ?>">
    <input type="text" name="berat" id="berat" placeholder="Berat Produk (dalam KG)" value="<?php echo "$rp[berat]"; ?>">
    <textarea name="isikotak" id="isikotak" placeholder="isi dalam kotak produk"><?php echo "$rp[isikotak]"; ?></textarea>
    <p><img src="<?php echo "../fotoproduk/$rp[foto1]"; ?>" height="200px" alt="">
    <input type="file" name="foto1" id="foto1">
    <p><img src="<?php echo "../fotoproduk/$rp[foto2]"; ?>" height="200px" alt="">
    <input type="file" name="foto2" id="foto2">
    <input type="submit" value="SIMPAN PRODUK" name="simpan" id="simpan">
</form>

<?php
if($_POST["simpan"]){
    if(!empty($_POST["nama"]) and !empty($_POST["harga"]) and !empty($_POST["stok"]) and !empty($_POST["spesifikasi"]) and !empty($_POST["detail"]) and !empty($_POST["berat"]) and !empty($_POST["isikotak"])){
        $nmfoto1 = $_FILES["foto1"]["name"];
        $lokfoto1 = $_FILES["foto1"]["tmp_name"];
        if(!empty($lokfoto1)){
            move_uploaded_file($lokfoto1,"../fotoproduk/$nmfoto1");
            $foto1 =", foto1='$nmfoto1'";
        }else{
            $foto1 = "";
        }

        $nmfoto2 = $_FILES["foto2"]["name"];
        $lokfoto2 = $_FILES["foto2"]["tmp_name"];
        if(!empty($lokfoto2)){
            move_uploaded_file($lokfoto2,"../fotoproduk/$nmfoto2");
            $foto2 =", foto2='$nmfoto2'";
        }else{
            $foto2 = "";
        }

        $sqlp = mysqli_query($kon,"update produk set nama='$_POST[nama]',harga='$_POST[harga]',stok='$_POST[stok]',spesifikasi='$_POST[spesifikasi]',detail='$_POST[detail]',diskon='$_POST[diskon]',berat='$_POST[berat]',isikotak='$_POST[isikotak]' $foto1 $foto2 where idproduk='$_POST[idproduk]'");

        if($sqlp){
            echo "Perubahan Produk berhasil Disimpan";
        }else{
            echo "Gagal Menyimpan";
        }
        echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=produk'>";
    }else{
        echo "Data harus diisi dengan lengkap !!!";
    }
}
?>
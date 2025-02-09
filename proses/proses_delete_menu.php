<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$foto = (isset($_POST['foto'])) ? htmlentities($_POST['foto']) : "";

if (!empty($_POST['input_user_validate'])) {
   // Hapus data terkait di tabel tb_list_order terlebih dahulu
   $delete_order = mysqli_query($conn, "DELETE FROM tb_list_order WHERE menu = '$id'");

   if ($delete_order) {
      // Kemudian hapus data di tb_daftar_menu
      $query = mysqli_query($conn, "DELETE FROM tb_daftar_menu WHERE id='$id'");
      if ($query) {
         unlink("../assets/img/$foto");
         $message = '<script>alert("data berhasil dihapus");
            window.location="../menu"</script>';
      } else {
         $message = '<script>alert("data gagal dihapus")
                      window.location="../menu"</script>';
      }
   } else {
      $message = '<script>alert("data di tb_list_order gagal dihapus")
                   window.location="../menu"</script>';
   }
}
echo $message;

?>
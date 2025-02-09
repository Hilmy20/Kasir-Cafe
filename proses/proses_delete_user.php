<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";


if (!empty($_POST['delete_user_validate'])) {
   $query = mysqli_query($conn, "DELETE FROM tb_user WHERE id='$id'");
   if ($query) {
      unlink("../assets/img/$foto");
      $message = '<script>alert("data berhasil dihapus");
        window.location="../user";</script>';
   } else {
      $message = '<script>alert("data gagal dihapus")
      window.location="../user";</script>';
   }
}
echo $message;
?>
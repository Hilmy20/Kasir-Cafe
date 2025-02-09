<?php
include "proses/connect.php";

// Initialize $result as an empty array
$result = [];

$query = mysqli_query($conn, "SELECT * FROM tb_kategori_menu");

if ($query) {
    // Fetch all the records into the $result array
    while ($record = mysqli_fetch_array($query)) {
        $result[] = $record;
    }
}
?>

<div class="col-lg-9 mt-2">
  <div class="card">
    <div class="card-header">
      Halaman Kategori Menu
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col d-flex justify-content-end">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaltambahuser">Tambah Kategori Menu</button>
        </div>
      </div>

      <!-- Modal tambah kategori menu baru-->
      <div class="modal fade" id="modaltambahuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="modaltambahuser">Tambah kategori Menu</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" novalidate action="proses/proses_input_katmenu.php" method="POST">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <select class="form-select" name="jenismenu" required>
                        <option value="1">Makanan</option>
                        <option value="2">Minuman</option>
                      </select>
                      <label for="floatingInput">Jenis Menu</label>
                      <div class="invalid-feedback">
                        Masukkan Jenis Menu
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingInput" placeholder="Kategori Menu" name="katmenu" required>
                      <label for="floatingInput">Kategori Menu</label>
                      <div class="invalid-feedback">
                        Masukkan Kategori Menu
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="input_katmenu_validate" value="12345">Save changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Check if $result is not empty -->
    <?php if (!empty($result)): ?>
      <!-- Tabel Daftar Kategori menu-->
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Jenis Menu</th>
              <th scope="col">Kategori Menu</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($result as $row):
            ?>
              <tr>
                <th scope="row"><?= $no++ ?></th>
                <td><?= ($row['jenis_menu'] == 1) ? "Makanan" : "Minuman" ?></td>
                <td><?= $row['kategori_menu'] ?></td>
                <td class="d-flex">
                  <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?= $row['id_kat_menu'] ?>">
                    <i class="bi bi-pencil-square"></i>
                  </button>
                  <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelete<?= $row['id_kat_menu'] ?>">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- End Tabel Daftar Kategori menu-->
    <?php else: ?>
      <p>Data kategori menu tidak ada.</p>
    <?php endif; ?>

    <!-- Modals for Edit and Delete -->
    <?php foreach ($result as $row): ?>
      <!-- Modal Edit -->
      <div class="modal fade" id="ModalEdit<?= $row['id_kat_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5">Edit Data Kategori Menu</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" novalidate action="proses/proses_edit_katmenu.php" method="POST">
                <input type="hidden" name="id" value="<?= $row['id_kat_menu'] ?>">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <select class="form-select" required name="jenismenu">
                        <?php
                        $data = array("Makanan", "Minuman");
                        foreach ($data as $key => $value):
                          $selected = ($row['jenis_menu'] == $key + 1) ? 'selected' : '';
                          echo "<option $selected value='" . ($key + 1) . "'>$value</option>";
                        endforeach;
                        ?>
                      </select>
                      <label for="floatingInput">Jenis Menu</label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="katmenu" required value="<?= $row['kategori_menu'] ?>" />
                      <label for="floatingInput">Kategori Menu</label>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Delete -->
      <div class="modal fade" id="ModalDelete<?= $row['id_kat_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5">Delete Data Kategori Menu</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="proses/proses_delete_katmenu.php" method="POST">
                <input type="hidden" name="id" value="<?= $row['id_kat_menu'] ?>">
                <p>Apakah Anda ingin menghapus kategori <b><?= $row['kategori_menu'] ?></b>?</p>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

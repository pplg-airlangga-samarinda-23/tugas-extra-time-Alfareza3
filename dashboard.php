<?php

include 'koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$sql = "SELECT * FROM barang";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <div class="logo">👻🐦‍🔥👻</div>
      <nav>
        <button class="nav-btn">Dashboard</button>
        <button class="nav-btn">Master Barang</button>
        <button class="nav-btn">Receiving</button>
        <button class="nav-btn">Issuing</button>
      </nav>
    </aside>

    <main class="main-content">
      <div class="user-info">
        <span class="username">Dimas</span>
        <div class="user-avatar"></div>
      </div>

      <div class="content">
        <input type="text" placeholder="Pencarian" class="search-btn">
        <button type="submit">Cari</button>
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Pengadaan</th>
              <th>Stok</th>
              <th colspan="2">Status</th>
            </tr>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th>Baik</th>
              <th>Rusak</th>
            </tr>
          </thead>
          <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$no}</td>
                                    <td>{$row['nama_barang']}</td>
                                    <td>{$row['pengadaan']}</td>
                                    <td>{$row['stok']}</td>
                                    <td>{$row['baik']}</td>
                                    <td>{$row['rusak']}</td>
                                </tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr>
                                    <td colspan='6'>Tidak ada data</td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
        </table>
      </div>
      <footer>
        <span>© 2024</span>
        <span>Versi 10</span>
      </footer>
    </main>
  </div>
</body>
</html>
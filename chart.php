<?php
include 'koneksi.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id']; // ⬅️ Ambil user yang login

// Ambil batas kategori sesuai user
$batas_query = mysqli_query($conn, "SELECT nama_kategori, batas FROM kategori_batas WHERE user_id = $user_id");
$limits = [];
while ($row = mysqli_fetch_assoc($batas_query)) {
    $limits[$row['nama_kategori']] = (int)$row['batas'];
}

// Ambil total pengeluaran per kategori untuk user ini saja
$query = mysqli_query($conn, "SELECT kategori, SUM(nominal) as total_pengeluaran FROM uang_keluar WHERE user_id = $user_id GROUP BY kategori");
$categories = [];
$expenses = [];
while ($row = mysqli_fetch_assoc($query)) {
    $categories[] = $row['kategori'];
    $expenses[] = (int)$row['total_pengeluaran'];
}
?>

<div style="max-width: 800px; margin: 0 auto;">
  <canvas id="modernBarChart" style="height: 400px;"></canvas>
  <script>
    const categories = <?php echo json_encode($categories); ?>;
    const expenses = <?php echo json_encode($expenses); ?>;
    const limits = <?php echo json_encode($limits); ?>;

    const ctx = document.getElementById('modernBarChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(0, 123, 255, 1)');
    gradient.addColorStop(1, 'rgba(0, 255, 255, 0.5)');

    const barColors = expenses.map((expense, index) => {
      return expense > limits[categories[index]] ? 'rgba(255, 0, 0, 0.7)' : gradient;
    });

    const modernBarChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: categories,
        datasets: [{
          label: 'Pengeluaran per Kategori',
          data: expenses,
          backgroundColor: barColors,
          borderColor: '#0056b3',
          borderWidth: 1,
          hoverBackgroundColor: '#0056b3',
          hoverBorderColor: '#003366',
          borderRadius: 10,
          barThickness: 30,
          hoverBorderWidth: 2,
          tension: 0.4,
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: {
            grid: { display: false },
            ticks: {
              font: { size: 14, weight: 'bold' },
              color: '#333',
            },
          },
          y: {
            grid: { borderColor: 'rgba(0, 0, 0, 0.1)' },
            ticks: {
              beginAtZero: true,
              font: { size: 14, weight: 'bold' },
              color: '#333',
              callback: function(value) { return 'Rp ' + value.toLocaleString(); },
            },
          },
        },
        plugins: {
          tooltip: {
            backgroundColor: '#333',
            titleColor: '#fff',
            bodyColor: '#fff',
            bodyFont: { size: 14 },
            footerFont: { size: 12 },
          },
        },
        animation: { duration: 1000, easing: 'easeInOutQuart' },
      },
    });

    expenses.forEach((expense, index) => {
  if (expense > limits[categories[index]]) {
    const category = categories[index];
    const alertHTML = `
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Peringatan!</strong> Pengeluaran untuk kategori <strong>${category}</strong> telah melebihi batas.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;
    document.getElementById("alertContainer").insertAdjacentHTML("beforeend", alertHTML);
  }
});

  </script>
</div>

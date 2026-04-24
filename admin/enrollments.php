<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
include '../config/db.php';

// Confirm action
if (isset($_GET['confirm'])) {
    $id = (int)$_GET['confirm'];
    $conn->query("UPDATE enrollments SET status='confirmed' WHERE id=$id");
    header("Location: enrollments.php"); exit();
}
// Cancel action
if (isset($_GET['cancel'])) {
    $id = (int)$_GET['cancel'];
    $conn->query("UPDATE enrollments SET status='cancelled' WHERE id=$id");
    header("Location: enrollments.php"); exit();
}
// Delete action
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM enrollments WHERE id=$id");
    header("Location: enrollments.php"); exit();
}

$filter = $_GET['filter'] ?? 'all';
$where  = $filter !== 'all' ? "WHERE status='$filter'" : '';
$enrollments = $conn->query("SELECT * FROM enrollments $where ORDER BY created_at DESC");

$pending   = $conn->query("SELECT COUNT(*) as c FROM enrollments WHERE status='pending'")->fetch_assoc()['c'];
$unread    = $conn->query("SELECT COUNT(*) as c FROM messages WHERE is_read=0")->fetch_assoc()['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>Enrollments — Smart Physics Admin</title>
  <style>
    * { margin:0; padding:0; box-sizing:border-box; }
    body { font-family:'Segoe UI',sans-serif; background:#f4f6f9; color:#333; }
    .sidebar { position:fixed; top:0; left:0; width:240px; height:100vh; background:#0f1117; padding:30px 0; z-index:100; }
    .sidebar-logo { font-size:20px; font-weight:800; color:#a78bfa; text-align:center; padding:0 20px 28px; border-bottom:1px solid #1a1d2e; }
    .sidebar-logo span { font-size:12px; color:#64748b; display:block; font-weight:400; margin-top:2px; }
    .nav-item { display:flex; align-items:center; gap:10px; padding:14px 24px; color:#64748b; text-decoration:none; font-size:14px; transition:all 0.2s; border-left:3px solid transparent; }
    .nav-item:hover, .nav-item.active { color:#a78bfa; background:rgba(124,111,205,0.1); border-left-color:#7c6fcd; }
    .badge { background:#e74c3c; color:#fff; font-size:10px; padding:2px 7px; border-radius:20px; font-weight:700; }
    .nav-logout { position:absolute; bottom:20px; width:100%; }
    .main { margin-left:240px; padding:32px; }
    .top-bar { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; }
    .top-bar h1 { font-size:24px; }
    .filters { display:flex; gap:8px; margin-bottom:20px; flex-wrap:wrap; }
    .filter-btn { padding:7px 18px; border-radius:20px; border:1px solid #ddd; background:#fff; font-size:13px; cursor:pointer; text-decoration:none; color:#555; transition:all 0.2s; }
    .filter-btn.active, .filter-btn:hover { background:#7c6fcd; color:#fff; border-color:#7c6fcd; }
    .table-wrap { background:#fff; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.06); overflow:hidden; }
    table { width:100%; border-collapse:collapse; }
    thead tr { background:#0f1117; }
    thead th { padding:13px 16px; text-align:left; font-size:11px; letter-spacing:1px; text-transform:uppercase; color:#a78bfa; }
    tbody tr { border-bottom:1px solid #f5f5f5; }
    tbody tr:hover { background:#fafbff; }
    td { padding:13px 16px; font-size:14px; vertical-align:top; }
    .status-badge { display:inline-block; padding:4px 12px; border-radius:20px; font-size:11px; font-weight:700; }
    .status-pending   { background:#fff3cd; color:#856404; }
    .status-confirmed { background:#d4edda; color:#155724; }
    .status-cancelled { background:#f8d7da; color:#721c24; }
    .action-btns { display:flex; gap:6px; flex-wrap:wrap; }
    .btn-sm { padding:5px 12px; border:none; border-radius:4px; font-size:12px; font-weight:600; cursor:pointer; text-decoration:none; display:inline-block; }
    .btn-confirm  { background:#27ae60; color:#fff; }
    .btn-cancel   { background:#e67e22; color:#fff; }
    .btn-delete   { background:#e74c3c; color:#fff; }
    .empty { text-align:center; padding:48px; color:#bbb; font-size:15px; }
  </style>
</head>
<body>
<div class="sidebar">
  <div class="sidebar-logo">Smart Physics <span>Admin Panel</span></div>
  <a href="dashboard.php"   class="nav-item">📊 Dashboard</a>
  <a href="enrollments.php" class="nav-item active">
    📋 Enrollments
    <?php if($pending > 0): ?><span class="badge"><?= $pending ?></span><?php endif; ?>
  </a>
  <a href="messages.php" class="nav-item">
    ✉️ Messages
    <?php if($unread > 0): ?><span class="badge"><?= $unread ?></span><?php endif; ?>
  </a>
  <a href="feedback.php" class="nav-item">⭐ Feedback</a>
  <a href="logout.php" class="nav-item nav-logout">🚪 Logout</a>
</div>

<div class="main">
  <div class="top-bar"><h1>📋 Enrollment Requests</h1></div>

  <div class="filters">
    <a href="enrollments.php"             class="filter-btn <?= $filter==='all'       ? 'active':'' ?>">All</a>
    <a href="enrollments.php?filter=pending"   class="filter-btn <?= $filter==='pending'   ? 'active':'' ?>">Pending</a>
    <a href="enrollments.php?filter=confirmed" class="filter-btn <?= $filter==='confirmed' ? 'active':'' ?>">Confirmed</a>
    <a href="enrollments.php?filter=cancelled" class="filter-btn <?= $filter==='cancelled' ? 'active':'' ?>">Cancelled</a>
  </div>

  <div class="table-wrap">
    <table>
      <thead><tr><th>Student</th><th>Phone</th><th>Subject</th><th>Batch</th><th>Parent</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        <?php if ($enrollments->num_rows === 0): ?>
          <tr><td colspan="8" class="empty">No enrollment requests found.</td></tr>
        <?php else: ?>
          <?php while ($row = $enrollments->fetch_assoc()): ?>
          <tr>
            <td><strong><?= htmlspecialchars($row['name']) ?></strong><br><small style="color:#999;"><?= htmlspecialchars($row['grade']) ?></small></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['subject']) ?></td>
            <td><?= htmlspecialchars($row['batch']) ?></td>
            <td><?= htmlspecialchars($row['pname']) ?></td>
            <td><?= date('d M Y', strtotime($row['created_at'])) ?></td>
            <td><span class="status-badge status-<?= $row['status'] ?>"><?= ucfirst($row['status']) ?></span></td>
            <td>
              <div class="action-btns">
                <?php if ($row['status'] === 'pending'): ?>
                  <a href="enrollments.php?confirm=<?= $row['id'] ?>" class="btn-sm btn-confirm">✔ Confirm</a>
                  <a href="enrollments.php?cancel=<?= $row['id'] ?>"  class="btn-sm btn-cancel" onclick="return confirm('Cancel this enrollment?')">✖ Cancel</a>
                <?php endif; ?>
                <a href="enrollments.php?delete=<?= $row['id'] ?>" class="btn-sm btn-delete" onclick="return confirm('Delete permanently?')">🗑</a>
              </div>
            </td>
          </tr>
          <?php endwhile; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>

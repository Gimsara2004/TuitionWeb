<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
include '../config/db.php';

$total_enrollments = $conn->query("SELECT COUNT(*) as c FROM enrollments")->fetch_assoc()['c'];
$pending           = $conn->query("SELECT COUNT(*) as c FROM enrollments WHERE status='pending'")->fetch_assoc()['c'];
$confirmed         = $conn->query("SELECT COUNT(*) as c FROM enrollments WHERE status='confirmed'")->fetch_assoc()['c'];
$unread_messages   = $conn->query("SELECT COUNT(*) as c FROM messages WHERE is_read=0")->fetch_assoc()['c'];
$today_enrollments = $conn->query("SELECT COUNT(*) as c FROM enrollments WHERE DATE(created_at)=CURDATE()")->fetch_assoc()['c'];

$recent = $conn->query("SELECT * FROM enrollments ORDER BY created_at DESC LIMIT 6");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>Dashboard — Smart Physics Admin</title>
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
    .top-bar { display:flex; justify-content:space-between; align-items:center; margin-bottom:28px; }
    .top-bar h1 { font-size:24px; color:#0f1117; }
    .top-bar .welcome { font-size:14px; color:#888; }
    .top-bar .welcome strong { color:#7c6fcd; }
    .stats-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-bottom:28px; }
    .stat-card { background:#fff; border-radius:10px; padding:22px 26px; box-shadow:0 2px 10px rgba(0,0,0,0.06); border-left:4px solid #7c6fcd; display:flex; justify-content:space-between; align-items:center; }
    .stat-card .info .num { font-size:36px; font-weight:800; color:#0f1117; }
    .stat-card .info .label { font-size:12px; color:#999; margin-top:4px; }
    .stat-card .icon { font-size:38px; opacity:0.3; }
    .stat-card.green { border-left-color:#27ae60; }
    .stat-card.blue  { border-left-color:#3498db; }
    .stat-card.red   { border-left-color:#e74c3c; }
    .stat-card.purple{ border-left-color:#9b59b6; }
    .quick-links { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:28px; }
    .quick-link { background:#fff; border-radius:10px; padding:20px; text-align:center; text-decoration:none; color:#555; box-shadow:0 2px 8px rgba(0,0,0,0.06); transition:all 0.2s; border:2px solid transparent; }
    .quick-link:hover { border-color:#7c6fcd; transform:translateY(-3px); box-shadow:0 8px 20px rgba(124,111,205,0.15); }
    .quick-link .ql-icon { font-size:30px; margin-bottom:8px; }
    .quick-link .ql-label { font-size:13px; font-weight:600; }
    .section-title { font-size:16px; font-weight:700; color:#0f1117; margin-bottom:16px; }
    .table-wrap { background:#fff; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.06); overflow:hidden; margin-bottom:28px; }
    table { width:100%; border-collapse:collapse; }
    thead tr { background:#0f1117; }
    thead th { padding:13px 16px; text-align:left; font-size:11px; letter-spacing:1px; text-transform:uppercase; color:#a78bfa; }
    tbody tr { border-bottom:1px solid #f5f5f5; }
    tbody tr:hover { background:#fafbff; }
    td { padding:13px 16px; font-size:14px; }
    .status-badge { display:inline-block; padding:4px 12px; border-radius:20px; font-size:11px; font-weight:700; }
    .status-pending   { background:#fff3cd; color:#856404; }
    .status-confirmed { background:#d4edda; color:#155724; }
    .status-cancelled { background:#f8d7da; color:#721c24; }
    .btn-confirm { background:#27ae60; color:#fff; border:none; padding:5px 14px; border-radius:4px; font-size:12px; font-weight:600; cursor:pointer; text-decoration:none; display:inline-block; }
    .view-all { display:inline-block; margin-top:12px; color:#7c6fcd; font-size:13px; font-weight:600; text-decoration:none; }
    .view-all:hover { text-decoration:underline; }
  </style>
</head>
<body>
<div class="sidebar">
  <div class="sidebar-logo">Smart Physics <span>Admin Panel</span></div>
  <a href="dashboard.php"   class="nav-item active">📊 Dashboard</a>
  <a href="enrollments.php" class="nav-item">
    📋 Enrollments
    <?php if($pending > 0): ?><span class="badge"><?= $pending ?></span><?php endif; ?>
  </a>
  <a href="messages.php" class="nav-item">
    ✉️ Messages
    <?php if($unread_messages > 0): ?><span class="badge"><?= $unread_messages ?></span><?php endif; ?>
  </a>
  <a href="feedback.php" class="nav-item">⭐ Feedback</a>
  <a href="logout.php" class="nav-item nav-logout">🚪 Logout</a>
</div>

<div class="main">
  <div class="top-bar">
    <h1>Dashboard</h1>
    <div class="welcome">Welcome back, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong> 👋 &nbsp;|&nbsp; <?= date('D, d M Y') ?></div>
  </div>

  <div class="stats-grid">
    <div class="stat-card">
      <div class="info"><div class="num"><?= $total_enrollments ?></div><div class="label">Total Enrollments</div></div>
      <div class="icon">📋</div>
    </div>
    <div class="stat-card green">
      <div class="info"><div class="num"><?= $today_enrollments ?></div><div class="label">Today's Requests</div></div>
      <div class="icon">🗓️</div>
    </div>
    <div class="stat-card red">
      <div class="info"><div class="num"><?= $pending ?></div><div class="label">Pending Approvals</div></div>
      <div class="icon">⏳</div>
    </div>
    <div class="stat-card blue">
      <div class="info"><div class="num"><?= $confirmed ?></div><div class="label">Confirmed Students</div></div>
      <div class="icon">✅</div>
    </div>
    <div class="stat-card">
      <div class="info"><div class="num"><?= $unread_messages ?></div><div class="label">Unread Messages</div></div>
      <div class="icon">✉️</div>
    </div>
  </div>

  <div class="section-title">⚡ Quick Actions</div>
  <div class="quick-links">
    <a href="enrollments.php" class="quick-link"><div class="ql-icon">📋</div><div class="ql-label">View Enrollments</div></a>
    <a href="messages.php"    class="quick-link"><div class="ql-icon">✉️</div><div class="ql-label">Read Messages</div></a>
    <a href="feedback.php"    class="quick-link"><div class="ql-icon">⭐</div><div class="ql-label">Manage Feedback</div></a>
    <a href="../index.php" target="_blank" class="quick-link"><div class="ql-icon">🌐</div><div class="ql-label">View Website</div></a>
  </div>

  <div class="section-title">📋 Recent Enrollment Requests</div>
  <div class="table-wrap">
    <table>
      <thead><tr><th>Student</th><th>Phone</th><th>Subject</th><th>Batch</th><th>Status</th><th>Action</th></tr></thead>
      <tbody>
        <?php if ($recent->num_rows === 0): ?>
          <tr><td colspan="6" style="text-align:center;padding:32px;color:#bbb;">No enrollments yet.</td></tr>
        <?php else: ?>
          <?php while ($row = $recent->fetch_assoc()): ?>
          <tr>
            <td><strong><?= htmlspecialchars($row['name']) ?></strong></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['subject']) ?></td>
            <td><?= htmlspecialchars($row['batch']) ?></td>
            <td><span class="status-badge status-<?= $row['status'] ?>"><?= ucfirst($row['status']) ?></span></td>
            <td>
              <?php if ($row['status'] === 'pending'): ?>
                <a href="enrollments.php?confirm=<?= $row['id'] ?>" class="btn-confirm">✔ Confirm</a>
              <?php else: ?><span style="color:#aaa;font-size:12px;">Done</span><?php endif; ?>
            </td>
          </tr>
          <?php endwhile; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <a href="enrollments.php" class="view-all">View all enrollments →</a>
</div>
</body>
</html>

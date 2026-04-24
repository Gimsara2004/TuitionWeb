<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
include '../config/db.php';

if (isset($_GET['read'])) {
    $id = (int)$_GET['read'];
    $conn->query("UPDATE messages SET is_read=1 WHERE id=$id");
    header("Location: messages.php"); exit();
}
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM messages WHERE id=$id");
    header("Location: messages.php"); exit();
}

$messages = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
$pending  = $conn->query("SELECT COUNT(*) as c FROM enrollments WHERE status='pending'")->fetch_assoc()['c'];
$unread   = $conn->query("SELECT COUNT(*) as c FROM messages WHERE is_read=0")->fetch_assoc()['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>Messages — Smart Physics Admin</title>
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
    .top-bar { margin-bottom:24px; }
    .top-bar h1 { font-size:24px; }
    .msg-card { background:#fff; border-radius:10px; padding:20px 24px; box-shadow:0 2px 8px rgba(0,0,0,0.06); margin-bottom:14px; border-left:4px solid #7c6fcd; display:flex; justify-content:space-between; align-items:flex-start; gap:20px; }
    .msg-card.unread { border-left-color:#e74c3c; background:#fffbf8; }
    .msg-info h4 { font-size:15px; margin-bottom:4px; }
    .msg-info .meta { font-size:12px; color:#999; margin-bottom:10px; }
    .msg-info p { font-size:14px; color:#555; line-height:1.6; }
    .msg-actions { display:flex; gap:8px; flex-shrink:0; }
    .btn-sm { padding:6px 14px; border:none; border-radius:4px; font-size:12px; font-weight:600; cursor:pointer; text-decoration:none; display:inline-block; }
    .btn-read   { background:#7c6fcd; color:#fff; }
    .btn-delete { background:#e74c3c; color:#fff; }
    .empty { text-align:center; padding:48px; color:#bbb; }
  </style>
</head>
<body>
<div class="sidebar">
  <div class="sidebar-logo">Smart Physics <span>Admin Panel</span></div>
  <a href="dashboard.php"   class="nav-item">📊 Dashboard</a>
  <a href="enrollments.php" class="nav-item">
    📋 Enrollments
    <?php if($pending > 0): ?><span class="badge"><?= $pending ?></span><?php endif; ?>
  </a>
  <a href="messages.php" class="nav-item active">
    ✉️ Messages
    <?php if($unread > 0): ?><span class="badge"><?= $unread ?></span><?php endif; ?>
  </a>
  <a href="feedback.php" class="nav-item">⭐ Feedback</a>
  <a href="logout.php" class="nav-item nav-logout">🚪 Logout</a>
</div>
<div class="main">
  <div class="top-bar"><h1>✉️ Messages</h1></div>
  <?php if ($messages->num_rows === 0): ?>
    <div class="empty">No messages yet.</div>
  <?php else: ?>
    <?php while ($msg = $messages->fetch_assoc()): ?>
    <div class="msg-card <?= !$msg['is_read'] ? 'unread' : '' ?>">
      <div class="msg-info">
        <h4><?= htmlspecialchars($msg['name']) ?> <?= !$msg['is_read'] ? '<span style="color:#e74c3c;font-size:11px;">● NEW</span>' : '' ?></h4>
        <div class="meta">
          <?= htmlspecialchars($msg['email']) ?> &nbsp;·&nbsp; <?= htmlspecialchars($msg['phone']) ?> &nbsp;·&nbsp; <?= date('d M Y H:i', strtotime($msg['created_at'])) ?>
        </div>
        <p><?= htmlspecialchars($msg['message']) ?></p>
      </div>
      <div class="msg-actions">
        <?php if (!$msg['is_read']): ?>
          <a href="messages.php?read=<?= $msg['id'] ?>" class="btn-sm btn-read">✔ Mark Read</a>
        <?php endif; ?>
        <a href="messages.php?delete=<?= $msg['id'] ?>" class="btn-sm btn-delete" onclick="return confirm('Delete this message?')">🗑</a>
      </div>
    </div>
    <?php endwhile; ?>
  <?php endif; ?>
</div>
</body>
</html>

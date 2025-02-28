<?php
include '../database/database.php';

try {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM note WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $todo = $result->fetch_assoc();
    } else {
        $todo = [
            'id' => '',
            'title' => 'Untitled',
            'content' => 'No content available',
            'status' => 0
        ];
    }
    $stmt->close();
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Note</title>
  <link rel="icon" href="../note.png" type="image/x-icon">
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="../statics/js/bootstrap.js"></script>
  <style>
    body {
      background-image: url('background.jpg'); 
      background-size: cover;
    }
    .navbar {
      background: linear-gradient(135deg, #4B79A1, #283E51);
    }
    .navbar-brand {
      font-size: 1.5rem;
      font-weight: bold;
    }
    .container {
      margin-top: 50px;
    }
    .card {
      border-radius: 12px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      background: white;
      padding: 30px;
    }
    .form-control {
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    .btn-create {
      background-color: #ffb400;
      border-color: #ffb400;
      color: white;
      transition: 0.3s;
    }
    .btn-create:hover {
      background-color: #ffa000;
      border-color: #ffa000;
    }
    .btn-back {
      background-color: #6c757d;
      border-color: #6c757d;
      color: white;
      transition: 0.3s;
    }
    .btn-back:hover {
      background-color: #5a6268;
      border-color: #5a6268;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">📒Notes Manager</a>
    </div>
  </nav>
  <div class="container d-flex justify-content-center mt-5">
    <div class="col-md-6">
      <div class="card p-4">
        <div class="row">
          <p class="display-6 fw-bold text-center">📝Edit Note</p>
        </div>
        <div class="row">
          <form class="form" action="../handlers/update_note_handler.php" method="POST">
            <input name="id" value="<?= htmlspecialchars($todo['id']) ?>" hidden />
            <div class="mb-3">
              <label class="form-label">Title</label>
              <input class="form-control" type="text" name="title" value="<?= htmlspecialchars($todo['title']) ?>" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Content</label>
              <textarea class="form-control" name="content" rows="5" required><?= htmlspecialchars($todo['content']) ?></textarea>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-dark">📝Save Note</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

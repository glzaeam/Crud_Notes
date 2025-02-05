<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Note</title>
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

  <nav class="navbar navbar-dark">
    <div class="container">
      <a class="navbar-brand text-white" href="../index.php">📒Notes Manager</a>
    </div>
  </nav>

  <div class="container d-flex justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-12">
      <div class="card">
        <h2 class="text-center mb-4 fw-bold text-dark">Create Note</h2>

        <form class="form" action="../handlers/add_note_handler.php" method="POST" autocomplete="off">
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input id="title" class="form-control" type="text" name="title" placeholder="Enter note title" required />
          </div>
          <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea id="content" class="form-control" name="content" rows="5" placeholder="Enter note content" required></textarea>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-create">📝 Create Note</button>
            <a href="../index.php" class="btn btn-back">🔙 Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>

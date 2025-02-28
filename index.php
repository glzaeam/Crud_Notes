<?php
session_start(); // Start the session
include 'database/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: views/login.php'); // Redirect to login page
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notes App</title>
    <link href="statics/css/bootstrap.min.css" rel="stylesheet">
    <script src="statics/js/bootstrap.js"></script>
    
    <style>
        body {
            background-image: url('views/background.jpg'); 
            background-size: cover;
        }
        .navbar {
            background: linear-gradient(135deg, #4B79A1, #283E51);
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .card {
            border-radius: 12px;
            transition: 0.3s;
            background: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card:hover {
            transform: scale(1.02);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
        }
        .btn-add {
            background-color: #ffb400;
            border-color: #ffb400;
            color: white;
        }
        .btn-add:hover {
            background-color: #ffa000;
            border-color: #ffa000;
        }
        .btn-warning, .btn-danger {
            transition: 0.3s;
        }
        .btn-warning:hover {
            background-color: #ff9800;
            border-color: #ff9800;
        }
        .btn-danger:hover {
            background-color: #d32f2f;
            border-color: #d32f2f;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark">
        <div class="container">
            <a class="navbar-brand text-white" href="index.php">📒Notes Manager</a>
            <a href="views/add_note.php" class="btn btn-add">+ Add Note</a>
            <a href="handlers/logout_handler.php" class="btn btn-danger">Logout</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                
                <h2 class="text-center mb-4 fw-bold text-dark">Your Notes</h2>

                <?php
                $res = $conn->query("SELECT * FROM note ORDER BY created_at DESC");

                if ($res->num_rows > 0): 
                    while ($row = $res->fetch_assoc()): 
                        $created_at = new DateTime($row['created_at']);
                        $now = new DateTime();
                        $interval = $created_at->diff($now);

                        $relative_time = '';
                        if ($interval->y > 0) {
                            $relative_time = $interval->y . ' year(s) ago';
                        } elseif ($interval->m > 0) {
                            $relative_time = $interval->m . ' month(s) ago';
                        } elseif ($interval->d > 0) {
                            $relative_time = $interval->d . ' day(s) ago';
                        } elseif ($interval->h > 0) {
                            $relative_time = $interval->h . ' hour(s) ago';
                        } elseif ($interval->i > 0) {
                            $relative_time = $interval->i . ' minute(s) ago';
                        } else {
                            $relative_time = $interval->s . ' second(s) ago';
                        }
                ?>

                <div class="card my-3">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-dark"><?= htmlspecialchars($row['title']); ?></h5>
                        <p class="card-text text-secondary"><?= nl2br(htmlspecialchars($row['content'])); ?></p>
                        <p class="card-text text-muted small">
                            🕒 Created on: <?= date('F j, Y, g:i a', strtotime($row['created_at'])); ?> 
                            (<?= $relative_time; ?>)
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="views/update_note.php?id=<?=$row['id'];?>" class="btn btn-sm btn-warning">✏️ Edit</a>
                            <a href="handlers/delete_note_handler.php?id=<?=$row['id'];?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this note?');">🗑️ Delete</a>
                        </div>
                    </div>
                </div>

                <?php 
                    endwhile; 
                else: 
                ?>

                <div class="alert alert-light text-center" role="alert">
                    <p class="text-muted">📝 No notes available! Start by adding a new note.</p>
                </div>

                <?php 
                endif; 
                ?>

            </div>
        </div>
    </div>

</body>
</html>

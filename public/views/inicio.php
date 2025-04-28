<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="/public/css/styles.css">

    <title>IdeaNest | Inicio</title>
</head>
<body>

    <?php include 'sidebar.php'; ?>
    
    <div class="main-content">
        <div class="header-container">
            <div class="sidebar-user">
                <?php
                if (isset($_SESSION['user_name'])) {
                    echo "<span class='username'>" . htmlspecialchars($_SESSION['user_name']) . "</span>";
                } else {
                    echo "<span class='username'>Invitado</span>";
                }
                ?>
            </div>
            <?php if($_SESSION['login']): ?>
            <div class="add-post-button">
                <button onclick="add_idea()" class="btn">Agregar una idea</button>
            </div>
            <?php endif; ?>
        </div>
    <?php

    include '../../config/db_connection.php';

    $sql = "SELECT posts.*, users.username FROM posts INNER JOIN users ON posts.user_id = users.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

            echo "<div class='post'>";
                echo "<h2>" . $row["title"] . "</h2>";
                echo "<p>" . $row["content"] . "</p>";
                echo "<p><small>Posteado por " . $row["username"] . " el " . $row["created_at"] . "</small></p>";

                $post_id = $row["id"];
                $comment_sql = "SELECT comments.*, users.username AS commenter_username 
                                FROM comments 
                                INNER JOIN users ON comments.user_id = users.id 
                                WHERE comments.post_id = $post_id";
                $comment_result = $conn->query($comment_sql);

                if ($comment_result->num_rows > 0) {
                    echo "<div class='comments-container'>";
                        echo "<div class='comments-buttons'>";
                            echo "<button class='toggle-comments-btn' onclick='toggleComments(this)'>Ver comentarios</button>";
                            if ($_SESSION['login']) {
                                echo "<button class='add-comment-btn' onclick='addComment($post_id)'>Comentar</button>";
                            }              
                        echo "</div>";
                        echo "<div class='comments' style='display: none;'>";
                            echo "<h3>Comentarios:</h3>";
                            while ($comment = $comment_result->fetch_assoc()) {
                                echo "<div class='comment'>";
                                    echo "<p><strong>" . htmlspecialchars($comment["commenter_username"]) . ":</strong> " . htmlspecialchars($comment["content"]) . "</p>";
                                    echo "<p><small>Posteado el " . $comment["created_at"] . "</small></p>";
                                echo "</div>";
                            }
                        echo "</div>";
                    echo "</div>";
                } 
                else {
                    echo "<div class='comments-container'>";
                        echo "<div class='comments-buttons'>";
                            echo "<button class='toggle-comments-btn' onclick='toggleComments(this)'>Ver comentarios</button>";
                            if ($_SESSION['login']) {
                                echo "<button class='add-comment-btn' onclick='addComment($post_id)'>Comentar</button>";
                            }
                        echo "</div>";

                        echo "<p>Sin comentarios.</p>";

                    echo "</div>";
                }

            echo "</div>";
        }
    } else {
        echo "No posts found.";
    }
    $conn->close();
    ?>

    </div>

    <script>
        function add_idea() {
            const id = <?php echo $_SESSION['user_id']; ?>;
            const title = prompt("Ingrese el título de la idea:");
            const content = prompt("Ingrese el contenido de la idea:");

            if (title && content) {
                fetch('../../processes/process_add_idea.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id, title, content })
                })
                .then(response => {
                    if (response.ok) {
                        alert("Idea agregada exitosamente.");
                        location.reload();
                    } else {
                        alert("Error al agregar la idea.");
                    }
                })    
            }
        }

        function toggleComments(button) {
            const commentsDiv = button.parentElement.nextElementSibling;
            if (commentsDiv.style.display === 'none') {
                commentsDiv.style.display = 'block';
                button.textContent = 'Ocultar comentarios';
            } else {
                commentsDiv.style.display = 'none';
                button.textContent = 'Ver comentarios';
            }
        }

        function addComment(postId) {
            const userId = <?php echo $_SESSION['user_id']; ?>;
            const comment = prompt("Ingrese su comentario:");

            if (comment) {
                fetch('../../processes/process_add_comment.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ userId, postId, comment })
                })
                .then(response => {
                    if (response.ok) {
                        alert("Comentario agregado exitosamente.");
                        location.reload();
                    } else {
                        alert("Error al agregar el comentario.");
                    }
                });
            }
        }
    </script>
    <script src="/public/js/scripts.js"></script>
</body>
</html>
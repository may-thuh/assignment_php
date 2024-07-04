<?php
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Collection</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
            max-width: 500px;
        }
        .modal-footer {
            display: flex;
            justify-content: space-between;
        }
        .navbar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-book"></i> Book Collection</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add.php"><i class="fas fa-plus"></i> Add New Book</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <h2>Book Collection</h2>
        <a href="add.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Add New Book</a>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Publication Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM books";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row["id"]. "</td>
                            <td>" . $row["title"]. "</td>
                            <td>" . $row["author"]. "</td>
                            <td>" . $row["genre"]. "</td>
                            <td>" . $row["publication_year"]. "</td>
                            <td>
                                <a href='update.php?id=" . $row["id"]. "' class='btn btn-warning'><i class='fas fa-edit'></i> Edit</a>
                                <button class='btn btn-danger' onclick='showModal(" . $row["id"]. ")'><i class='fas fa-trash'></i> Delete</button>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No books found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <h4>Are you sure you want to delete this book?</h4>
            <div class="modal-footer">
                <button id="modalYes" class="btn btn-danger">Yes</button>
                <button id="modalNo" class="btn btn-secondary">No</button>
            </div>
        </div>
    </div>

    <script>
        let deleteId;

        function showModal(id) {
            deleteId = id;
            document.getElementById('myModal').style.display = "block";
        }

        document.getElementById('modalYes').onclick = function() {
            window.location.href = 'delete.php?id=' + deleteId;
        }

        document.getElementById('modalNo').onclick = function() {
            document.getElementById('myModal').style.display = "none";
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

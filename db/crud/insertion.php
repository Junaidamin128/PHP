<?php

require "connection.php";


$msgs = [
    'success' => [],
    'danger' => [],
    'warning' => [],
];

function renderMsgs($msgs)
{
    foreach ($msgs as $type => $msgs2) {
        if (count($msgs2)) {

            echo "<div class='alert alert-$type'>";
            foreach ($msgs2 as $msg) {
                echo "<p>" . $msg . "</p>";
            }
            echo "</div>";
        }
    }
}

if (isset($_POST["form"])) {
    $form = $_POST['form'];
    switch ($form) {
        case "file":
            $name = $_POST['name'];
            $folderId = $_POST['folder'];
            $query = $conn->query("INSERT INTO file(name,fid) VALUES ('$name',$folderId)");
            if ($query) {
                $msgs['success'][] = "Insertion success";
            } else {
                $msgs['danger'][] = "Insertion failed";
            }
            break;
        case "folder":
            $name = $_POST['name'];
            $query = $conn->query("INSERT INTO folder(name) VALUES ('$name')");
            if ($query) {
                $msgs['success'][] = "Insertion success";
            } else {
                $msgs['danger'][] = "Insertion failed";
            }
            break;
    }
}



$query = $conn->query("select * from file;");
$files = $query->fetch_all(MYSQLI_ASSOC);

$_folders = $conn->query("select * from folder;")->fetch_all(MYSQLI_ASSOC);

$folders = [];

foreach ($_folders as $folder) {
    $folders[$folder['folderID']] = $folder;
}


?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div><?= renderMsgs($msgs); ?>
        <form method="POST">
            <h1>Folder</h1>
            <input type="hidden" name="form" value="folder" />
            <label>Name
                <input require name="name" />
            </label>
            <button>Submit</button>
        </form>
        <form method="POST">
            <h1>File</h1>
            <input type="hidden" name="form" value="file" />
            <label>
                Name:
                <input name="name" />
            </label>
            <label> Folder
                <select name="folder">
                    <option value="">--Select--</option>
                    <?php foreach ($folders as $id => $folder) { ?>
                        <option value="<?= $id ?>"><?= $folder['name'] ?></option>
                    <?php } ?>
                </select>

            </label>
            <button>Submit</button>
        </form>

        <div class="row">
            <div class="col-md-6">
                <table class="table table-full" border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>name</th>
                            <th>FID</th>
                            <th>Folder</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($files as $row) {
                        ?>
                            <tr>
                                <td><?= $row['fileID'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['fid'] ?></td>
                                <td><?php
                                    $fid = $row['fid'];
                                    if (isset($folders[$fid])) {
                                        echo $folders[$fid]['name'];
                                    } else {
                                        echo "NULL";
                                    }
                                    ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-full" border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($folders as $folder) {
                            echo "
            <tr>
                <td>$folder[folderID]</td>
                <td>$folder[name]</td>
            </tr>
            ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
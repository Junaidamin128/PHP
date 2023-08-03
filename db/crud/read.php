<?php

require "connection.php";

$query = $conn->query("select * from file;");
$files = $query->fetch_all(MYSQLI_ASSOC);

$_folders = $conn->query("select * from folder;")->fetch_all(MYSQLI_ASSOC);

$folders = [];

foreach ($_folders as $folder) {
    $folders[$folder['folderID']] = $folder;
}


s($_folders);
s($folders);
exit;

?>
<table border="1">
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
                    if( isset($folders[$fid]) )
                    {
                        echo $folders[$fid]['name'];
                    }else{
                        echo "NULL";
                    }
                    ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<table border="1">
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
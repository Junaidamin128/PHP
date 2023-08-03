<?php

$citites = [
    ["name" => "Apple", "loc" => 1],
    ["name" => "Apple2", "loc" => 2],
    ["name" => "Apple3", "loc" => 3],
];


?>
<table border="1">
    <thead>
        <tr>
            <th>Name</th>
            <th>Loc</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($citites as $city) {
        ?>
            <tr>
                <td><?= $city['name'];?></td>
                <td><?= $city['loc'];?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
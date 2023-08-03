<?php if ($title) : ?>
    <h1><?= $title; ?></h1>
<?php else : ?>
    <h1>BYE</h1>
<?php endif; ?>

<oL>
    <?php foreach ($data as $d) : ?>
        <li><?= $d; ?></li>
    <?php endforeach; ?>
</ol>

<uL>
    <?php for ($i = 0; $i < 10; $i++) : ?>
        <li><?= $i; ?></li>
    <?php endfor; ?>
</ul>
<?php
require_once "conn.php";
include "./Components/header.php";
include "./Components/navbar.php";
$allnews = getnews();

$catsql = $conn->prepare("SELECT * FROM `category`");
$catsql->execute();
$categories = $catsql->fetchAll(PDO::FETCH_ASSOC);
foreach($categories as $k=>$cat){
    // if($cat['name']=='cricket'){
        $cid = $cat['cid'];
        $categories[$k]['news'] = News::getsportsnews($cid);
}
d($categories);

?>
<section class="news">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-12 border-right">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="news row">
                            <div class="title">
                                <h4><?= $allnews[0]['title'] ?></h4>
                            </div>
                            <div class="img">
                                <img src="<?= $allnews[0]['image'] ?>" alt="">
                            </div>
                            <div class="detail">
                                <p><?= $allnews[0]['body'] ?></p>
                                <div class="author-detail">
                                    <?php $author = getauthors($allnews[0]['author']); ?>
                                    <p><?= $author[0]['name'] ?></p>
                                </div>
                            </div>
                        </div>
                        <h4>RELATED</h4>
                        <?php foreach ($allnews as $new) : ?>
                            <div class="featured-row d-flex">
                                <div class="img">
                                    <img class="m-2" width="150px" src="./images/<?= $new['image'] ?>" alt="">
                                </div>
                                <div class="detail">
                                    <h4><?= $new['title'] ?></h4>
                                    <p>Updated <?= $new['created'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <?php foreach ($allnews as $new) : ?>
                            <div class="news border-bottom p-2 d-flex">
                                <div class="img">
                                    <img width="80%" src="./images/<?= $new['image'] ?>" alt="">
                                </div>
                                <div class="title"><?= $new['title'] ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <?php foreach ($allnews as $new) : ?>
                            <div class="new">
                                <div class="img">
                                    <img width="100%" src="./images/<?= $new['image'] ?>" alt="">
                                </div>
                                <div class="detail">
                                    <h4><?= $new['title'] ?></h4>
                                    <p>Updated <?= $new['created'] ?></p>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="head d-flex justify-content-between border-bottom">
                            <h3>Buisness</h3>
                            <h3>More For Buisness</h3>
                        </div>
                      
                        <div class="new">
                            <div class="img">
                                <img src="" alt="">
                            </div>
                            <div class="content">
                                <h3>Title</h3>
                                <p>updated</p>
                                <p>body</p>
                            </div>
                        </div>
                        <div class="news row">
                            <div class="col-md-6 col-sm-12">
                                <div class="img">
                                    <img src="" alt="">
                                </div>
                                <div class="content">
                                    <h3>Title</h3>
                                    <p>updated</p>
                                    <p>body</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="img">
                                    <img src="" alt="">
                                </div>
                                <div class="content">
                                    <h3>Title</h3>
                                    <p>updated</p>
                                    <p>body</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="wrapper">
                    <div class="card p-2" style="background: url(./images/632aa7df95883hand-painted-watercolor-pastel-sky-background_23-2148902771.jpg);
                    height: 135px !important;">
                        <h3><?= $allnews[0]['title'] ?></h3>
                    </div>
                </div>
                <div class="mostread">
                    <h3>Most Read</h3>
                    <ul class="d-flex p-0 text-center">
                        <li class="list-unstyled mx-2">24 Hours</li>
                        <li class="list-unstyled mx-2">3 Days</li>
                        <li class="list-unstyled mx-2">Commented</li>
                    </ul>
                    <div class="new">
                        <div class="img">
                            <img class="w-100" src="./images/<?= $allnews[2]['image'] ?>" alt="">
                        </div>
                        <div class="title">
                            <h3><?= $allnews[2]['title'] ?></h3>
                        </div>
                    </div>
                    <div class="news">
                        <?php foreach ($allnews as $new) : ?>
                            <div class="card">
                                <div class="row">
                                    <div class="img col-4">
                                        <img class="w-100" src="./images/<?= $new['image'] ?>" alt="">
                                    </div>
                                    <div class="content col-8">
                                        <h4><?= $new['title'] ?></h4>
                                        <p>updated <?= $new['created'] ?></p>
                                        <p><?= $new['body'] ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="cricket">
                    <h3>Cricket Pakistan</h3>
                    <ul class="d-flex p-0 text-center">
                        <li class="list-unstyled mx-2">Videos</li>
                        <li class="list-unstyled mx-2">News</li>
                    </ul>
                    <?php foreach ($allnews as $new) : ?>
                        <div class="card">
                            <div class="row">
                                <div class="img col-4">
                                    <img class="w-100" src="./images/<?= $new['image'] ?>" alt="">
                                </div>
                                <div class="content col-8">
                                    <h4><?= $new['title'] ?></h4>
                                    <p>updated <?= $new['created'] ?></p>
                                    <p><?= $new['body'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="news"></div>
                </div>
                <div class="blogs">
                    <h3>Recent Blog</h3>
                    <div class="news">
                        <?php foreach ($allnews as $new) : ?>
                            <div class="card">
                                <div class="row">
                                    <div class="img col-4">
                                        <img class="w-100" src="./images/<?= $new['image'] ?>" alt="">
                                    </div>
                                    <div class="content col-8">
                                        <h4><?= $new['title'] ?></h4>
                                        <p>updated <?= $new['created'] ?></p>
                                        <p><?= $new['body'] ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "./Components/footer.php";
?>
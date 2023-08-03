<?php
session_start();

define('BASE_URL', "http://localhost/social");
$conn = mysqli_connect("localhost", "root", "", "social");
if (mysqli_errno($conn)) {
    echo "Connection failed:" . mysqli_error($conn);
    exit;
}


$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
$current_user = null;
if ($uid) {
    $query = $conn->query("SELECT * FROM user WHERE uid='$uid'");
    $current_user = mysqli_fetch_assoc($query);
}


function url($url)
{
    return BASE_URL . "/$url";
}


function renderFriendStatutsButtons($user)
{
    global $conn;
    global $current_user;
    $friendSql = "SELECT * FROM `friends` WHERE (sender = $current_user[uid] AND reciever = $user[uid]) OR (sender = $user[uid] AND reciever = $current_user[uid])";
    $friendDataQuery = $conn->query($friendSql);

    $friendData = $friendDataQuery->fetch_assoc();
    $output = "";
    if (!$friendData) {
        $output  = "<button class='send-request' data-uid='$user[uid]'>Send Request</button>";
    } else {
        $isSender = $current_user['uid'] == $friendData['sender'] ? true : false;
        if ($isSender) {
            $output  = "<button class='cancel-request' data-uid='$user[uid]'>Cancel Request</button>";
        } else {
            $output  = "<button class='accept-request' data-uid='$user[uid]'>Accept</button>
            <button class='cancel-request' data-uid='$user[uid]'>Cancel Request</button>
            ";
        }
    }

    return $output;
}
function render_post($results)
{
?>
    <div data-pid="<?= $results["pid"]?>" class="post container border m-2">
        <div class="head"><img src="" alt="">
            <h3><?= $results['user']['fullname'] ?></h3>
        </div>
        <div class="picture row">
            <?php foreach ($results['images'] as $image) : ?>
                <a class="modal-image" href="<?= BASE_URL . "/images/$image[imgname]" ?>">
                    <img class="w-50 p-2 col-6" src="<?= getPostSmallImage($image['imgname']); ?>" alt="">
                </a>
            <?php endforeach; ?>
        </div>
        <p><?= $results['body'] ?></p>


        <h4>Comments</h4>
        <form class="comment-form" method="post">
            <div class="comment">
                <input hidden type="text" value="<?= $results['pid'] ?>" name="pid" />
                <input required type="text" name="comment" id="comment" placeholder="Enter Your Comment"><input type="submit" value="post" name="submit">
            </div>
        </form>
        <div class="comments">
            <?php //render_comments($results['pid']); ?>
        </div>
    </div>
<?php
}


function render_comments($pid)
{
    global $conn;
    $comments = mysqli_query($conn, "SELECT * FROM `comment` WHERE pid = $pid ORDER BY cid DESC");
    $comments = $comments->fetch_all(MYSQLI_ASSOC);
?>
    <?php foreach ($comments as $comment) : ?>
        <?= render_comment($comment);?>
    <?php endforeach; ?>
<?php
}

function render_comment($comment)
{
    $user = getUser($comment['uid']);
    return "
    <div>
    <h5>$user[fullname]</h5>
    <p class='pl-5'>$comment[body]</p>
    </div>";
}


function getPostImages($pid)
{
    global $conn;
    $query = $conn->query("SELECT * FROM postimages WHERE pid='$pid'");
    $results = $query->fetch_all(MYSQLI_ASSOC);
    return $results;
}

function getUser($uid)
{
    global $conn;
    $query = $conn->query("SELECT * FROM user WHERE uid='$uid'");
    $results = $query->fetch_assoc();
    return $results;
}
function get_post($pid){
    global $conn;
    $query  = mysqli_query($conn,"SELECT * FROM `posts` WHERE `pid` = $pid");
    $results = $query->fetch_all(MYSQLI_ASSOC);
    $results[0]['images'] = getPostImages($pid);
    $results[0]['user'] = getUser($results[0]['author']);   
        return $results;

}
function get_posts($get = "all", $uid = null)
{
    global $conn;
    $limit = 5;
    if ($get == "all") {
        $query = mysqli_query($conn, "SELECT * FROM `posts` LIMIT $limit");
    } else {
        if (!$uid) {
            throw new Error("get_posts uid missing.");
        }
        $query = mysqli_query($conn, "SELECT * FROM `posts` WHERE author='$uid'");
    }
    $results = $query->fetch_all(MYSQLI_ASSOC);
    foreach ($results as $rid => $result) {
        $results[$rid]['images'] = getPostImages($result['pid']);
        $results[$rid]['user'] = getUser($result['author']);
    }
    return $results;
}


function getPostSmallImage($image)
{
    $name = pathinfo($image, PATHINFO_FILENAME);
    $ext = pathinfo($image, PATHINFO_EXTENSION);

    $filename = $name . "-post-small." . $ext;
    if (!file_exists("./thumbnail/$filename")) {
        $im_php = imagecreatefromjpeg("./images/$image");
        $im_php = imagescale($im_php, 420);
        imagejpeg($im_php, "./thumbnail/$filename");
    }
    return "./thumbnail/$filename";
}


function render_msg(){
    echo "helo";
}
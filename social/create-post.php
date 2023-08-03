<?php
require_once "conn.php";

include "./Components/header.php"
?>
<div class=" container m-auto text-center">
    <form id="create-post" method="POST" class="d-flex flex-column p-5 w-50 m-auto login_form jumbotron" enctype="multipart/form-data">
        <label class="w-100 " for="title">Upload:
            <input id="file" multiple class="w-100 p-2 rounded post-image" type="file" name="img">
        </label>
        <div class="display-img"></div>
        <label class="w-100 " for="body">Body:
            <textarea id="body" class="w-100 p-2 rounded" type="text" name="body" placeholder="body"></textarea>
        </label>
        <input type="submit" value="Save" />
    </form>
</div>

<?php
include "./Components/footer.php";
?>
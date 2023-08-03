// $(".send-request").on("click", function (){});

$(document.body).on("click", ".modal-image", function (evt) {
    evt.preventDefault();
    let src = this.href;
    let $modal = $("#post-modal");
    $modal.find(".modal-body").html("");
    $modal.find(".modal-body").append($(`<img width="100%" src="${src}" />`));
    //open modal
    $modal.modal();
});

$(document.body).on("click", ".profile-img", function (evt) {
    evt.preventDefault();
    let $modal = $("#profile-modal");
    $modal.modal();
});

$(document.body).on("click", ".send-request", function () {
    let $this = $(this);
    let $container = $this.closest(".friend-status");
    $this.attr("disabled", true);
    let uid = $this.attr("data-uid");

    $.ajax({
        url: BASE_URL + "/api/send-request.php",
        type: "POST",
        data: { uid: uid, op: "SEND-REQUEST" },
        success: function (data) {
            data = JSON.parse(data);
            if (data.success) {
                $container.html(data.msg);
            } else {
                alert(data.msg);
                $this.prop("disabled", false);
            }
        },
        error: function (e) {
            $this.prop("disabled", false);
        }
    });

});

$(document.body).on("click", ".cancel-request", function () {
    let $this = $(this);
    let $container = $this.closest(".friend-status");
    $this.attr("disabled", true);
    let uid = $this.attr("data-uid");

    $.ajax({
        url: BASE_URL + "/api/send-request.php",
        type: "POST",
        data: { uid: uid, op: "CANCEL-REQUEST" },
        success: function (data) {
            data = JSON.parse(data);
            if (data.success) {
                $container.html(data.msg);
            } else {
                alert(data.msg);
                $this.prop("disabled", false);
            }
        },
        error: function (e) {
            $this.prop("disabled", false);
        }
    });

});
$(".load").on("click", function () {
    console.log("HELLO");
});

$(document.body).on("click", ".msg-submit", function (evt) {
    evt.preventDefault();
    let $msg = $("#msg");
    let msg = $msg.val();
    let $rid = $("#rid");
    let rid = $rid.val();
    let $sid = $("#sid");
    let sid = $sid.val();
    let $msgElement = $(`<div class="msg msg-send">
                <div class="msg-content">${msg}</div>
                <div class="msg-status"></div>
        </div>`);
    $(".chat-container").append($msgElement);
    $.ajax({
        url: BASE_URL + "/api/msg.php",
        type: "POST",
        data: { msg, rid, sid },
        success: function (data) {
            data = JSON.parse(data);
            if (data.success) {
                $msgElement.find(".msg-status").addClass("sent");
            }
        },
        error: function () {
            $(".chat-container").html(data['msg']);
        }
    })
})


$(".post-image").on("change", function () {
    $(".display-img").html("");
    for (let i = 0; i < this.files.length; i++) {
        let file = this.files[i];
        let fr = new FileReader();
        fr.readAsDataURL(file);
        fr.onload = function (e) {
            let img = document.createElement("img");
            img.className = "w-25";
            img.src = this.result;
            $(".display-img").append(img);
        }
    }
});


$("#create-post").on('submit', function (evt) {
    evt.preventDefault();
    let $body = $("#body");
    let body = $body.val();
    let $file = jQuery("#file");
    let files = $file[0].files;

    let fd = new FormData();
    fd.append("body", body);
    for (let i = 0; i < files.length; i++) {
        fd.append("files[]", files[i]);
    }

    $.ajax({
        url: BASE_URL + "/api/create-post.php",
        type: "POST",
        data: fd,
        contentType: false,
        processData: false,
        success: function (data) {
            data = JSON.parse(data);
            if (data.success) {
                window.location.href = BASE_URL + "/post.php?pid=" + data.pid;
            } else {
                alert(data.msg);
                $this.prop("disabled", false);
            }
        },
        error: function (e) {
            $this.prop("disabled", false);
        }
    });
});


$(".comment-form").on("submit", function (evt) {
    evt.preventDefault();
    let $this = $(this);
    let $pid = $this.find("[name='pid']");
    let $comment = $this.find("[name='comment']");
    let pid = $pid.val();
    let comment = $comment.val();
    console.log(pid, comment);
    $.ajax({
        url: BASE_URL + "/api/add-comment.php",
        type: "POST",
        data: { pid, comment },
        success: function (data) {
            data = JSON.parse(data);
            if (data.success) {
                $this.closest(".post").find(".comments").prepend($(`<p>${comment}</p>`));
            } else {
                alert(data.msg);
            }
        },
        error: function (e) {
            alert(data.msg);

        }
    })
});


updatePostComments();
setInterval(updatePostComments, 5000);
function updatePostComments() {
    let $posts = $(".post");
    if ($posts.length == 0) {
        return;
    }
    let pids = [];
    for (let i = 0; i < $posts.length; i++) {
        let $post = $posts.eq(i);
        pids.push($post.attr("data-pid"));
    }

    $.ajax({
        url: BASE_URL + "/api/getComments.php",
        type: "POST",
        data: { pids },
        success: function (data) {
            data = JSON.parse(data);
            for (let pid in data['post_comments']) {
                let commentData = data['post_comments'][pid];
                // console.log(pid, commentData);
                let $post = $("[data-pid='" + pid + "']");
                $post.find(".comments").html(commentData);
            }
        },
        error: function () {

        }
    });

}


let $chatContainer = $(".chat-container");
let scrolled = false;
if ($chatContainer.length) {
    let id = $chatContainer.attr("data-id");
    setInterval(() => {
        $.ajax({
            url: BASE_URL + "/api/getMessages.php",
            data: { id },
            type: "POST",
            success: function (data) {
                data = JSON.parse(data);
                if (data.success) {
                    $chatContainer.html("");
                    for (let msg of data['msgs']) {
                        let isOther = msg.sid == id;
                        let $msg = null;
                        if (isOther) {
                            $msg = $(`<div class="msg">
                            <div class="msg-content">${msg.msg}</div>
                        </div>`);
                        } else {
                            $msg = $(`<div class="msg msg-send">
                            <div class="msg-content">${msg.msg}</div>
                            <div class="msg-status sent"></div>
                        </div>`);
                        }
                        $chatContainer.prepend($msg);
                    }
                    if (!scrolled) {
                        scrolled = true;
                        $chatContainer[0].scrollTop = $chatContainer[0].scrollHeight;
                    }
                }
            }
        })
    }, 1000);
}
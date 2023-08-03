<div class="row">
    <div class="col-6 offset-3">
        <form method="post">
            <div class="row">
                <div class="col">
                    <input type="text"  name="name" class="form-control m-2 " placeholder="Full Name">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="email" id="register-email" name="email" class="form-control m-2 " placeholder="Email">
                    <div id="register-email-status"></div>
                </div>
                <div class="col">
                    <input type="text" name="username" class="form-control m-2 " placeholder="Username">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="password" name="password" class="form-control m-2 " placeholder="Password">
                </div>
                <div class="col">
                    <input type="password" name="conpass" class="form-control m-2 " placeholder="Confirm Password">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="number" name="number" class="form-control m-2 " placeholder="Phone Number">
                </div>
            </div>
            <button class="btn btn-primary my-2 my-sm-0 col-12 m-2  " name="signup" type="submit">Sign up</button>
        </form>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(){
        let $status = $("#register-email-status");
        $("#register-email").on('change', function(){
            $status.html("");
            $.ajax({
                url: BASE_URL+"/api/check.php",
                type: "POST",
                data: {email: this.value, op:"EMAIL"},
                success: function(data){
                    data = JSON.parse(data);
                    if(data.exists)
                    {
                        $status.html("Email already taken");
                    }
                }
            });
        });
    });
</script>
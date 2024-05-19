<link rel="stylesheet" href="/css/postForm.css">

<script>
        $(document).ready(function(){
            $('#postMedia').change(function(){
                $("#postMediaPreview").html('');
                $("#postMediaPreview").addClass('post-media-container')
                var extension = $('#postMedia').val().replace(/^.*\./, '');

                for (var i = 0; i < $(this)[0].files.length; i++) { 
                    if(extension == "mp4" || extension == "ogg"){
                        $("#postMediaPreview").append('<video src="'+window.URL.createObjectURL(this.files[i])+'" controls />');
                    } else {
                        $("#postMediaPreview").append('<img src="'+window.URL.createObjectURL(this.files[i])+'"/>');
                    }
                }
            });
        });
</script>

<form class="post-form" action="/action/postAction.php" method="post" enctype="multipart/form-data">
    <div class="user-container">
        <img src=<?php echo "../user/".$_SESSION["user_id"]."/profileImage.png?a=".$time ?> alt="Profile Image">   
        <a href="/page/profile.php?user_id=<?php echo $_SESSION["user_id"]?>"><?php echo $user[0]["username"] ?></a>
    </div>    
    <div class="textbox-container">
        <textarea name="postText" id="postText" rows="1" placeholder="Tell us what you think..."></textarea>
    </div>

    <div class="" id="postMediaPreview">
    </div>

    <div class="button-container">
        <label for="postMedia">
            <svg  width="24" height="24"><path d="M20 2H8c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zM8 16V4h12l.002 12H8z"></path><path d="M4 8H2v12c0 1.103.897 2 2 2h12v-2H4V8z"></path><path d="m12 12-1-1-2 3h10l-4-6z"></path></svg>
        </label>

        <input type="file" name="postMedia" id="postMedia" accept=".jpg , .jpeg, .jfif, .pjpeg, .pjp, .png, .gif, .webp, .mp4, .webp, .ogg">
        <input type="submit" name="post" value="Post">
    </div>

    <script>
        const textArea = document.getElementsByTagName("textarea");

        for (let i = 0; i < textArea.length; i++){
            textArea[i].setAttribute("style", "height:" + (textArea[i].scrollHeight) + "px;");
            textArea[i].addEventListener("input", OnInput, false);
        }

        function OnInput() {
            this.style.height = "auto";
            this.style.height = (this.scrollHeight) + "px";
        }
    </script>
</form>
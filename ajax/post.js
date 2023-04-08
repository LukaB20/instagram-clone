const createPost = () => {
    $.ajax({
        url: "php/createPost.php",
        type: "POST",
        data: {
            postId: $("#postId").val().trim(),
            commentText: $("#commentText").val().trim(),
        },
        success: (response) => {
            console.log(response);
            let user = JSON.parse(response);
            $(".comments").append(`
                <div class="comment">
                    <div class="user-comment-image" style='background-image: url(${user['image']})'></div>
                        <div class="name-comment">
                            <a href="profile.php?id=${user['user_id']}" class="comment-name">${user['firstname']} ${user['lastname']}</a>
                            <p class="comment-text">${$("#commentText").val().trim()}</p>
                        </div>
                </div>
            `);
            document.getElementById("commentText").value = "";
        },
        error: (xhr) => {
            console.log(xhr);
        }
    });
}

const likePost = (id) =>{
    $.ajax({
        url: "php/likePost.php",
        type: "GET",
        data: {postId: id},
        success: (response) => {
            if(response == "success"){
                document.querySelector("#like-btn").style.display = "none";
                document.querySelector("#dislike-btn").style.display = "block";
            }
        },
        error: (xhr) => {
            console.log(xhr);
        }
    });
}

const dislikePost = (id) => {
    $.ajax({
        url: "php/unlikePost.php",
        type: "GET",
        data: {postId: id},
        success: (response) => {
            if(response == "success"){
                document.querySelector("#like-btn").style.display = "block";
                document.querySelector("#dislike-btn").style.display = "none";
            }
        },
        error: (xhr) => {
            console.log(xhr);
        }
    });
}
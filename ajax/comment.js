const createPost = () => {
    $.ajax({
        url: "php/createPost.php",
        type: "POST",
        data: {
            postId: $("#postId").val().trim(),
            commentText: $("#commentText").val().trim(),
        },
        success: (response) => {
            document.getElementById("postId").innerText = "";
            $(".comments").append(`
                <div class="comment">
                    <div class="user-comment-image"></div>
                        <div class="name-comment">
                            <a href="#" class="comment-name">Marko Markovic</a>
                            <p class="comment-text">${$("#commentText").val().trim()}</p>
                        </div>
                </div>
            `);
        },
        error: (xhr) => {
            console.log(xhr);
        }
    });
}
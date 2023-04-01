const followUser = (id) => {

    $.ajax({
        url: "php/followUser.php",
        type: "GET",
        data: {friendId: id},
        success: (response) => {
            console.log(response);
        },
        error: (xhr) => {
            console.log('ERROR');
        }
    });

    const unFollowUserBtn = document.querySelector("#unfollow-user");
    const followUserBtn = document.querySelector("#follow-user");
    console.log(unFollowUserBtn)
    unFollowUserBtn.style.display = "block";
    followUserBtn.style.display = "none";
}

const unfollowUser = (id) => {

    $.ajax({
        url: "php/unfollowUser.php",
        type: "GET",
        data: {friendId: id},
        success: (response) => {
            console.log(response);
        },
        error: (xhr) => {
            console.log('ERROR');
        }
    });

    const unFollowUserBtn = document.querySelector("#unfollow-user");
    const followUserBtn = document.querySelector("#follow-user");
    unFollowUserBtn.style.display = "none";
    followUserBtn.style.display = "block";

}


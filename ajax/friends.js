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

    const unFollowUserBtn = document.querySelector(".unfollow");
    const followUserBtn = document.querySelector(".follow");
    unFollowUserBtn.style.display = "block";
    followUserBtn.style.display = "none";
}

function unFollowUser(id) {

    $.ajax({
        url: "php/unfollowUser.php",
        type: "GET",
        data: { friendId: id },
        success: (response) => {
            console.log(response);
        },
        error: (xhr) => {
            console.log('ERROR');
        }
    });

    const unFollowUserBtn = document.querySelector(".unfollow");
    const followUserBtn = document.querySelector(".follow");
    unFollowUserBtn.style.display = "none";
    followUserBtn.style.display = "block";

}


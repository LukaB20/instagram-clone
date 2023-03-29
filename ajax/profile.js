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

}


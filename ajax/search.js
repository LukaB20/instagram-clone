$(document).ready(() => {
   
    $('#searchText').keyup(() => {
        let searchText = $('#searchText').val().trim();
        $.ajax({
            url: "php/search.php",
            type: "GET",
            data: {searchTxt: searchText},
            success: (response) => {
                $('.suggested-friends').html("");
                let data = JSON.parse(response);
                for(let i = 0; i < data.length; i++){
                    $('.suggested-friends').append(`
                        <div class="suggested-friend">
                            <div class="user-info">
                                <div class="user-image" style="background-image: url(${data[i].image});"></div>
                                    <a href="profile.php?id=${data[i].user_id}" class="user-name">${data[i].firstname + " " + data[i].lastname}</a>
                                </div>
                            <button class="follow" onclick="followFriend(this ,${data[i].user_id})">Follow</button>
                        </div>
                    `);
                }
            },
            error: (xhr) => {
                console.log("Failed to get data from search.");
            }
        });
    });
    
});

const followFriend = (e, id) => {
    $.ajax({
        url: "php/followUser.php",
        type: "GET",
        data: {friendId: id},
        success: (response) => {
            if(response){
                e.target.value = '<i class="fa-solid fa-check"></i> Following';
            }
        },
        error: () => {
            console.log("Failed to follow user.");
        }
    })
}
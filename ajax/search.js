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

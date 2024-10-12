$(function() {
    $("#mainArea").load("users.html"); //set standart page
    console.log($('#update'));
    updateUserTable();
    
    $('#menu li').each(function(index) {
        $(this).on('click', function() {       
            $("#mainArea").load($(this).attr('href'))
        });
    });

    //user page
    $(document).on('click', '#openUserModal', function() {       
        $("#userModal").removeClass("hidden");
        $("#firstInput").trigger( "focus" );
        $(".closeUserModal").on("click", function() {
            $("#userModal").addClass("hidden");
       })
    });

    function updateUserTable() {
        let request = $.ajax({
            url: "http://localhost/GitTeam/server/api/users/GetAllUsers.php",
            method: "GET",
        })
        request.done(function(data) {
            console.log(data);
            let table = `
            <table> 
                <tr>
                    <th>id</th>
                    <th>Имя</th>
                    <th>Nickname</th>
                    <th>Почта</th>
                    <th>Изменить</th>
                    <th class="text-red-600">Удалить</th>
                </tr>`
            for (let i = 0; i < data.length; i++) {
                table = table + 
                `<tr>
                    <td>${data[i]["user_id"]}</td>
                    <td>${data[i]["name"]}</td>
                    <td>${data[i]["nickname"]}</td>
                    <td>${data[i]["email"]}</td>
                    <td>#</td>
                    <td class='text-red-600'>x</td>
                </tr>`
            }
            table = table + "</table>";
            $("#userTable").append(table);
        });
        request.fail(function(data, status, error) {
            $("#userTable").append(error);
        });  
    }
})

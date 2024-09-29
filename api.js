#!/usr/bin/env node
var args = process.argv.slice(2) ;

  var data = {
    nickname: args[0],
    email: args[1],
    project_url: args[2],
    branch_name: args[3],
};

fetch("http://localhost/GitTeam/server/api/restrictions/isRestrictedBranch.php", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify(data)
})
.then(response => {
    if (!response.ok) {
        throw new Error("Сеть отвечает с ошибкой " + response.status);
    }
    return response.json();
})
.then(data => {
    console.log(data);
})
.catch(error => {
    console.error("Ошибка:", error);
});
function joined(id) {
    document.getElementById('join-button-'+id).className = 'btn btn-danger text-white'
    document.getElementById('join-button-'+id).textContent = 'Remove me'
}

function notJoined(id) {
    document.getElementById('join-button-'+id).className = 'btn btn-primary text-white'
    document.getElementById('join-button-'+id).textContent = 'Join Activity'
}

function joinedToActivity(id) {
    var ruta = Routing.generate('joined')
    $.ajax({
        type: 'POST',
        url: ruta,
        data: ({id: id}),
        async: true,
        dataType: "json",
        success: function (data) {
            console.log(data.user.length)
            console.log(data.activity.length)
            if (data.user.length > 0 && data.activity.length > 0)
                joined(id)
            else
                notJoined(id)
        }
    })
}

// window.onload = () => {
//     joinedToActivity(7)
// }

function joinActivity(id) {
    var ruta = Routing.generate('join')
    $.ajax({
        type: 'POST',
        url: ruta,
        data: ({id: id}),
        async: true,
        dataType: "json",
        success: function (data) {
            joined(id)
        }
    })
}
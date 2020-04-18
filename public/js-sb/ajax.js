function joined(id) {
    document.getElementById('join-button-'+id).className = 'btn btn-danger text-white'
    document.getElementById('join-button-'+id).textContent = 'Remove me'
}

function notJoined(id) {
    document.getElementById('join-button-'+id).className = 'btn btn-primary text-white'
    document.getElementById('join-button-'+id).textContent = 'Join Activity'
}

window.onload = () => {
    var cards = document.getElementById('cards').children
    for (let i=0; i < cards.length; i++) {
        var id = cards[i].children[0].children[2].id.slice(12)
        joinedActivity(id)
    }
}

function check(id) {
    button = document.getElementById('join-button-'+id).textContent
    if (button === 'Join Activity') {
        joinActivity(id)
    } else {
        removeFromActivity(id)
    }
}

function joinedActivity(id) {
    var ruta = Routing.generate('joined')
    $.ajax({
        type: 'POST',
        url: ruta,
        data: ({id: id}),
        async: true,
        dataType: "json",
        success: function (data) {
            if (data.user.length > 0 && data.activity.length > 0)
                joined(id)
            else
                notJoined(id)
        }
    })
}

function joinActivity(id) {
    var ruta = Routing.generate('join')
    $.ajax({
        type: 'POST',
        url: ruta,
        data: ({id: id}),
        async: true,
        dataType: "json",
        success: function (data) {
            if (data.user.length > 0 && data.activity.length > 0)
                joined(id)
            else
                notJoined(id)
        }
    })
}

function removeActivity(id) {
    var ruta = Routing.generate('removeActivity')

    $.ajax({
        type: 'POST',
        url: ruta,
        data: ({id: id}),
        async: true,
        dataType: "json",
        success: function (data) {
            console.log(data)
        },
        error: function (json) {
            console.log(json.responseJSON)
        }
    })
}
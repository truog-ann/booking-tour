function convertDateToDateTime(date) {
    let m = new Date(date);
    return ("0" + m.getUTCHours()).slice(-2) + ":" +
        ("0" + m.getUTCMinutes()).slice(-2) + " | " +
        ("0" + m.getUTCDate()).slice(-2) + "/" +
        ("0" + (m.getUTCMonth() + 1)).slice(-2) + "/" +
        m.getUTCFullYear();
}

function renderPagination(links) {
    let last = links.length - 2;
    links.forEach(function (each) {
        let disable = '';
        let link = '';
        if (each.label === "&laquo; Previous") {
            if (links[1].active === true) {
                disable = 'disabled';
            }
            each.label = '‹';
            each.url += '" rel="prev" aria-label="« Previous';
        } else if (each.label === "Next &raquo;") {
            if (links[last].active === true) {
                disable = 'disabled';
            }
            each.label = '›';
            each.url += '" rel="next" aria-label="Next »';
        }
        if (each.active) {
            $('#pagination').append($('<li>').attr('class', `page-item active ${disable}`)
                .attr('aria-current', 'page')
                .append(`<span class="page-link">${each.label}</span>`));
        } else {
            $('#pagination').append($('<li>').attr('class', `page-item ${disable}`)
                .append(`<a class="page-link" href="${each.url}">${each.label}</a>`));
        }
    })
}

function notifySuccess(message = '') {
    $.toast({
        heading: 'Success',
        text: message,
        showHideTransition: 'slide',
        position: 'bottom-right',
        icon: 'success'
    });
}

function notifyError(message = '') {
    $.toast({
        heading: 'Error',
        text: message,
        showHideTransition: 'slide',
        position: 'bottom-right',
        icon: 'error'
    });
}

function notifyInfo(message = '') {
    $.toast({
        heading: 'Info',
        text: message,
        showHideTransition: 'slide',
        position: 'bottom-right',
        icon: 'info'
    });
}

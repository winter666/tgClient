$(document).ready(function () {
    let sendBtn = $('#send-modal');

    $('button[data-target="#modal-window"]').on('click', (e) => {
        sendBtn.attr('disabled', true);
        let modalWId = e.currentTarget.dataset.target; // modal window id
        let action = e.currentTarget.dataset.action; // url
        let modalW = $(modalWId);
        modalW.find('.modal-title').text(e.currentTarget.dataset.title);
        $.ajax({
            method: 'GET',
            url: action,
            beforeSend() {
                modalW.find('.modal-body').text('...');
            },
            success(data) {
                setTimeout(() =>{
                    modalW.find('.modal-body').html(data);
                    sendBtn.on('click', (e) => {
                        let sendBtn = $(e.currentTarget);
                        let form = sendBtn.closest('#modal-window').find('#form');
                        sendBtn.attr('disabled', true);
                        form.submit();
                    });
                    sendBtn.removeAttr('disabled');
                }, 3000);
            },
            error(e) {
                console.error('Form template not found!');
                console.error(e.responseJSON.message);
            }
        });
    });

    $('#modal-window').on('submit', '#form', (e) => {
        let data = {};
        let form = e.currentTarget;
        const url = form.action;
        const method = form.method;
        for (let i = 0; i < form.elements.length; i++) {
            if (form.elements[i]) {
                data[form.elements[i].name] = form.elements[i].value;
            }
        }
        $.ajax({
            url,
            method,
            data,
            dataType: 'json',
            beforeSend() {
                sendBtn.attr('disabled', true);
            },
            success(data) {
                if (data.access_token) {
                    localStorage.setItem('access_token', data.access_token);
                }

                window.location = data.web_hook;
            },
            error(e) {
                if (e.status === 422) {
                    let response = e.responseJSON;
                    for (let name in response.errors) {
                        let errorContainer = $(form).find(`[name="${name}"]`).siblings('.text-danger');
                        errorContainer.text(response.errors[name][0]);
                    }
                }
            },
            complete() {
                sendBtn.removeAttr('disabled');
            }
        });
        return false;
    })
});

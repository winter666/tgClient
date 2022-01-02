    <div class="footer-block">
        <div class="container">
        </div>
    </div>
    <div class="modal fade" id="modal-window" tabindex="-1" role="dialog" aria-labelledby="modal-window-center-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-window-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="send-modal">Send</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
           $('button[data-target="#modal-window"]').on('click', (e) => {
               let sendBtn = $('#send-modal');
               sendBtn.attr('disabled', true);
               let modalWId = e.currentTarget.dataset.target; // modal window id
               let action = e.currentTarget.dataset.action; // url
               let modalW = $(modalWId);
               modalW.find('.modal-title').text(e.currentTarget.dataset.title);
               $.ajax({
                    method: 'GET',
                    url: action,
                    beforeSend() {

                    },
                    success(data) {
                        setTimeout(() =>{
                            modalW.find('.modal-body').html(data);
                            sendBtn.on('click', (e) => {
                                let sendBtn = $(e.currentTarget);
                                let form = sendBtn.closest('#modal-window').find('#form');
                                form.submit();
                            });
                            sendBtn.removeAttr('disabled');
                        }, 3000);
                    },
                    error(e) {
                        console.log(e);
                    },
                    complete() {
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
                    beforeSend() {

                    },
                    success(data) {
                        // TODO: допилить
                        console.log(data);
                    },
                    error(e) {
                        console.log(e);
                    },
                    complete() {

                    }
                });
                return false;
            })
        });
    </script>
</body>
</html>

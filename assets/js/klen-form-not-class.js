document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('klen-ecomail-form');
    const submitButton = form.querySelector('input[type="submit"]');
    const success = document.getElementById('klen_success');
    const error = document.getElementById('klen_error');
    const warning = document.getElementById('klen_warning');

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        submitButton.disabled = true;

        const formData = new FormData(form);
        const url = '/wp-json/klen-ecomail/v1/subscribe';

        fetch(url, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.response.message === "OK") {
                    success.classList.add('open');
                    form.reset();
                } else {
                    warning.classList.add('open');
                    console.error(data.response.message);
                }
                submitButton.disabled = false;
            })
            .catch(error => {
                error.classList.add('open');
                console.error(error.message);
                submitButton.disabled = false;
            });
    });
});
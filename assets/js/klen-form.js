(() => {
    class KlenEcomail {
        constructor() {
            this.form = document.getElementById('klen-ecomail-form');
            this.submitButton = this.form.querySelector('input[type="submit"]');
            this.success = document.getElementById('klen_success');
            this.error = document.getElementById('klen_error');
            this.warning = document.getElementById('klen_warning');

            this.form.addEventListener('submit', this.handleSubmit.bind(this));
        }

        handleSubmit(event) {
            event.preventDefault();
            this.submitButton.disabled = true;

            const formData = new FormData(this.form);
            const url = '/wp-json/klen-ecomail/v1/subscribe';

            fetch(url, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.response.message === 'OK') {
                        this.success.classList.add('open');
                        this.form.reset();
                    } else {
                        this.warning.classList.add('open');
                        console.error(data.response.message);
                    }
                    this.submitButton.disabled = false;
                })
                .catch(error => {
                    this.error.classList.add('open');
                    console.error(error.message);
                    this.submitButton.disabled = false;
                });
        }
    }

    new KlenEcomail();
})();

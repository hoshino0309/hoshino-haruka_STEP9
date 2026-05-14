document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.product__search');

    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const params = new URLSearchParams(new FormData(form));

        fetch(form.action + '?' + params.toString(), {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById('productList').innerHTML = html;
        })
        .catch(err => console.error(err));
    });
});
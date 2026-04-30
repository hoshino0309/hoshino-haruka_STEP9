document.addEventListener('DOMContentLoaded', function () {

    const openBtn = document.getElementById('openModal');
    const closeBtn = document.getElementById('closeModal');
    const confirmBtn = document.getElementById('confirmPurchase');
    const modal = document.getElementById('confirmModal');

    if (openBtn) {
        openBtn.addEventListener('click', function() {
            modal.style.display = 'block';
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    }

    if (confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            document.getElementById('purchaseForm').submit();
        });
    }
});
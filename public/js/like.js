document.addEventListener('DOMContentLoaded', function () {

    const likeBtn = document.getElementById('likeBtn');

    if (!likeBtn) return;

    likeBtn.addEventListener('click', function () {

        const productId = this.dataset.productId;
        const url = `/products/${productId}/like`;

        // ボタンのclassで判定
        const isLiked = this.classList.contains('liked');

        fetch(url, {
            method: isLiked ? 'DELETE' : 'POST',
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {

            // いいね数更新
            const likeCountSpan = document.getElementById('likeCount');

            if (data.likes_count > 0) {

                if (likeCountSpan) {
                    likeCountSpan.textContent = data.likes_count;
                } else {

                    const newSpan = document.createElement('span');

                    newSpan.id = 'likeCount';
                    newSpan.textContent = data.likes_count;

                    this.parentNode.appendChild(newSpan);
                }

            } else {

                if (likeCountSpan) {
                    likeCountSpan.remove();
                }
            }

            // class切り替え
            if (isLiked) {

                this.classList.remove('liked');
                this.classList.add('not-liked');

            } else {

                this.classList.remove('not-liked');
                this.classList.add('liked');
            }
        })
        .catch(error => {
            console.error(error);
        });
    });
});
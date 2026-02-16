document.addEventListener('DOMContentLoaded', function () {
    const likeBtn = document.getElementById('like-btn');
    const likeIcon = document.getElementById('like-icon');
    const likeCount = document.getElementById('like-count');

    if (likeBtn) {
        likeBtn.addEventListener('click', function () {
            const postId = this.dataset.postId;
            fetch(`/post/${postId}/like`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    if (response.status === 401) {
                        window.location.href = '/login'; // Redirigir si no está logueado
                        return;
                    }
                    return response.json();
                })
                .then(data => {
                    if (data) {
                        // Actualizar contador
                        likeCount.textContent = data.likesCount;

                        // Actualizar icono
                        if (data.liked) {
                            likeIcon.classList.remove('bi-heart');
                            likeIcon.classList.add('bi-heart-fill');
                            likeBtn.classList.remove('btn-outline-danger');
                            likeBtn.classList.add('btn-danger');
                        } else {
                            likeIcon.classList.remove('bi-heart-fill');
                            likeIcon.classList.add('bi-heart');
                            likeBtn.classList.remove('btn-danger');
                            likeBtn.classList.add('btn-outline-danger');
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    }
});

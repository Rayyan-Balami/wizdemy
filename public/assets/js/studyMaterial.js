let lastCall = 0;
function likeMaterial(studyMaterialId, element) {
    const now = Date.now();
    const throttleTime = 1000; // 1000 milliseconds = 1 second

    if (now - lastCall < throttleTime) {
        return;
    }
    lastCall = now;
    if (element.classList.contains('active')) {
        $.ajax({
            type: 'DELETE',
            url: '/api/material/unlike/' + studyMaterialId,
            success: function (response) {
                console.log(response);
                if (response.data.status === 'success') {
                    element.classList.remove('active');
                    element.querySelector('span').innerText = parseInt(element.querySelector('span').innerText) - 1;
                }
            }
        });
    } else {
        $.ajax({
            type: 'POST',
            url: '/api/material/like/' + studyMaterialId,
            success: function (response) {
                console.log(response);
                if (response.data.status === 'success') {
                    element.classList.add('active');
                    element.querySelector('span').innerText = parseInt(element.querySelector('span').innerText) + 1;
                }
            }
        });
    }
}

function bookmarkMaterial(studyMaterialId, element) {

    const now = Date.now();
    const throttleTime = 1000; // 1000 milliseconds = 1 second

    if (now - lastCall < throttleTime) {
        return;
    }
    lastCall = now;


    if (element.classList.contains('active')) {
        $.ajax({
            type: 'DELETE',
            url: '/api/material/unbookmark/' + studyMaterialId,
            success: function (response) {
                console.log(response);
                if (response.data.status === 'success') {
                    element.classList.remove('active');
                    smallClientAlert('Removed from bookmarks');
                }
            }
        });
    } else {
        $.ajax({
            type: 'POST',
            url: '/api/material/bookmark/' + studyMaterialId,
            success: function (response) {
                console.log(response);
                if (response.data.status === 'success') {
                    element.classList.add('active');
                    smallClientAlert('Added to bookmarks');
                }
            }
        });
    }
}


// comment form

function commentLi(username, created_at, comment) {
    return `<div class="comment">
    <!-- username  -->
    <a href="profile.html" class="username">
        <!-- at icon @  -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            style="flex-shrink: 0" viewBox="0 0 512 512">
            <path
                d="M256 64C150 64 64 150 64 256s86 192 192 192c17.7 0 32 14.3 32 32s-14.3 32-32 32C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256v32c0 53-43 96-96 96c-29.3 0-55.6-13.2-73.2-33.9C320 371.1 289.5 384 256 384c-70.7 0-128-57.3-128-128s57.3-128 128-128c27.9 0 53.7 8.9 74.7 24.1c5.7-5 13.1-8.1 21.3-8.1c17.7 0 32 14.3 32 32v80 32c0 17.7 14.3 32 32 32s32-14.3 32-32V256c0-106-86-192-192-192zm64 192a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z">
            </path>
        </svg>
        <!-- username  -->
        <h3>
            ${username}
        </h3>
    </a>
    <!-- time  -->
    <div class="time">
        <span class="time-ago" data-datetime="${created_at}"
            style="font-size: 0.8rem; color: #a0a0a0;"></span>
    </div>
    <!-- comment  -->
    <p class="comment-content">
        ${comment}
    </p>
</div>`
}

const commentSection = document.querySelector('.comment-section');

function submitComment(element) {
    const form = element.parentElement;
    const studyMaterialId = element.getAttribute('data-material-id');
    const username = element.getAttribute('data-username');
    const comment = form.querySelector('textarea').value;
    const commentCount = document.querySelectorAll('.comment-count');

    if (comment.trim() === '') {
        smallClientAlert('Comment cannot be empty');
        return;
    }

    $.ajax({
        type: 'POST',
        url: '/api/material/comment/' + studyMaterialId,
        data: { comment },
        success: function (response) {
            console.log(response);
            if (response.data.status === 'success') {
                smallClientAlert('Comment added');
                form.querySelector('textarea').value = '';
                document.querySelector('#comment-button').classList.add('active');
                document.querySelector('.no-comments').style.display = 'none';
                commentSection.innerHTML = commentLi(username, new Date(), comment) + commentSection.innerHTML;
                commentCount.forEach((span) => {
                    span.innerText = parseInt(span.innerText) + 1;
                });
            }
        }
    });
}


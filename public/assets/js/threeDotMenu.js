
const threeDotMenu = document.getElementById('three-dot-menu');
const threeDotMenuUl = document.querySelector('#three-dot-menu ul');
const threeDotMenuId = document.querySelector('#three-dot-menu input[type="hidden"]');
const threeDotIcon = document.getElementsByClassName('three-dot-icon');
const share = document.getElementById('share');

function openThreeDotMenu(postId) {
    threeDotMenu.classList.add('open');
    threeDotMenuUl.classList.add('open');
    document.body.classList.add('menu-open');
    threeDotMenuId.value = postId;
    share.href = `https:localhost:8000/post/${postId}`;
}
function closeThreeDotMenu() {
    threeDotMenu.classList.remove('open');
    document.body.classList.remove('menu-open');

    threeDotMenuId.value = '';
    share.href = '';
}




// const threeDotMenu = document.getElementById('three-dot-menu');
// const threeDotMenuUl = document.querySelector('#three-dot-menu ul');
// const threeDotMenuId = document.querySelector('#three-dot-menu input[type="hidden"]');
// const threeDotIcon = document.getElementsByClassName('three-dot-icon');
// const share = document.getElementById('share');

// function openThreeDotMenu(id) {
//     // console.log(materail);
//     threeDotMenu.classList.add('open');
//     threeDotMenuUl.classList.add('open');
//     document.body.classList.add('menu-open');
//     // threeDotMenuId.value = postId;
//     // share.href = `https:localhost:8000/post/${postId}`;
// }
function closeThreeDotMenu() {
    threeDotMenu.classList.remove('open');
    document.body.classList.remove('menu-open');
}



const cards = document.querySelectorAll('.card');
const threeDotMenu = document.getElementById('three-dot-menu');
const threeDotMenuCopyLink = document.getElementById('copy-link');

cards.forEach(card => {
    const threeDotIcon = card.querySelector('.three-dot-icon');

    
    threeDotIcon.addEventListener('click', () => {
        const copyLink = card.getAttribute('data-copy-link');
        console.log(copyLink);
        threeDotMenuCopyLink.setAttribute('data-copy-link', copyLink);
        threeDotMenu.classList.toggle('open');
        document.body.classList.toggle('menu-open');
    });
    threeDotMenuCopyLink.addEventListener('click', () => {
        const link = threeDotMenuCopyLink.getAttribute('data-copy-link')
        navigator.clipboard.writeText(link)
        .then(() => {
            console.log('Link copied to clipboard');
        })

    });
});


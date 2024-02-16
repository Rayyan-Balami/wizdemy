const notificationOverlay = document.querySelector('#notificationOverlay');
const notificationModal = document.querySelector('#notificationModal');
const backBtnNotification = document.querySelector('#back-button-notification');

function toggleNotificationOverlay() {
  console.log('togglenotificationOverlay');

  if (!notificationModal.contains(event.target)) {
    notificationOverlay.classList.toggle('open');
    document.body.classList.toggle('menu-open');
  }
}

function closeNotificationOverlay(){
  notificationOverlay.classList.remove('open');
  document.body.classList.remove('menu-open');
}
document.addEventListener('DOMContentLoaded', () => {
    const notifications = document.querySelectorAll('.notification');

    notifications?.forEach(notification => {
        setTimeout(() => {
            notification.remove();
        }, 1000);
    });
});
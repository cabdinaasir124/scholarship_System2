$(document).ready(function () {
    let lastSeenNotificationID = null;

    function loadNotifications() {
        $.ajax({
            url: './api/notification_api.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                let html = '';
                let newLatestID = null;

                data.forEach(function (item, index) {
                    const isImage = item.icon.endsWith('.jpg') || item.icon.endsWith('.png');
                    const iconHTML = isImage
                        ? `<img src="${item.icon}"class="img-fluid rounded-circle" alt="" />`
                        : `<i class="${item.icon}"></i>`;

                    const bgClass = {
                        'primary': 'bg-primary',
                        'info': 'bg-info',
                        'danger': 'bg-danger',
                        'success': 'bg-success'
                    }[item.type] || '';

                    html += `
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon ${bgClass}">
                                ${iconHTML}
                            </div>
                            <p class="notify-details">${item.message}
                                <small class="text-muted">${item.timeAgo}</small>
                            </p>
                        </a>
                    `;

                    if (index === 0) {
                        newLatestID = item.id;
                    }
                });

                $('.notification-list-container').html(html);

                const $badge = $('.noti-icon-badge');
                if (data.length > 0) {
                    $badge.text(data.length).show();
                } else {
                    $badge.hide();
                }

                if (newLatestID && newLatestID !== lastSeenNotificationID) {
                    const sound = document.getElementById('notification-sound');
                    sound.play();
                    lastSeenNotificationID = newLatestID;
                }
            }
        });
    }

    loadNotifications();
    setInterval(loadNotifications, 10000); // every 10 seconds is more reasonable
});

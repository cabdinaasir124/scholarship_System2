$(document).on('click', '.notify-item', function () {
    const id = $(this).data('id');
    const $this = $(this);

    $.post('./api/mark_read.php', { id: id }, function (response) {
        if (response.success) {
            $this.removeClass('unread-notification');
            // Update count badge by reloading notifications or decrement count manually
            loadNotifications();
        } else {
            console.error('Failed to mark as read');
        }
    }, 'json');
});


class Notification {
    close() {
        console.log('close the button');
        $(document).on('click', '.notification > button.delete', function() {
            $(this).parent().addClass('is-hidden');
            return false;
        });
    }
}

export default Notification;
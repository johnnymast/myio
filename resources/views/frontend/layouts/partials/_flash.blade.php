<div class="notification {{ Session::get('flash_notification.level') }}">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('flash_notification.message') }}
</div>


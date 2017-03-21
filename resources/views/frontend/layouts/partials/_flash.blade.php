<div class="notification {{ Session::get('flash_notification.level') }}">
    {{ Session::get('flash_notification.message') }}
    <button type="button" class="delete" data-dismiss="alert" aria-hidden="true"></button>
</div>


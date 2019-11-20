<?php if (isset($error_message)) { ?>
<div class="toast" style="position: absolute; top: 1.5rem; right: 0;" data-delay="2000" data-autohide="false">
    <div class="toast-header">
        <strong class="mr-auto text-danger">Error</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <i class="fas fa-times fa-xs"></i>
        </button>
    </div>
    <div class="toast-body">
        <?php echo $error_message; ?>
    </div>
</div>
<?php } ?>

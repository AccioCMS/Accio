<script>
    jQuery(function(){
        jQuery('.downloadPopup').click(function () {
            jQuery('#downloadPopupModal, .popup-background').fadeIn();
            jQuery('#popupFirstName').focus();
        });
    });
</script>

<span style="text-align: center;text-align: center; width: 100%; display: inline-block;">
    <input class="btn btn-primary downloadPopup" type="submit" value="Get program information" style="text-align: center; width: 100%; display: inline-block;max-width: 300px;">
</span>
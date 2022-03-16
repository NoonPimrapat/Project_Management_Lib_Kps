<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script>
$(document).ready(function() {
    $('#uploadForm').ajaxForm({
        target: '#imagesPreview',
        beforeSubmit: function() {
            $('#uploadStatus').html('<img src="uploading.gif"/>');
        },
        success: function() {
            $('#images').val('');
            $('#uploadStatus').html('');
        },
        error: function() {
            $('#uploadStatus').html('Images upload failed, please try again.');
        }
    });
});
</script>
<!-- images upload form -->
<form method="post" id="uploadForm" enctype="multipart/form-data" action="upload.php">
    <label>Choose Images</label>
    <input type="file" name="images[]" id="images" multiple>
    <input type="submit" name="submit" value="UPLOAD" />
</form>

<!-- display upload status -->
<div id="uploadStatus"></div>
<!-- gallery view of uploaded images -->
<div class="gallery" id="imagesPreview"></div>
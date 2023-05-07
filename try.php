<html>
<div class="editPicture">
                        <img src="" alt="" id="uploadPreview">
                        <div class="des">
                        <label for="updPic">Choose Photo</label>
                        <input type="file" id="updPic" style="display: none;" name="photo" onchange="PreviewImage()">
                        <label for="remove" id="removeBtn">Remove Photo</label>
                        <input type="button" id="remove" style="display: none;" value="">
                        </div>
                    </div>
</html>
<script>
    function PreviewImage() {
    
    var pic = new FileReader();
    pic.readAsDataURL(document.getElementById("updPic").files[0]);
    pic.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
   
};
</script>
<div class="form-group">
    <label for="">{{$title}}</label>
    <div class="row">
        <div class="col-6">
            <input type="file" class="form-control {{$name}}" name="{{$name}}" accept=".jpg,.jpeg,.png">
        </div>
        <div class="col-6">
            <div id="{{$name}}" class="image_privew"><?= isset($previewLink) && $previewLink != "" ? "<img style='width: 100px; height:100px; padding: 10px' src='".asset($previewLink)."'>" : "<img style='width: 100px; height:100px; padding: 10px' src='".asset("media/default/No_image_available.png")."'>" ?></div>
        </div>
    </div>
</div>
<script>
$(document).on('change', '.{{$name}}', function() {

var filesCount = $(this)[0].files.length;

var textbox = $(this).prev();

if (filesCount === 1) {
var fileName = $(this).val().split('\\').pop();
textbox.text(fileName);
} else {
textbox.text(filesCount + ' files selected');
}

if (typeof (FileReader) != "undefined") {
var dvPreview = $("#{{$name}}");
dvPreview.html("");
$($(this)[0].files).each(function () {
var file = $(this);
    var reader = new FileReader();
    reader.onload = function (e) {
        var img = $("<img />");
        img.attr("style", "width: 100px; height:100px; padding: 10px");
        img.attr("src", e.target.result);
        dvPreview.append(img);
    }
    reader.readAsDataURL(file[0]);
});
} else {
alert("This browser does not support HTML5 FileReader.");
}
});
</script>

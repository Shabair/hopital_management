    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
	
var element = $("#card"); 
var getCanvas;
 
    $("#btn-Preview-Image").on('click', function () {
         html2canvas(element, {
         onrendered: function (canvas) {
                $("#box").append(canvas);
                getCanvas = canvas;
             }
         });
    });
	
$("#btn-Convert-Html2Image").on('click', function () {
    var imgageData = getCanvas.toDataURL("image/png");

    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
    $("#btn-Convert-Html2Image").attr("download", "your_pic_name.png").attr("href", newData);
});
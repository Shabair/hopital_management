
<script>
function addZero(figure){
var	afterFigure = "000"+figure;
return afterFigure;
}

function clearform(){
	$("#myForm :input").each(function (){
		$(this).val("");
	});
}


$(".js-example-basic-single").select2({
	placeholder: "Select please",
  allowClear: true
});

$(".js-example-basic-multiple").select2({
	placeholder: "Select please",
  allowClear: true
});

function printData()
{
   var divToPrint=document.getElementById("myTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
</script>
$(document).ready(function() {
	$("select").select2({dropdownCssClass: 'dropdown-inverse'});
	$("#regionSelect").change(function(){
		var regId = $(this).val();
		var ajaxURL = $("#ajaxURL").val();

		$.ajax({
			url: ajaxURL,
			type: 'POST',
			data: { 
				salt: "tyRd23Cv321ll",
				reg_id: regId
			},
			dataType: 'html',
			success: function(html){

				$("#cityWrapper").html(html);
				$("#citySelect").select2({dropdownCssClass: 'dropdown-inverse'});
			}
		});

	});

//СЛАЙДЕРЫ НА СТРАНИЦЕ ПРОФИЛЕ
var $slider = $("#slider");
var $slider2 = $("#slider2");
if ($slider.length > 0) {
  $slider.slider({
    min: 0,
    max: 10,
    value: 5,
    orientation: "horizontal",
    range: "min"
  }),$slider2.slider({
    min: 0,
    max: 10,
    value: 5,
    orientation: "horizontal",
    range: "min"
  })
}
    


});

//РЕГУЛИРОВКА ЦВЕТА И ПРОЦЕНТАЖА СЛАЙДЕРА ПРОФИЛЯ
var getPercent = function (node){
   var nodeLength = node.childNodes[1];
   var sliderWidth = parseInt($("#slider").css("width"));
   var percent = parseInt($(nodeLength).css("width"))/sliderWidth*100;
   var textHolder = node.childNodes[0];
   textHolder.innerHTML = percent.toFixed()+"%";
   if(percent.toFixed()<=20){$(nodeLength).css("background",'#e74c3c');}
   else if(percent.toFixed()>20&&percent.toFixed()<70){$(nodeLength).css("background",'#f1c40f');}
   else{$(nodeLength).css("background",'#2ecc71');}
}




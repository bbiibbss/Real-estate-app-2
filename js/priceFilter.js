function filterSystem($minValue, $maxValue, $inputMin, $inputMax, $data) {
    $('.propertyShow').filter(function () {
    	var min = $("input[name='"+$inputMin+"']").val();
    	var max = $("input[name='"+$inputMax+"']").val();
        var price = parseInt($(this).data($data));
        if (isNaN(price)) {
            price = '0';
        }
        if(min==""){
        	min = $minValue;
        }
        if(max==""){
        	max = $maxValue;
        }
        $('.propertyShow').hide();
        return price >= min && price <= max;
    }).show();
}

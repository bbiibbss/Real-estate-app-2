jQuery(document).ready(function($){
    var countyOptions = $('.select-county option');
    var parishOptions = $('.select-parish option');
    $('.select-island').on('change', function(e){
        $('.select-county').append(countyOptions);
        $('.select-county option[data-island!=' + $(this).val() +']').remove();
        $('.select-parish').append(parishOptions);
        $('.select-parish option[data-county!=' + $(this).val() +']').remove();
    });
    $('.select-county').on('focusin', function(e){
        $('.select-parish').append(parishOptions);
        $('.select-parish option[data-county!=' + $(this).val() +']').remove();
    });
});

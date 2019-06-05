$('#report-name').keyup(function() {
    var max = 20;
    var length = $(this).val().length;
    var char = max - length;
    $('#char-count-1').text(char + '/' + max);
});

$('#report-desc').keyup(function() {
    var max = 200;
    var length = $(this).val().length;
    var char = max - length;
    $('#char-count-2').text(char + '/' + max);
});

function update() {
    var name = $('#dropdown').find(':selected').data('name');
    var quantity = $('#dropdown').find(':selected').data('quantity');
    document.getElementById("report-quantity").max = quantity;
    if($(".form-section").hasClass("disabled")) {
        $(".form-section").removeClass("disabled");
    }
}
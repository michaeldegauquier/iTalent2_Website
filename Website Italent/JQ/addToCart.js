$(document).ready(function () {
    console.log("JQuery linked");

    $('.shoppingCartButton').on('click', function(e) {
        e.preventDefault();

        var productId = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: '../pagesDB/shopping_cartDB.php',
            data: {productId: productId},
            success: function(response) {
                console.log(response);
                alert('Product Added!');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('There is an error!');
            }
        });
    });
});
// Stackoverflow. How do I catch an Ajax query post error? Geraadpleegd via
// https://stackoverflow.com/questions/2833951/how-do-i-catch-an-ajax-query-post-error
// Geraadpleegd op 15 april 2019
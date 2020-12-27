$(document).ready(function () {
    //Form Submit for IE Browser
    $('button[type=\'submit\']').on('click', function (e ) {
        if ($("form[name$='_form']").length > 0) {
            e.preventDefault();
            $("form[name$='_form']").submit();
        }
    });

    $('.add-attribute').click(function (e) {
        var element = $(this);
        var list = $(this).data('list-element');



        // Try to find the counter of the list or use the length of the list
        var counter = element.data('widget-counter') || $(list).children().length;

        // grab the prototype template
        var newWidget = element.attr('data-prototype');

        // replace the "__name__" used in the id and name of the prototype
        // with a number that's unique to your emails
        // end name attribute looks like name="contact[emails][2]"
        var newElem = newWidget.replace(/__name__/g, counter);
        // Increase the counter

        $(list).append(newElem);

        counter++;
        // And store it, the length cannot be used if deleting widgets is allowed
        element.data('widget-counter', counter);
    });


    var $wrapper = $('form[name="product_form"]').on('click','.remove-attribute', function () {
        var widget_id = $(this).data('widget-id');

        console.log(widget_id);

        $(this).closest('tr').remove();
    });
});
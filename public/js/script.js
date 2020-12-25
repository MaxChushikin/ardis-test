$(document).ready(function () {
    $('.add-attribute').click(function (e) {
        var list = $($(this).attr('data-list-selector'));
        // Try to find the counter of the list or use the length of the list
        var counter = list.data('widget-counter') || list.children().length;

        // grab the prototype template
        var newWidget = list.attr('data-prototype');
        // replace the "__name__" used in the id and name of the prototype
        // with a number that's unique to your emails
        // end name attribute looks like name="contact[emails][2]"
        newWidget = newWidget.replace(/__name__/g, counter);
        // Increase the counter

        // create a new list element and add it to the list
        var newElem = $(list.attr('data-widget-tags')).html(newWidget + '<div class="form-group"><button type="button" class="remove-attribute btn btn-danger" data-widget-id="#product_form_attribute_' + counter + '">Remove attribute</button></div>');

        newElem.appendTo(list);


        counter++;
        // And store it, the length cannot be used if deleting widgets is allowed
        list.data('widget-counter', counter);
    });


    var $wrapper = $('form[name="product_form"]').on('click','.remove-attribute', function () {
        var widget_id = $(this).data('widget-id');

        console.log(widget_id);

        $(this).closest('div').prev().remove();
        $(this).closest('div').remove();
    });
});
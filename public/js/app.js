(function ($) {
    function loadItems($element) {
        $.get('products.json').done(function (items) {
            items.forEach(function (item) {
                $element.append(createItem(item));
            });
        });
    }

    function createItem(data) {
        return '<p>\n' +
                '    <label for="product_' + data.id + '">' + data.label + '</label>\n' +
                '    <select id="product_\' + data.id + \'" name="' + data.id + '">\n' +
                '        <option selected>0</option>\n' +
                '        <option>1</option>\n' +
                '        <option>2</option>\n' +
                '        <option>3</option>\n' +
                '        <option>4</option>\n' +
                '        <option>5</option>\n' +
                '        <option>6</option>\n' +
                '        <option>7</option>\n' +
                '        <option>8</option>\n' +
                '        <option>9</option>\n' +
                '        <option>10</option>\n' +
                '    </select>\n' +
                '</p>';
    }

    function requestPayment($form, $button, $errorMsg) {
        $button.attr('disabled', true);
        $errorMsg.html('<section id="error"></section>');

        var data = $form.serializeArray().filter(function (item) {
            return item.value > 0;
        });

        if (data.length === 0) {
            $errorMsg.append('<p>Você deve selecionar ao menos um ingresso</p>');
            $button.attr('disabled', false);
            return;
        }

        $.post({url: 'pay.php', data: JSON.stringify(data), contentType: 'application/json'}).done(function (result) {
            PagSeguroLightbox(result);
            $button.attr('disabled', false);
        });
    }

    $(function () {
        var $form = $('#main_form');
        var $button = $form.find('button');
        var $errorMsg = $form.children('#error');

        $form.submit(function (event) {
            event.preventDefault();

            requestPayment($form, $button, $errorMsg);
        });

        loadItems($form.children('#items'));
    });
})(jQuery);

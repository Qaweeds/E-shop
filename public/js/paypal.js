var errorsExists = false;
var fields = {};

function getFields() {
    return $('#checkout-form').serializeArray().reduce(function (obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});
}

function isEmptyFields() {
    const fields = getFields();

    for (const [key, value] of Object.entries(fields)) {
        if (value.length < 1) {
            return true;
        }
    }
    return false;
}

const paypalConfig = {
    onInit: function (data, actions) {

    },
};

paypal.Buttons({

    onInit: function (data, actions) {
        if (isEmptyFields()) {
            actions.disable();
        }

        $(document).on('change', '#checkout-form', function () {
            if (!isEmptyFields()) {
                actions.enable();
            }
        });
    },
    onClick: function (data, actions) {
        if (isEmptyFields()) {
            // notification
        }
    },
    createOrder: function (data, actions) {
        const errorClass = 'is-invalid';

        const fields = getFields();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        return $.ajax({
            url: '/paypal/order/create/',
            type: 'POST',
            dataType: 'json',
            data: JSON.stringify(fields),
            beforeSend: function () {
                $('.invalid-feedback').remove();
                $(`.${errorClass}`).removeClass(errorClass);
            },
            error: function (data) {
                const responseJson = data.responseJSON;
                let errorTemplate = `<span class="invalid-feedback" role="alert">
                                        <strong>___</strong>
                                    </span>`;

                for (let [field, message] of Object.entries(responseJson.errors)) {
                    let $input = $(`input[name="${field}"]`);
                    $input.addClass(errorClass);
                    $input.after(errorTemplate.replace('___', message[0]));
                }
            }
        }).then(function (order) {
            return order.vendor_order_id;
        }).catch(function (error) {
            return;
        });
    },

    // Call your server to finalize the transaction
    onApprove: function (data, actions) {
        if (data.hasOwnProperty('orderID')) {
            return fetch('/paypal/order/' + data.orderID + '/capture/', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                }
            }).then(function (res) {
                return res.json();
            }).then(function (orderData) {
                var errorDetail = Array.isArray(orderData.details) && orderData.details[0];
                if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                    return actions.restart();
                }
                if (errorDetail) {
                    return false;
                }

                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('ЗАКАЗ ОПЛАЧЕН УСПЕШНО');
                location.href = '/paypal/order/' + data.orderID + '/thank-you';
            });
        }
    },
    style: {
        layout: 'horizontal'
    }
}).render('#paypal-button-container');

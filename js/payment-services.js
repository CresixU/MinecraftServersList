function GeneratePaymentTypes() {
    $.ajax({
        url: api_url+'/api/v1/promote-payments/available-methods/'
    }).done(res => {
        res.forEach(x => $('#method').append($('<option value="'+x+'">'+ReturnPaymentType(x)+'</option>')));      
    })
}
function ReturnPaymentType(type) {
    switch(type) {
        case 'PAYPAL':
            return "PayPal";
        case 'PAYSAFECARD':
            return "PaySafeCard";
        case 'G2APAY':
            return "G2A Pay";
        case 'JUST_PAY':
            return "Just Pay";
        case 'CASH_BILL_TRANSFER':
            return "Przelew gotówkowy";
        case 'SMS_CASH_BILL':
            return "SMS";
        default:
            return 'Error';
    }
} 
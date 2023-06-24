function GeneratePaymentTypes() {
    $.ajax({
        url: api_url+'/api/v1/promote-payments/available-methods/'
    }).done(res => {
        res.forEach(x => $('#method').append($('<option value="'+x+'">'+ReturnPaymentType(x)+'</option>')));      
    })
}
function ReturnPaymentType(type) {
    switch(type) {
        case 'PAYSAFECARD':
            return "PaySafeCard";
        case 'JUST_PAY':
            return "SMS+";
        case 'CASH_BILL_TRANSFER':
            return "Przelew";
        default:
            return 'Error';
    }
} 
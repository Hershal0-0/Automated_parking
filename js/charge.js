var stripe = Stripe('pk_test_51HknCnIT4kRr32BInzlAJ347UH8HrznjN8RUnjPjaKe2uzdFZTkw6qlEecr8dofd4ZBn93HRVyaCp8491iProdr800PZ3lYDQs');
var elements = stripe.elements();

var style={
    base:{
        color:'#32325d',
        
        fontFamily: ' "Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder':{
            color:"#aab7c4"
        }
    },
    invalid:{
        color:'#fa755a',
        iconColor:'#fa755a'
    }
}

//Style Button With Boostrap
document
    .querySelector("#payment-form button")
    .classList="btn btn-primary btn-block mt-4"

var card =elements.create('card',{style:style})

card.mount('#card-element')

card.addEventListener('change',(event)=>{
    var displayError=document.getElementById('card-errors')
    if(event.error){
        displayError.textContent=event.error.message
    }else{
        displayError.textContent=" "
    }
})

var form=document.getElementById('payment-form')
form.addEventListener('submit',(event)=>{
    event.preventDefault()

    stripe.createToken(card).then((result)=>{
        if(result.error){
            var errorElement=document.getElementById('card-errors')
            errorElement.textContent=result.error.message
        }else{
            stripeTokenHandler(result.token)
        }
    })
})

function stripeTokenHandler(token){
    var form=document.getElementById('payment-form')
    var hiddenInput=document.createElement('input')
    hiddenInput.setAttribute('type','hidden')
    hiddenInput.setAttribute('name','stripeToken')
    hiddenInput.setAttribute('value',token.id)
    form.appendChild(hiddenInput)

    form.submit()
}
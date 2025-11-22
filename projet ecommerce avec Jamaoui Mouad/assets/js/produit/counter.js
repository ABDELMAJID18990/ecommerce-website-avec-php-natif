const plusBtns = document.querySelectorAll('.counter-plus');
const moinsBtns = document.querySelectorAll('.counter-moins');



plusBtns.forEach(plusBtn =>{
    plusBtn.addEventListener("click",function(){
        const inputQte = plusBtn.previousElementSibling;
        
        let qteValue = parseInt(inputQte.value);
        
        if (qteValue < 99) {
            qteValue++; 
        }

        inputQte.value = qteValue;

    })
})

moinsBtns.forEach(moinsBtn =>{
    moinsBtn.addEventListener("click",function(){

         const inputQte = moinsBtn.nextElementSibling;

        let qteValue = parseInt(inputQte.value);

       
        if (qteValue > 0) {
            qteValue--; 
        }
        
        inputQte.value = qteValue;
    
    })
})

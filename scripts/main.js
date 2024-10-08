function removeElement() {
    var element = document.querySelector(".overlay");
    element.parentNode.removeChild(element);
}

setTimeout(removeElement, 2000);

// Submit for for checkbox
const filter_box = document.querySelectorAll('.filter-box');
const filter_form = document.querySelector('#filter-form');

filter_box.forEach((box) => {
    box.addEventListener('click', () => {
        filter_form.submit();
    })
});

// Submit form for textbox
const physical_input = document.querySelectorAll('.physical');
physical_input.forEach((input) => {
    input.addEventListener('keydown', (event)=> {
        if (event.keyCode === 13) {
            event.preventDefault();
            filter_form.submit();
        }
    })
})

// Change the count for hand filter
const increase_hand = document.querySelector('#increase-hand');
const decrease_hand = document.querySelector('#decrease-hand');
const hand = document.querySelector('#hand');
increase_hand.addEventListener('click', ()=> {
    if (hand.value < 2) {
        hand.value = parseInt(hand.value) + 1;
        filter_form.submit();
    }
});
decrease_hand.addEventListener('click', ()=> {
    if (hand.value > 0) {
        hand.value = parseInt(hand.value) - 1;
        filter_form.submit();
    }
});

// Change the count for leg filter
const increase_leg = document.querySelector('#increase-leg');
const decrease_leg = document.querySelector('#decrease-leg');
const leg = document.querySelector('#leg');
increase_leg.addEventListener('click', ()=> {
    if (leg.value < 2) {
        leg.value = parseInt(leg.value) + 1;
        filter_form.submit();
    }
});
decrease_leg.addEventListener('click', ()=> {
    if (leg.value > 0) {
        leg.value = parseInt(leg.value) - 1;
        filter_form.submit();
    }
});
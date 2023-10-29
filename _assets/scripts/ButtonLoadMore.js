document.addEventListener('DOMContentLoaded', function () {
    const loadMore = document.querySelector('.load-more');

    let currentItems = 5;
    loadMore.addEventListener('click', (e) => {
        const elementList = [...document.querySelectorAll('.ListPost div.Post')];
        const SpanLoading = document.querySelector('.text-loading');
        SpanLoading.classList.remove('visually-hidden');
        const SpanSpinner = document.querySelector('.spinner-border');
        SpanSpinner.classList.remove('visually-hidden');
        const SpanLoader = document.querySelector('.text-load');
        SpanLoader.classList.add('visually-hidden');
        loadMore.disabled = true;

        for (let i = currentItems; i < currentItems+5; i+=1){
            setTimeout(function (){
                SpanLoading.classList.add('visually-hidden');
                SpanLoader.classList.remove('visually-hidden');
                SpanSpinner.classList.add('visually-hidden');
                loadMore.disabled = false;
                if (elementList[i]){
                    elementList[i].style.display = 'flex';
                }

            },1500)
        }
        currentItems+=5;

        //hide load button
        if (currentItems >= elementList.length){
            setTimeout( function (){
                loadMore.classList.add('d-none')
            }, 1500)
        }
    })
});
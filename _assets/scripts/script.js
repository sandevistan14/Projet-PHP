function addCatPost(){
    const cat1 = document.getElementById("DivCategorie1");
    const cat2 = document.getElementById("DivCategorie2");
    const cat3 = document.getElementById("DivCategorie3");
    const NbSelect = document.getElementById("NbselectDisplayed")
    const buttonAdd = document.getElementById("AddCatToPost")
    if (cat1.classList.contains("visually-hidden")){
        cat1.classList.remove("visually-hidden");
        NbSelect.value = "1";
    }
    else {
        if (cat2.classList.contains("visually-hidden")){
            cat2.classList.remove("visually-hidden");
            NbSelect.value = "2";
        }
        else{
            if (cat3.classList.contains("visually-hidden")){
                cat3.classList.remove("visually-hidden");
                NbSelect.value = "3";
                buttonAdd.classList.add("visually-hidden");
            }
        }
    }
}

function HideCatSelect(){
    const cat1 = document.getElementById("DivCategorie1");
    const cat2 = document.getElementById("DivCategorie2");
    const cat3 = document.getElementById("DivCategorie3");
    const NbSelect = document.getElementById("NbselectDisplayed")
    const buttonAdd = document.getElementById("AddCatToPost");
    if (!(cat1.classList.contains('visually-hidden'))){
        cat1.classList.add('visually-hidden');
    }
    if (!(cat2.classList.contains('visually-hidden'))){
        cat2.classList.add('visually-hidden');
    }
    if (!(cat3.classList.contains('visually-hidden'))){
        cat3.classList.add('visually-hidden');
    }
    if (buttonAdd.classList.contains('visually-hidden')){
        buttonAdd.classList.remove('visually-hidden');
    }
    NbSelect.value = "0";
}
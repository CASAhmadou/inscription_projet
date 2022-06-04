//Accueil
const barCanvas = document.getElementById("barcanvas");

const barChart =  new Chart(barCanvas, {
    type: "bar",
    data: {
        labels: ["Professeurs", "Etudiants", "Modules", "Classes"],
        datasets: [{
            data:[129,195,250,107],
            backgroundColor: [
                "crimson",
                "lightgreen",
                "lightblue",
                "violet"
            ]
        }]
    }
})


//Create module
const plus = document.querySelector('.plus');
const newTr = document.getElementById('newTr');
const module = document.querySelector('.module');

plus.addEventListener('click',function(){
    const tr = document.createElement('tr')
    const tda = document.createElement('td')
    const tdb = document.createElement('td')
    const input = document.createElement('input')
    
    input.setAttribute('type','text')
    input.value=tda.innerText
    tda.appendChild(input)
    input.addEventListener('blur',function(){
        alert("Je confirme l'ajout du nouveau Module")
        tda.innerHTML=input.value
    })
    
    tdb.innerHTML=`<button type="button" class="btn btn-outline-info">
    <i class="fa-solid fa-person-chalkboard"></i></button>
    <button type="button" class="btn btn-outline-info">
    <i class="fa-solid fa-trash-can"></i></button>`

    
    tr.appendChild(tda)
    tr.appendChild(tdb)
    newTr.appendChild(tr)
 })



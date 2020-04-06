
function details(id){

    var cards = document.getElementById("game-"+id).getAttribute("data-cards").replace(/"/g, '').split(';')

    for (i = 0; i < cards.length; i++){
        card = cards[i].split('x');
        $('#game-'+id).append('<div class="card reveal" id="'+i+'"><img class="w-100 mx-auto d-block" src="/memory/public/img/memory_img/'+card[0]+'.png" /></div>')

    }


    $('#modal-'+id).modal()

}
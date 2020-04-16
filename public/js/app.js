
if($('#game').length > 0){
    var cards = document.getElementById("game").getAttribute("data-cards").replace(/"/g, '').split(';')
    var card_clicked = -1;
    var card_clicked_id = -1;
    var freeze = false;
    var nbtry = $('#nbtry').text();
    var nbcards = $('#nbcards').text();

    for (i = 0; i < cards.length; i++){
        card = cards[i].split('x');
        if(card[1] == "1"){
            $('#game').append('<div class="card-game reveal" id="'+i+'"><img class="h-100 mx-auto d-block" src="'+imgFolder+'/memory_img/'+card[0]+'.png" /></div>')

        }else{
            $('#game').append('<div class="card-game not-reveal" id="'+i+'"><span class="d-block text-center w-100 h-100 h1">?</span></div>')
        }
    }





    $('.not-reveal').click(function(){
        if(card_clicked_id != $(this).attr('id') && !freeze && $(this).hasClass('not-reveal')){
            $(this).addClass('reveal')
            $(this).removeClass('not-reveal')



            $(this).html('<img class="mx-auto d-block" src="'+imgFolder+'/memory_img/'+cards[$(this).attr('id')].split('x')[0]+'.png" />')


            if(card_clicked === cards[$(this).attr('id')].split('x')[0]){
                cards[$(this).attr('id')] = cards[$(this).attr('id')].substr(0,cards[$(this).attr('id')].length-1)+"1";
                cards[card_clicked_id] =  cards[card_clicked_id].substr(0,cards[card_clicked_id].length-1)+"1";
                console.log("trouver");
                $.ajax({
                    url:'updateCards',
                    type: "POST",
                    dataType: "json",
                    data: {
                        "cards": cards.join(';'),
                        "partyid": $('#game').attr('party-id')
                    },
                })

                card_clicked= -1;
                card_clicked_id = -1;

                if($('.not-reveal').length <= 0){

                    $.ajax({
                        url:'updateState',
                        type: "POST",
                        dataType: "json",
                        data: {
                            "state": 1,
                            "partyid": $('#game').attr('party-id')
                        },
                    })
                    $('#nbcardsend').text($('#nbcards').text());
                    $('#nbtryend').text(nbtry);

                    $('#winningModal').modal('toggle');

                }




            }else if(card_clicked == -1) {
                card_clicked = cards[$(this).attr('id')].split('x')[0]
                card_clicked_id = $(this).attr('id');
                nbtry++;
                $('#nbtry').text(nbtry);
                $.ajax({
                    url:'updateNbTry',
                    type: "POST",
                    dataType: "json",
                    data: {
                        "nbtry": nbtry,
                        "partyid": $('#game').attr('party-id')
                    },
                })
            }else{
                freeze = true;
                sleep(1000).then(() => {


                    $(this).html('<span class="d-block text-center w-100 h-100 h1">?</span>');
                    $(this).addClass('not-reveal')
                    $(this).removeClass('reveal')

                    $("#"+card_clicked_id).html('<span class="d-block text-center w-100 h-100 h1">?</span>');
                    $("#"+card_clicked_id).addClass('not-reveal')
                    $("#"+card_clicked_id).removeClass('reveal')

                    card_clicked = -1;
                    card_clicked_id = -1;
                    freeze = false;

                });

            }

        }

    })
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
}

{OVERALL_GAME_HEADER}
<div id="gamepanel" class="card_m tooltip_xl">
    <div class="container">
        <div id="carddeck" >
            <div class="">
                <div id="aviableDraw">
                </div>
                <div class="clear"></div>
            </div>
            <div class="">
                <div id="deck">
                </div>
                <div class="clear"></div>
            </div>

        </div>
        <div id="board">
            <!-- BEGIN myhand -->
            <div id="myhand_wrap" class="whiteblock">
                <h3>{MY_HAND}</h3>
                <div id="myhand">
                    
                </div>
                <div class="clear"></div>
            </div>
            <!-- END myhand -->
            <!-- BEGIN player -->
            <div  class="playertable whiteblock playertable" id="player_board_{id}" >
                <div class="playertablename" style="color:#{color}">
                    {name}
                </div>
                <div class="playertablecard" id="playertable_{id}">
                </div>
                <div class="clear"></div>
            </div>
            <!-- END player -->
        </div>
    </div>
    <div class="clear"></div>

</div>




<script type="text/javascript">
    var jstpl_card = `
        <div class="cardontable card_\${type} card_\${shortclass}" id="\${location}_card_\${id}" data-id="\${id}">
            <span class="card_title">\${title}</span>
            <span class="card_title card_subtitle">\${subtitle}</span>
            <span class="card_title card_text1">\${text1}</span>
            <span class="card_title card_text2">\${text2}</span>
            <span class="debug">\${type}</span>
        </div>
    `;
    var jstpl_deck = `
        <div class="cardontable card_0">
            <div class="count-status">\${deck}</div>
        </div>
    `;

</script>  

{OVERALL_GAME_FOOTER}

{OVERALL_GAME_HEADER}
<div id="gamepanel" class="card_m tooltip_xl">
    <div class="container-full">
        <div id="deck-and-discard">

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

        </div>
        <div class="clear"></div>
        <div id="tables">

        </div>
    </div>
    <div class="clear"></div>

</div>




<script type="text/javascript">



    var jstpl_deck = `
        <div class="cardontable card_0">
            <div class="count-status">\${deck}</div>
        </div>
    `;

</script>  

{OVERALL_GAME_FOOTER}

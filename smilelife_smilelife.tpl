{OVERALL_GAME_HEADER}
<div id="attack_victim" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title">{CHOOSE_TARGET}</div>
            <div class="modal-close">
                <a href="#" class="action-button bgabutton bgabutton_gray" onclick="return false;" id="attackCancel_button">X</a>
            </div>
        </div>
        <div id="attack_victim_selection" class="modal-body">

        </div>
    </div>
</div>
<div id="game_container">
    <div class="centered_table" id="mytable_container">
        <div id="deck_and_discard">
            <div class="pile_container pile_deck">
                <div class="pile" id="pile_deck">

                </div>
                <div class="pile_counter" id="pile_deck_count">0</div>
            </div>
            <div class="pile_container pile_discard">
                <div class="pile" id="pile_discard">

                </div>
                <div class="pile_counter" id="pile_discard_count">0</div>
            </div>
        </div>


    </div>
    <div class="centered_table player_tables">
        <div id="tables">


        </div>
    </div>
</div>

<script type="text/javascript">
    var jstpl_card = `
        <div id="card_\${id}" class="cardontable selectable" >
            <div class="card_sides">
                <div class="card-side front" id="front_card_\${id}">
                </div>
                <div class="card-side back"></div>
            </div>
        </div>
    `;
</script>

{OVERALL_GAME_FOOTER}

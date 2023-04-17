{OVERALL_GAME_HEADER}

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
        <div id="card_\${id}_temp" class="cardontable debug">
            <div class="card_sides">
                <div class="card-side front" id="front_card_\${id}"></div>
                <div class="card-side back"></div>
            </div>
        </div>
    `;
</script>

{OVERALL_GAME_FOOTER}

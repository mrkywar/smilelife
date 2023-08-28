{OVERALL_GAME_HEADER}
<div id="modal-container"></div>

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
            <div class="pile_container pile_offside">
                <div class="pile" id="pile_offside">

                </div>
                <div class="pile_counter" id="pile_offside_count">0</div>
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
    
    var jstpl_attack_modale = `
        <div class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">\${title}</div>
                    <div class="modal-close">
                        <a href="#" class="action-button bgabutton bgabutton_gray" onclick="return false;" id="attackCancel_button">X</a>
                    </div>
                </div>
                <div id="modal_selection" class="modal-body">
                </div>
            </div>
        </div>
    `;
    
    var jstpl_card_content = `
        <span class="card_text card_title">\${title}</span>
        <span class="card_text card_subtitle">\${subtitle}</span>
        <span class="card_text card_text1">\${text1}</span>
        <span class="card_text card_text2">\${text2}</span>
        <span class="debug">\${id} / \${type} - S : \${smilePoints}</span>
    `;
    
    var jstpl_card_more = `
        <div id="card_more_\${id}" class="cardontable selectable" data-type="\${type}" data-id="\${id}" data-category="\${category}" data-points="\${smilePoints}" data-name="\${name}">
            <div class="card_sides">
                <div class="card-side front" id="front_card_more_\${id}">
                    <span class="card_text card_title">\${title}</span>
                    <span class="card_text card_subtitle">\${subtitle}</span>
                    <span class="card_text card_text1">\${text1}</span>
                    <span class="card_text card_text2">\${text2}</span>
                    <span class="debug">\${id} / \${type} - S : \${smilePoints}</span>
                </div>
            </div>
        </div>
    `;

</script>

{OVERALL_GAME_FOOTER}

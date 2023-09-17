define([
    'dojo',
    'dojo/_base/declare',
    'ebg/core/gamegui'
    
], function (dojo, declare) {
    return declare(
            'common.tools',
            [
                ebg.core.gamegui,
            ],
            {
                constructor: function () {
                    this.isDebugEnabled = ('studio.boardgamearena.com' === window.location.host || window.location.hash.indexOf('debug') > -1);
                    this.debug("common.tools active");
                },

                /**
                 * this function is usefull for the game developpers 
                 * @returns void
                 */
                debug: function () {
                    if (this.isDebugEnabled) {
                        console.log.apply(null, arguments);
                    }
                },

                /**
                 * this function get rhe value of the given userPreference or null
                 * @param {sting} user_pref 
                 * @returns {mixed}
                 */
                getUserPreference: function (user_pref) {
                    if (this.prefs[user_pref]) {
                        return this.prefs[user_pref].value;
                    } else {
                        return null;
                    }
                },

                /**
                 * This function compute the "luma" of a given color (HTML/CSS format without #)
                 * is usfull to know if a color is light or dark.
                 * @param {int} color
                 * @returns {Number}
                 */
                getHtmlColorLuma: function (color) {
                    var rgb = parseInt(color, 16);   // convert rrggbb to decimal
                    var r = (rgb >> 16) & 0xff;  // extract red
                    var g = (rgb >> 8) & 0xff;  // extract green
                    var b = (rgb >> 0) & 0xff;  // extract blue

                    return 0.2126 * r + 0.7152 * g + 0.0722 * b;

                },

                /**
                 * This function add the given CSS String Sequence to actual DOM
                 * @param {string} css
                 * @returns {void}
                 */
                insertCSS: function (css) {
                    var styleSheet = document.createElement("style");
                    styleSheet.type = "text/css";
                    styleSheet.innerText = css;
                    document.head.appendChild(styleSheet);
                },

            }
    );
});
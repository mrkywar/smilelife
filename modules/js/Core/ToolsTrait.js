
/*
 * ToolsTrait is toobox can be used by any games
 * 
 */


define(['dojo', 'dojo/_base/declare'], (dojo, declare) => {
    return declare('common.ToolsTrait', ebg.core.gamegui, {

        constructor: function () {
            this.isDebugEnabled = ('studio.boardgamearena.com' === window.location.host || window.location.hash.indexOf('debug') > -1);
        },

        /* -------------------------------------------------------------
         *                  BEGIN - DEBUG TOOL
         * ---------------------------------------------------------- */
        debug: function () {
            if (this.isDebugEnabled) {
                console.log.apply(null, arguments);
            }
        },

        /* -------------------------------------------------------------
         *                  BEGIN - Users TOOL
         * ---------------------------------------------------------- */
        getUserPreference: function (user_pref) {
            if (this.prefs[user_pref]) {
                return this.prefs[user_pref].value;
            } else {
                return null;
            }
        },
        /* -------------------------------------------------------------
         *                  BEGIN - Color luma
         * ---------------------------------------------------------- */
        getHtmlColorLuma(color) {
            var rgb = parseInt(color, 16);   // convert rrggbb to decimal
            var r = (rgb >> 16) & 0xff;  // extract red
            var g = (rgb >> 8) & 0xff;  // extract green
            var b = (rgb >> 0) & 0xff;  // extract blue

            return 0.2126 * r + 0.7152 * g + 0.0722 * b;

        },

        /* -------------------------------------------------------------
         *                  BEGIN - CSS Manipulate
         * ---------------------------------------------------------- */
        insertCSS: function (css) {
            var styleSheet = document.createElement("style");
            styleSheet.type = "text/css";
            styleSheet.innerText = css;
            document.head.appendChild(styleSheet);
        },
    });
});
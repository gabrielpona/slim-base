/**
 * User: Vinicius Cardoso
 * Date: 02/04/14
 * Time: 08:23
 */

"use strict";

var Main = window.Main || {};

Main.Util = function(){
    return {
        getBaseUrl: function (complemento) {
            var url = "";
            if (document.location.port === "80" || document.location.port === "") {
                url = document.location.protocol + '//' + document.location.hostname + document.location.pathname;
            } else {
                url = document.location.protocol + '//' + document.location.hostname + ':' + document.location.port + document.location.pathname;
            }

            var url2 = url.split('/');
            var url3 = "";
            if (this.containsString(url, 'localhost')) {
                for (var i = 0; i < 3; i++) {
                    url3 += url2[i] + '/';
                }
                if(this.containsString(url3,'https')) {
                    url3 = url3.replace(/\/\//g, '/').replace(/https:\//g, 'https://');
                } else {
                    url3 = url3.replace(/\/\//g, '/').replace(/http:\//g, 'http://');
                }

            } else {
                for (var i = 0; i < 3; i++) {
                    url3 += url2[i] + '/';
                }
            }
            url3 = url3.substring(0, url3.length - 1);
            return complemento !== undefined && complemento !== null ? url3 + complemento : url3;
        },
        containsString: function (strBase, strProcura) {
            if (strBase.indexOf(strProcura) === -1) {
                return false;
            } else {
                return true;
            }
        },
        checkPassword: function (senha1, senha2) {
            return (senha1 === senha2) && (senha1 !== "" && senha2 !== "");
        }

    }
}();

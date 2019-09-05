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
        },
        alertDataError: function(url, data) {
            if (data != null && data != undefined && Main.Util.containsString(data.responseText, ":::")) {
                var title = data.responseText.split(":::")[0];
                var texto = data.responseText.split(":::")[1];

                $("#error-message").text(title);
                if (Main.Util.containsString(texto, "AppException")) {
                    $("#error-stacktrace").text(texto.split('at ')[0]);
                } else {
                    $("#error-stacktrace").text(texto);
                }
                $("#modal-error").modal('show');
            } else {
                $("#error-message").text("Ocorreu um erro.");
                if (Main.Util.containsString(data.responseText, "AppException")) {
                    $("#error-stacktrace").text(data.responseText.split('at ')[0]);
                } else {
                    $("#error-stacktrace").text(data.responseText);
                }
                $("#modal-error").modal('show');
            }
        },alertError: function(url, msg) {
            if (msg != null && msg != undefined && Main.Util.containsString(msg, ":::")) {
                var title = msg.split(":::")[0];
                var texto = msg.split(":::")[1];

                $("#error-message").text(title);
                if (Main.Util.containsString(texto, "AppException")) {
                    $("#error-stacktrace").text(texto.split('at ')[0]);
                } else {
                    $("#error-stacktrace").text(texto);
                }
                $("#modal-error").modal('show');
            } else {
                $("#error-message").text("Ocorreu um erro.");
                if (Main.Util.containsString(msg, "AppException")) {
                    $("#error-stacktrace").text(msg.split('at ')[0]);
                } else {
                    $("#error-stacktrace").text(msg);
                }
                $("#modal-error").modal('show');
            }
        }

    }
}();

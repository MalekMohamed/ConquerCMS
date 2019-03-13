var Ajax = {

    initialize: function () {
        $.get("system.php?step=getEmulators", function (data) {


            $("#emulator").val(data);


        });
    },


    checkPhpVersion: function (onComplete) {
        $.get("system.php?step=checkPhpVersion", function (data) {
            if (data == '1')
                $('.php-version .check-result').css('color', 'green').html('OK!');
            else
                $('.php-version .check-result').addClass('error').css('color', 'red').html('Not installed.');

            if (onComplete !== undefined)
                onComplete(data == '1');
        });
    },

    checkDbConnection: function (data, onComplete) {
        $.post("system.php?step=checkDbConnection", data, function (data) {
            if (onComplete !== undefined)
                onComplete(data);
        })
    },


    checkPhpExtensions: function (onComplete) {
        $.get("system.php?step=checkPhpExtensions", function (data) {

            if (data != '1') {
                $("#php-extensions-missing .extensions").text(data).parent().show();
                $('.php-extensions .check-result').hide();
            }
            else {
                $('#php-extensions-missing').hide();
                $('.php-extensions .check-result').css('color', 'green').html('OK!').show();
            }

            if (onComplete !== undefined)
                onComplete(data);
        });
    },

    checkApacheModules: function (onComplete) {
        $.get("system.php?step=checkApacheModules", function (data) {

            if (data != '1') {
                $("#apache-modules-missing .modules").text(data).parent().show();
                $('.apache-modules .check-result').hide();
            }
            else {
                $('#apache-modules-missing').hide();
                $('.apache-modules .check-result').css('color', 'green').html('OK!').show();
            }

            if (onComplete !== undefined)
                onComplete(data);
        });
    },

    Install: {

        initialize: function () {
            $('#install').text('');

            Ajax.Install.configs( function () {
                    Ajax.Install.database( function () {
                    $.get("system.php?step=final", function (data) {
                        if (data != "success") {
                            UI.alert('Please delete or rename the "install" folder and then visit <a href="../">your site</a> again.');
                        }
                        else {
                            UI.alert('Installation successful, you will be redirect to Home page', 5000);

                            setTimeout(function () {
                                Memory.clear();
                                window.location = "../";
                            }, 5000);
                        }
                    });

                });
            });
        },

        complete: function () {
            $("#install").append("<div style='color:green;display:inline;'>done</div><br />");
        },

        configs: function (callback) {
            $("#install").append("Writing configs...");

            var data = {
                server_name: $("#server_name").val(),
                rows: $("#rows").val(),
                cms_hostname: $("#cms_hostname").val(),
                cms_username: $("#cms_username").val(),
                cms_password: $("#cms_password").val(),
                cms_database: $("#cms_database").val(),
                game_hostname: $("#game_hostname").val(),
                game_username: $("#game_username").val(),
                game_password: $("#game_password").val(),
                game_database: $("#game_database").val(),
                cms_port: $("#cms_port").val(),
                security_code: $("#security_code").val(),
                state: $("#state").val(),
                kings: $("#kings").val(),
                prince :$("#prince").val()
            };

                $.post("system.php?step=config", data, function (res) {
                    if (res != '1') {
                        UI.alert("Something went wrong: " + res);
                    }
                    else {
                        Ajax.Install.complete();
                        callback();
                    }
                });

        },

        database: function (callback) {
            $("#install").append("Creating database...");

            $.post("system.php?step=database", function (res) {
                if (res != '1') {
                    UI.alert("Something went wrong: " + res);
                }
                else {
                    Ajax.Install.complete();
                    callback();
                }
            });
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 1/27/2018
 * Time: 1:45 PM
 */
?>
<link href="<?php echo $base_url; ?>/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet"/>
<div class="row">
    <div class="col-sm-12">

        <div class="styles_userStats">
            <games-card>
                <div class="card-box">
                    <h3 class="m-t-20 m-b-20">Web Settings</h3>
                    <hr>
                    <form action="#" class="settings-form" method="post">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="server">Server Name</label>
                                <input type="text" name="site[Servername]"
                                       value="<?php echo $controller->server_name; ?>"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="server">GM State</label>
                                <input type="number" name="site[gm_state]"
                                       value="<?php echo $controller->gm_state; ?>"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="rows">Rows shown</label>
                                <input type="number" name="site[rows]"
                                       value="<?php echo $controller->rows; ?>"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="server">Game Port</label>
                                <input type="number" name="site[game_port]"
                                       value="<?php echo $controller->game_port; ?>"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="server">Status Theme</label>
                                <select name="site[status]" class="form-control">
                                    <?php if ($controller->status == 'online_offline') { ?>
                                        <option value="<?php echo $controller->status; ?>" selected>Show Online and
                                            Offline
                                        </option>
                                        <option value="online">Show Online Only</option>
                                    <?php } else { ?>
                                        <option value="<?php echo $controller->status; ?>" selected>Show Online Only
                                        </option>
                                        <option value="online_offline">Show Online and Offline</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="kings">Kings</label>
                                <input type="number" max="50" min="3" name="site[kings]"
                                       value="<?php echo $controller->kings; ?>"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="pinces">Princes</label>
                                <input type="number" max="50" min="13" name="site[prince]"
                                       value="<?php echo $controller->prince; ?>"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="server">Time Zone</label>
                                <select name="site[timezone]" class="form-control">
                                    <option value="Etc/GMT+12">(GMT-12:00) International Date Line West</option>
                                    <option value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
                                    <option value="Pacific/Honolulu">(GMT-10:00) Hawaii</option>
                                    <option value="US/Alaska">(GMT-09:00) Alaska</option>
                                    <option value="America/Los_Angeles">(GMT-08:00) Pacific Time (US & Canada)</option>
                                    <option value="America/Tijuana">(GMT-08:00) Tijuana, Baja California</option>
                                    <option value="US/Arizona">(GMT-07:00) Arizona</option>
                                    <option value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                    <option value="US/Mountain">(GMT-07:00) Mountain Time (US & Canada)</option>
                                    <option value="America/Managua">(GMT-06:00) Central America</option>
                                    <option value="US/Central">(GMT-06:00) Central Time (US & Canada)</option>
                                    <option value="America/Mexico_City">(GMT-06:00) Guadalajara, Mexico City,
                                        Monterrey
                                    </option>
                                    <option value="Canada/Saskatchewan">(GMT-06:00) Saskatchewan</option>
                                    <option value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                    <option value="US/Eastern">(GMT-05:00) Eastern Time (US & Canada)</option>
                                    <option value="US/East-Indiana">(GMT-05:00) Indiana (East)</option>
                                    <option value="Canada/Atlantic">(GMT-04:00) Atlantic Time (Canada)</option>
                                    <option value="America/Caracas">(GMT-04:00) Caracas, La Paz</option>
                                    <option value="America/Manaus">(GMT-04:00) Manaus</option>
                                    <option value="America/Santiago">(GMT-04:00) Santiago</option>
                                    <option value="Canada/Newfoundland">(GMT-03:30) Newfoundland</option>
                                    <option value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
                                    <option value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires,
                                        Georgetown
                                    </option>
                                    <option value="America/Godthab">(GMT-03:00) Greenland</option>
                                    <option value="America/Montevideo">(GMT-03:00) Montevideo</option>
                                    <option value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
                                    <option value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
                                    <option value="Atlantic/Azores">(GMT-01:00) Azores</option>
                                    <option value="Africa/Casablanca">(GMT+00:00) Casablanca, Monrovia, Reykjavik
                                    </option>
                                    <option value="Etc/Greenwich">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh,
                                        Lisbon, London
                                    </option>
                                    <option value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern, Rome,
                                        Stockholm, Vienna
                                    </option>
                                    <option value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest,
                                        Ljubljana, Prague
                                    </option>
                                    <option value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris
                                    </option>
                                    <option value="Europe/Sarajevo">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb
                                    </option>
                                    <option value="Africa/Lagos">(GMT+01:00) West Central Africa</option>
                                    <option value="Asia/Amman">(GMT+02:00) Amman</option>
                                    <option value="Europe/Athens">(GMT+02:00) Athens, Bucharest, Istanbul</option>
                                    <option value="Asia/Beirut">(GMT+02:00) Beirut</option>
                                    <option selected value="Africa/Cairo">(GMT+02:00) Cairo</option>
                                    <option value="Africa/Harare">(GMT+02:00) Harare, Pretoria</option>
                                    <option value="Europe/Helsinki">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn,
                                        Vilnius
                                    </option>
                                    <option value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
                                    <option value="Europe/Minsk">(GMT+02:00) Minsk</option>
                                    <option value="Africa/Windhoek">(GMT+02:00) Windhoek</option>
                                    <option value="Asia/Kuwait">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                                    <option value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                    <option value="Africa/Nairobi">(GMT+03:00) Nairobi</option>
                                    <option value="Asia/Tbilisi">(GMT+03:00) Tbilisi</option>
                                    <option value="Asia/Tehran">(GMT+03:30) Tehran</option>
                                    <option value="Asia/Muscat">(GMT+04:00) Abu Dhabi, Muscat</option>
                                    <option value="Asia/Baku">(GMT+04:00) Baku</option>
                                    <option value="Asia/Yerevan">(GMT+04:00) Yerevan</option>
                                    <option value="Asia/Kabul">(GMT+04:30) Kabul</option>
                                    <option value="Asia/Yekaterinburg">(GMT+05:00) Yekaterinburg</option>
                                    <option value="Asia/Karachi">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                                    <option value="Asia/Calcutta">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi
                                    </option>
                                    <option value="Asia/Calcutta">(GMT+05:30) Sri Jayawardenapura</option>
                                    <option value="Asia/Katmandu">(GMT+05:45) Kathmandu</option>
                                    <option value="Asia/Almaty">(GMT+06:00) Almaty, Novosibirsk</option>
                                    <option value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</option>
                                    <option value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option>
                                    <option value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                    <option value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                                    <option value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi
                                    </option>
                                    <option value="Asia/Kuala_Lumpur">(GMT+08:00) Kuala Lumpur, Singapore</option>
                                    <option value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                    <option value="Australia/Perth">(GMT+08:00) Perth</option>
                                    <option value="Asia/Taipei">(GMT+08:00) Taipei</option>
                                    <option value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                    <option value="Asia/Seoul">(GMT+09:00) Seoul</option>
                                    <option value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
                                    <option value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
                                    <option value="Australia/Darwin">(GMT+09:30) Darwin</option>
                                    <option value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
                                    <option value="Australia/Canberra">(GMT+10:00) Canberra, Melbourne, Sydney</option>
                                    <option value="Australia/Hobart">(GMT+10:00) Hobart</option>
                                    <option value="Pacific/Guam">(GMT+10:00) Guam, Port Moresby</option>
                                    <option value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
                                    <option value="Asia/Magadan">(GMT+11:00) Magadan, Solomon Is., New Caledonia
                                    </option>
                                    <option value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</option>
                                    <option value="Pacific/Fiji">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                    <option value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group" data-toggle="tooltip" data-placement="bottom"
                             data-original-title="Security Code">
                            <label for="pinces">Security Code</label>
                            <input type="text" name="site[Security_code]" class="code-secure form-control"
                                   value="<?php echo $controller->Security_code; ?>">
                            <span class="input-group-btn">
                                                    <button type="button" style="    margin-bottom: -25px;"
                                                            class="btn waves-effect waves-light btn-danger btn-random"><i
                                                                class="fa fa-random"></i> Random</button>
                                                    </span>
                        </div>
                        <h3 class="m-t-20 m-b-20">Vote</h3>
                        <hr>
                        <div class="form-group">
                            <label for="rows">Vote Rewards</label>
                            <select name="site[enableVote]" class="form-control">
                                <?php if ($controller->enableVote == true) { ?>
                                    <option value="true" selected>True
                                    </option>
                                    <option value="false">false</option>
                                <?php } else { ?>
                                    <option value="false" selected>false
                                    </option>
                                    <option value="true">True</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="reward">CPS per vote</label>
                            <input type="number" name="site[vote_reward]"
                                   value="<?php echo $controller->vote_reward; ?>"
                                   class="form-control">
                        </div>

                        <div class="form-group" data-toggle="tooltip"
                             data-placement="top"
                             data-original-title="This will make the Vote limited 1 per 12 Hours">
                            <label for="server">Vote Limit By</label>
                            <select name="site[voteRule]" class="form-control">
                                <?php if ($controller->voteRule == 'user') { ?>
                                    <option value="<?php echo $controller->voteRule; ?>" selected>User
                                    </option>
                                    <option value="ip">IP</option>
                                <?php } else { ?>
                                    <option value="<?php echo $controller->voteRule; ?>" selected>IP
                                    </option>
                                    <option value="user">User</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="link">Vote Link</label>
                            <input type="url" name="site[Vote_link]"
                                   value="<?php echo $controller->vote_link; ?>"
                                   class="form-control">
                        </div>
                        <h3 class="m-t-20 m-b-20">reCaptcha</h3>
                        <hr>
                        <div class="form-group">
                            <label for="rows">reCaptcha Enable</label>
                            <select name="recaptcha[enable]" class="form-control">
                                <option selected value="true">True</option>
                                <option value="false">False</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rows">reCaptcha Public Key</label>
                            <input type="text" name="recaptcha[public]"
                                   value="<?php echo $controller->reCaptcha['public_key']; ?>"
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="rows">reCaptcha Secret Key</label>
                            <input type="text" name="recaptcha[secret]"
                                   value="<?php echo $controller->reCaptcha['secret_key']; ?>"
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="rows">Theme</label>
                            <select name="recaptcha[theme]" class="form-control">
                                <option selected value="dark">Dark</option>
                                <option value="light">Light</option>
                            </select>
                        </div>
                        <h3 class="m-t-20 m-b-20">Social links</h3>
                        <hr>
                        <div class="form-group">
                            <label for="rows">Facebook</label>
                            <input type="url" name="Social[Facebook]"
                                   value="<?php echo $controller->Facebook; ?>"
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="rows">Support Email</label>
                            <input type="email" name="site[Support_mail]"
                                   value="<?php echo $controller->email; ?>"
                                   class="form-control">
                        </div>
                        <h3 class="m-t-20 m-b-20">Download links</h3>
                        <hr>
                        <div class="form-group">
                            <label for="rows">Client</label>
                            <input type="url" name="downloads[Client]"
                                   value="<?php echo $controller->client; ?>"
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="rows">Patch</label>
                            <input type="url" name="downloads[Patch]"
                                   value="<?php echo $controller->patch; ?>"
                                   class="form-control">
                        </div>
                        <script>
                            function rebuiltConfig() {
                                $.ajax({
                                    url: base_url + "/save.php?save=rewriteConfig",
                                    success: function (res) {
                                        var json_res = $.parseJSON(res);
                                        $.Notification.notify(json_res.status, 'bottom left', 'Saved', json_res.msg);
                                        if (json_res.status == 'success') {
                                            window.setTimeout(function () {
                                                window.location.href = window.location;
                                            }, 1000);
                                        }
                                    }
                                });
                            }
                        </script>
                        <system-message style="background-color: transparent;border-color:transparent ">
                            <button type="submit" class="btn btn-pulse waves-effect waves-light ">
                                                   <span class="btn-label"><i class="fa fa-save"></i>
                                                   </span>Save Web Settings
                            </button>
                            <a class="btn btn-danger waves-effect waves-light" onclick="rebuiltConfig();">
                                                   <span class="btn-label"><i class="fa fa-recycle"></i>
                                                   </span>Rewrite Config
                            </a>
                        </system-message>
                    </form>

                </div>
            </games-card>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-20 m-b-20">Themes</h4>
            <script>
                function activeTheme(name, element) {
                    $.ajax({
                        type: 'post',
                        url: base_url + "/save.php?save=theme",
                        data: {theme: name},
                        success: function (res) {
                            var json_res = $.parseJSON(res);
                            if (json_res.status == 'success') {
                                $('.current-theme').removeClass('btn-danger');
                                $('.current-theme').addClass('btn-default');
                                $('.current-theme').html('<i class="fa fa-check"></i>');
                                $(element).removeClass('btn-default');
                                $(element).html('<i class="md md-verified-user"></i>');
                                $(element).addClass('btn-danger');
                                $(element).addClass('current-theme');
                            }
                            $.Notification.notify(json_res.status, 'bottom left', 'Update', json_res.msg);
                        }
                    });
                }
            </script>
            <div class="table-rep-plugin">
                <div class="table-responsive" data-pattern="priority-columns">
                    <table id="datatable" class="table table-bordered">
                        <!-- table head -->
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Screenshot</th>
                            <th>Designer</th>
                            <th>Date</th>
                            <th>action</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $Path = '../public/themes';
                        $dirs = glob($Path . '/*', GLOB_ONLYDIR);
                        $i = 1;
                        foreach ($dirs as $file) {
                            if (file_exists($file . '/manifest.json')) {
                                $json = json_decode(file_get_contents($file . '/manifest.json'));
                            } else {
                                $json = (object)array(
                                    'name' => 'ConquerHub',
                                    'author' => 'Malek Mohamed',
                                    'screenshot' => 'images/screenshot.jpg'
                                );
                            }
                            ?>
                            <tr id="themes-<?php echo $i; ?>" class="text-center">
                                <td><?php echo $json->name; ?></td>
                                <td><img style="width: 133px;height: 133px"
                                         src="<?php echo $file; ?>/<?php echo $json->screenshot; ?>"></td>
                                <td><?php echo $json->author; ?></td>
                                <td><?php echo date("d-M-Y h:ia", filemtime($file)); ?></td>
                                <td>
                                    <?php
                                    if (basename($file) == $app->theme) { ?>
                                        <button style=" margin-top: 50px;" type="button"
                                                class="btn btn-danger waves-effect current-theme"><i
                                                    class="md md-verified-user"></i>
                                        </button>
                                    <?php } else { ?>
                                        <button style=" margin-top: 50px;" type="button"
                                                onclick="activeTheme('<?php echo basename($file); ?>',this);"
                                                class="btn btn-default waves-effect"><i class="fa fa-check"></i>
                                        </button>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- end Card -->

    </div>

</div>

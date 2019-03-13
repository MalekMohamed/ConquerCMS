<div class="row">
    <div class="col-md-4 col-lg-4 col-xl-3">
        <div class="widget-bg-color-icon card-box fadeInDown animated">
            <div class="bg-icon bg-icon-info pull-left">
                <i class="fa fa-arrow-up text-info"></i>
            </div>
            <div class="text-right">
                <h3 class=""><b class="counter"><?php echo number_format($controller->get_users()); ?></b></h3>
                <p class="text-muted mb-0">Total Accounts</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-md-4 col-lg-4 col-xl-3">
        <div class="widget-bg-color-icon card-box fadeInDown animated">
            <div class="bg-icon bg-icon-success pull-left">
                <i class="md  md-vpn-key text-success"></i>
            </div>
            <div class="text-right">
                <h3 class=""><b class="counter"><?php echo number_format($controller->get_online()[0]); ?></b></h3>
                <p class="text-muted mb-0">Total Online</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-md-4 col-lg-4 col-xl-3">
        <div class="widget-bg-color-icon card-box fadeInDown animated">
            <div class="bg-icon bg-icon-warning pull-left">
                <i class="fa fa-users text-warning"></i>
            </div>
            <div class="text-right">
                <h3 class=""><b class="counter"><?php echo number_format($controller->count_chars()); ?></b></h3>
                <p class="text-muted mb-0">Total Characters</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <form method="post" action="#" class="search-form">
                <div class="styles_textField_1fEl">
                    <input type="text" name="search_input" class="form-control" value="<?php echo $_POST['search_input']; ?>" required
                           placeholder="Enter Username, Character name...">
                </div>
                <div class="styles_textField_1fEl">
                    <select class="form-control" name="search_by">
                        <option>Choose</option>
                        <option <?php if ($_POST['search_by'] == 'Username') {
                            echo 'selected';
                        } ?> value="Username">Username
                        </option>
                        <option <?php if ($_POST['search_by'] == 'Character') {
                            echo 'selected';
                        } ?> value="Character">Character
                        </option>
                    </select>
                </div>
                <div class="styles_actions-container button-list">
                    <button type="submit" name="search" class="btn btn-success" data-toggle="tooltip"
                            data-placement="right"
                            data-original-title="Click to search"><i class="fa fa-search m-r-5"></i> <span>Search</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="styles_userStats table-responsive search-result">
            <games-card>
                <div class="card-box">
                    <?php
                    if (isset($_POST['search'])) {
                        if ($_POST['search_by'] == 'Character' && isset($_POST['search_input'])) {
                            $character = $controller->get_chars_by_name($_POST['search_input']);
                            if (!empty($character)) {
                                ?>
                                <div class="table-rep-plugin">
                                    <div class="table-responsive" data-pattern="priority-columns">
                                        <table id="datatable" class="table table-bordered">
                                            <!-- table head -->
                                            <thead>
                                            <tr>
                                                <th>Character name</th>
                                                <th>EntityID</th>
                                                <th>Owner</th>
                                                <th>CPS</th>
                                                <th>Level</th>
                                                <th>Class</th>
                                                <th>VIP</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr id="characters" class="text-center">
                                                <td><?php echo $character['Name']; ?></td>
                                                <td><?php echo $character['UID']; ?></td>
                                                <td><?php echo $character['Owner']; ?></td>
                                                <td><?php echo number_format($character['ConquerPoints']); ?></td>
                                                <td><?php echo $character['Level']; ?></td>
                                                <td><?php echo $controller->Classes($character['Class']); ?></td>
                                                <td><?php echo $character['VIPLevel']; ?></td>

                                                <td>
                                                    <a data-toggle="tooltip" data-placement="top" title=""
                                                       data-animation="fadein"
                                                       data-user="<?php echo $character['Owner']; ?>"
                                                       data-plugin="custommodal" data-overlayspeed="200"
                                                       data-overlaycolor="#36404a" href=".remove-user-row"
                                                       data-original-title="Remove User"
                                                       class="btn-danger btn on-default remove-user-button"><i
                                                                class="fa fa-trash-o"></i></a>
                                                    <a data-toggle="tooltip" data-placement="top" title=""
                                                       data-animation="fadein"
                                                       data-user="<?php echo $character['Owner']; ?>"
                                                       data-plugin="custommodal" data-overlayspeed="200"
                                                       data-overlaycolor="#36404a" href=".edit-user-row"
                                                       data-original-title="Edit User"
                                                       class="btn-default btn on-default edit-user-button"><i
                                                                class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <system-message style="display: block;">Character not found</system-message>
                                <?php
                            }
                        } elseif ($_POST['search_by'] == 'Username' && isset($_POST['search_input'])) {
                            $account = $controller->get_user_by_name($_POST['search_input']);
                            if (!empty($account)) {
                                ?>
                                <div class="table-rep-plugin">
                                    <div class="table-responsive" data-pattern="priority-columns">
                                        <table class="table table-bordered">
                                            <!-- table head -->
                                            <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Email</th>
                                                <th>Question</th>
                                                <th>Answer</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr id="Accountes" class="text-center">
                                                <td><?php echo $account['Username']; ?></td>
                                                <td><?php echo $account['Password']; ?></td>
                                                <td><?php echo $account['Email']; ?></td>
                                                <td><?php echo $account['Question']; ?></td>
                                                <td><?php echo $account['Answer']; ?></td>

                                                <td>
                                                    <a data-toggle="tooltip" data-placement="top" title=""
                                                       data-animation="fadein"
                                                       data-user="<?php echo $account['Username']; ?>"
                                                       data-plugin="custommodal" data-overlayspeed="200"
                                                       data-overlaycolor="#36404a" href=".remove-user-row"
                                                       data-original-title="Remove User"
                                                       class="btn-danger btn on-default remove-user-button"><i
                                                                class="fa fa-trash-o"></i></a>
                                                    <a data-toggle="tooltip" data-placement="top" title=""
                                                       data-animation="fadein"
                                                       data-user="<?php echo $account['Username']; ?>"
                                                       data-plugin="custommodal" data-overlayspeed="200"
                                                       data-overlaycolor="#36404a" href=".edit-user-row"
                                                       data-original-title="Edit User"
                                                       class="btn-default btn on-default edit-user-button"><i
                                                                class="fa fa-edit"></i></a>

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            <?php } else { ?>
                                <system-message style="display: block;">User not found</system-message>
                                <?php
                            }
                        }
                        ?>

                    <?php } ?>
                </div>
            </games-card>

        </div>
    </div>

</div>



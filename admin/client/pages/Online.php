<?php
/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 7/29/2018
 * Time: 3:23 PM
 */
?>
<div class="row">
    <div class="col-sm-12">

        <div class="styles_userStats">
            <games-card>
                <div class="card-box">
                    <h3 class="m-t-20 m-b-20">Total Online ( <?php echo number_format($controller->GetOnline()[1]);?> )</h3>
                    <table class="table table-bordered">
                        <!-- table head -->
                        <thead>
                        <tr>
                            <th>Character</th>
                            <th>Owner</th>
                            <th>ConquerPoints</th>
                            <th>Class</th>
                            <th>MAP</th>
                            <th></th>
                            <th style="display:none;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($controller->GetOnline()[0] as $character) {
                            ?>
                            <tr id="character-<?php echo $character['UID'];?>" class="text-center">
                                <td><?php echo $character['Name']; ?></td>
                                <td><?php echo $character['Owner']; ?></td>
                                <td><?php echo $character['ConquerPoints']; ?></td>
                                <td><?php echo $controller->Classes($character['Class']); ?></td>
                                <td data-map="<?php echo $character['MapID'];?>"><?php echo Controller::MapID($character['MapID']); ?></td>
                                <td style="display:none;"><?php echo $character['MapID']; ?></td>
                                <td>
                                    <a data-toggle="tooltip" data-placement="top" title=""
                                       data-animation="fadein"
                                       data-user="<?php echo $character['Owner']; ?>"
                                       data-character="<?php echo $character['Name']; ?>"
                                       data-plugin="custommodal" data-overlayspeed="200"
                                       data-overlaycolor="#36404a" href=".remove-char-row"
                                       data-original-title="Remove User"
                                       class="btn-danger btn on-default remove-char-button"><i
                                            class="fa fa-trash-o"></i></a>
                                    <a data-toggle="tooltip" data-placement="top" title=""
                                       data-animation="fadein"
                                       data-user="<?php echo $character['Owner']; ?>"
                                       data-character="<?php echo $character['Name']; ?>"
                                       data-plugin="custommodal" data-overlayspeed="200"
                                       data-overlaycolor="#36404a" href=".edit-user-row"
                                       data-original-title="Edit User"
                                       class="btn-default btn on-default edit-user-button"><i
                                            class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </games-card>

        </div>

    </div>

</div>
<div class="modal-demo text-left remove-user-row">
    <div class="custom-modal-dialog">
        <div class="custom-modal-content">
            <div class="custom-modal-header">

                <button type="button" class="close" onclick="Custombox.close();"
                        aria-hidden="true">×
                </button>
                <h4 class="custom-modal-title">Remove User Modal
                </h4>
            </div>

            <div class="custom-modal-text">
                <form action="" method="POST" class="remove-user-form">
                    <input id="remove-user" name="user" type="hidden" value="">
                    <input id="remove-character" name="char" type="hidden" value="">
                    Are you sure you want Remove this User ( <a class="remove-user"></a>
                    ) ? <br>
                    <h3 class="text-danger">Remember this cannot be Undone</h3>

            </div>
            <div class="panel-footer">
                <button type="submit"
                        class="btn btn-danger waves-effect waves-light"><i
                        class="fa fa-trash"></i> Remove
                </button>
                </form>
                <button type="button" class="btn btn-default waves-effect pull-right "
                        onclick="Custombox.close();"><i class="fa fa-times"></i> Close
                </button>

            </div>

        </div>
    </div>
</div>
<div class="modal-demo text-left edit-user-row">
    <div class="custom-modal-dialog">
        <div class="custom-modal-content">
            <div class="custom-modal-header">

                <button type="button" class="close" onclick="Custombox.close();"
                        aria-hidden="true">×
                </button>
                <h4 class="custom-modal-title">Edit User Modal
                </h4>
            </div>
            <div class="custom-modal-text">
                <form action="#" method="POST" class="edit-user-form">
                    <input type="hidden" name="request" value="Update">
                    <input type="hidden" name="Username" id="user">
                    <input type="hidden" name="EntityID" id="uid">
                    <div class="form-group">
                        <label for="userName">User Name</label>
                        <input type="text" disabled class="form-control" id="username">
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="text" name="Password" class="form-control" value="" id="Password">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" name="Email" class="form-control" value="" id="Email">
                    </div>
                    <div class="form-group">
                        <label for="Question">Question</label>
                        <input type="text" name="Question" class="form-control" value="" id="Question">
                    </div>
                    <div class="form-group">
                        <label for="Answer">Answer</label>
                        <input type="text" name="Answer" class="form-control" value="" id="Answer">
                    </div>
                    <div class="form-group">
                        <label for="State">State</label>
                        <input type="number" name="State" class="form-control" step="1" value="" id="State">
                    </div>
                    <div class="form-group">
                        <label for="Credit">CreditAmount</label>
                        <input type="number" name="CA" class="form-control" step="1" value="" id="Credit">
                    </div>
                    <section id="character" style="display: none">
                        <h3 class="m-t-20 m-b-20">Character</h3>
                        <hr>
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" name="Name" class="form-control" value="" id="Name">
                        </div>
                        <div class="form-group">
                            <label for="CPS">CPS</label>
                            <input type="number" name="ConquerPoints" step="1" class="form-control" value="" id="CPS">
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <input type="number" max="140" min="1" name="Level" step="1" class="form-control" value=""
                                   id="level">
                        </div>
                        <div class="form-group">
                            <label for="VIPLevel">VIPLevel</label>
                            <input type="number" max="6" min="0" name="VIPLevel"step="1" class="form-control" value=""
                                   id="VIPLevel">
                        </div>
                        <div class="form-group">
                            <label for="VIPCredit">VIP Credit Hours</label>
                            <input type="number" name="VIPCredit" class="form-control" step="1" value="" id="VIPCredit">
                        </div>
                    </section>
            </div>

            <div class="panel-footer">

                <button type="submit"
                        class="btn btn-primary waves-effect waves-light"><i
                        class="fa fa-save"></i> Save
                </button>
                </form>
                <button type="button" class="btn btn-danger waves-effect pull-right "
                        onclick="Custombox.close();"><i class="fa fa-times"></i> Close
                </button>

            </div>

        </div>
    </div>
</div>

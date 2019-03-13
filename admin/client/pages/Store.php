<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-15 m-b-15">
            <a data-toggle="tooltip" data-placement="left" title=""
               data-animation="fadein" data-plugin="custommodal" data-overlayspeed="200"
               data-overlaycolor="#36404a" href=".add-item"
               data-original-title="Add Item" class="btn btn-default dropdown-toggle waves-effect waves-light"><i class="fa fa-plus"></i> Add new item</a>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-sm-12">
            <div class="styles_userStats">
                <games-card>
                    <div class="card-box">
                        <h3 class="m-t-20 m-b-20">Store items</h3>
                        <table  id="datatable" class="table table-bordered">
                            <!-- table head -->
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($controller->get_store_items() as $items) {
                            ?>
                            <tr id="item-<?php echo $items['id'];?>" class="text-center">
                                <td><?php echo $items['id']; ?></td>
                                <td><?php echo $items['Name']; ?></td>
                                <td><?php echo $items['price']; ?></td>
                                <td>
                                    <a data-toggle="tooltip" data-placement="top" title=""
                                       data-animation="fadein"
                                       data-name="<?php echo $items['Name']; ?>"
                                       data-item_id="<?php echo $items['id']; ?>"
                                       data-plugin="custommodal" data-overlayspeed="200"
                                       data-overlaycolor="#36404a" href=".remove-item-row"
                                       data-original-title="Remove Item"
                                       class="btn-danger btn on-default remove-item-button"><i
                                                class="fa fa-trash-o"></i></a>

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
<div class="modal-demo text-left remove-item-row">
    <div class="custom-modal-dialog">
        <div class="custom-modal-content">
            <div class="custom-modal-header">

                <button type="button" class="close" onclick="Custombox.close();"
                        aria-hidden="true">×
                </button>
                <h4 class="custom-modal-title">Remove Item Modal
                </h4>
            </div>

            <div class="custom-modal-text">
                <form action="" method="POST" class="remove-item-form">
                    <input id="remove-item" name="id" type="hidden" value="">
                    Are you sure you want Remove this item ( <a class="remove-item"></a>
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
<div class="modal-demo text-left add-item">
    <div class="custom-modal-dialog">
        <div class="custom-modal-content">
            <div class="custom-modal-header">

                <button type="button" class="close" onclick="Custombox.close();"
                        aria-hidden="true">×
                </button>
                <h4 class="custom-modal-title">Add Item Modal
                </h4>
            </div>

            <div class="custom-modal-text">
                <form action="" method="POST" class="add-item-form" novalidate enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="userName">Item Name<span class="text-danger">*</span></label>
                        <input type="text" name="name" parsley-trigger="change" required="" placeholder="Enter item name" class="form-control" id="item_name">
                    </div>
                    <div class="form-group">
                        <label for="userName">Price<span class="text-danger">*</span></label>
                        <input type="number" name="price" parsley-trigger="change" required="" placeholder="ex: 10.00" class="form-control" id="price">
                    </div>
                    <div class="form-group">
                        <label for="userName">Paypal Key<span class="text-danger">*</span></label>
                        <input type="text" name="key" parsley-trigger="change" required="" placeholder="EX : P5MBRGSM5YAL8" class="form-control" id="key">
                    </div>
                    <div class="form-group">
                        <label for="userName">Description</label>
                        <textarea name="desc" placeholder="Add 1kk CPS in your Character" class="form-control" id="desc"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="userName">Image</label>
                        <input type="file" name="image" class="form-control fileupload">
                    </div>
            </div>

            <div class="panel-footer">

                <button type="submit"
                        class="btn btn-primary waves-effect waves-light"><i
                            class="fa fa-plus"></i> Add
                </button>
                </form>
                <button type="button" class="btn btn-danger waves-effect pull-right "
                        onclick="Custombox.close();"><i class="fa fa-times"></i> Close
                </button>

            </div>

        </div>
    </div>
</div>
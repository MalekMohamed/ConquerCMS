<?php page_header('Support Page'); ?>

                        <div class="post">
                            <h3 align="center"> Are you experiencing issues?</h3>
                        <table style="width:100%">
                            <tbody>

                            <tr>
                                <td width="50%">
                                    <h4> I can access my account</h4>
                                    <h5>For any issues you are having, you can submit a ticket through our support page
                                        using the button below.</h5>
                                    <br>
                                    <a href="<?php echo $app->BASE_URL('Support/Tickets/All/'); ?>" class="nice_button"> Go To Support Ticket Page</a>
                                </td>

                                <td width="50%">
                                    <h4>I can't access my account</h4>
                                    <h5>If you are unable to access your account to submit a support ticket you may
                                        either
                                        use an alternate account, or contact us via email. </h5>
                                    <br>
                                    <h5>Email: <?php echo $app->email; ?></h5>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
              <?php page_footer();?>
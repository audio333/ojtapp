<!-- Table    -->
            <!-- <table class="table table-striped bordered" id="myTable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="userData">
                 <?php
                        include 'DB.php';
                        $db = new DB();
                        $users = $db->getRows('users',array('order_by'=>'id DESC'));
                        if(!empty($users)): $count = 0; foreach($users as $user): $count++;
                    ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['phone']; ?></td>
                        <td><?php echo $user['created']; ?></td>
                        <td><?php echo ($user['status'] == 1)?'Active':'Inactive'; ?></td>
                        <td>
                            <a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editUser('<?php echo $user['id']; ?>')"></a>
                            <a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?userAction('delete','<?php echo $user['id']; ?>'):false;"></a>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="5">No user(s) found......</td></tr>
                    <?php endif; ?> 
                </tbody>
            </table> -->
        <!-- End Table    -->
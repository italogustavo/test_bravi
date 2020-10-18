<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">People Contacts Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('people_contact/add?people_id='.$this->input->get('people_id')); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>People Id</th>
						<th>Phone</th>
						<th>Whatsapp</th>
						<th>Email</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($people_contacts as $p){ ?>
                    <tr>
						<td><?php echo $p['id']; ?></td>
						<td><?php echo $p['people_id']; ?></td>
						<td><?php echo $p['phone']; ?></td>
						<td><?php echo $p['whatsapp']; ?></td>
						<td><?php echo $p['email']; ?></td>
						<td>
                            <a href="<?php echo site_url('people_contact/edit/'.$p['id'].'?people_id='.$this->input->get('people_id')); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('people_contact/remove/'.$p['id'].'?people_id='.$this->input->get('people_id')); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>         
            </div>
        </div>
    </div>
</div>

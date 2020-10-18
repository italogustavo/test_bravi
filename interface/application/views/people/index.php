<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Peoples Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('people/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Fullname</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($peoples as $p){ ?>
                    <tr>
						<td><?php echo $p['id']; ?></td>
						<td><?php echo $p['fullname']; ?></td>
						<td>
                            <a href="<?php echo site_url('people_contact/?people_id='.$p['id']); ?>" class="btn btn-primary btn-xs"><span class="fa fa-address-book-o"></span> Contacts</a>
                            <a href="<?php echo site_url('people/edit/'.$p['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('people/remove/'.$p['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>

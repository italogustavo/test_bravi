<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">People Contact Add</h3>
            </div>
            <?php echo form_open('people_contact/add?people_id='.$this->input->get('people_id')); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="people_id" class="control-label">People</label>
						<div class="form-group">
							<select name="people_id" class="form-control">
								<option value="">select people</option>
								<?php 
								foreach($all_peoples as $people)
								{
									$selected = ($people['id'] == $this->input->get('people_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$people['id'].'" '.$selected.'>'.$people['fullname'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="phone" class="control-label">Phone</label>
						<div class="form-group">
							<input type="text" name="phone" value="<?php echo $this->input->post('phone'); ?>" class="form-control" id="phone" />
							<span class="text-danger"><?php echo form_error('phone');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="whatsapp" class="control-label">Whatsapp</label>
						<div class="form-group">
							<input type="text" name="whatsapp" value="<?php echo $this->input->post('whatsapp'); ?>" class="form-control" id="whatsapp" />
							<span class="text-danger"><?php echo form_error('whatsapp');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="email" class="control-label">Email</label>
						<div class="form-group">
							<input type="text" name="email" value="<?php echo $this->input->post('email'); ?>" class="form-control" id="email" />
							<span class="text-danger"><?php echo form_error('email');?></span>
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>
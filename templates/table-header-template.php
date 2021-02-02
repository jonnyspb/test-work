<?php
$users = count_users();
$active_role = $users['avail_roles'];
?>
<section class="content--section">
	        <div class="section--header">
	            <div class="section--title">
	                <h2>Table of Users</h2>
	            </div>
	            <div class="section--controls">
	                <div class="section--controls_name">
	                    Filter by Role
	                </div>
	                <select name="select" id="table_filter_role">
	                    <option value="">All</option>
				        <?php
				        foreach ( $active_role as $role => $value) {
					        if ( $role == 'none' ) continue;
					        echo '<option value="' . $role . '">'. $role.'</option>';
				        }
				        ?>
	                </select>
	            </div>
	        </div>
	        <div class="section--body">
	            <div class="section--table" id="users_table" data-sortby="display_name">
	                <div class="section--table_header">
	                    <div class="section--table_row">
	                        <div class="section--table_col icon--sort active" data-orderby="display_name" data-order="ASC" >
	                            <div class="section--col_title">Display Name</div>
	                            <div class="section--col_icon">
	                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
	                                    <path d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41zm255-105L177 64c-9.4-9.4-24.6-9.4-33.9 0L24 183c-15.1 15.1-4.4 41 17 41h238c21.4 0 32.1-25.9 17-41z"/>
	                                </svg>
	                            </div>
	                        </div>
	                        <div class="section--table_col icon--sort" data-orderby="email" data-order="ASC">
	                            <div class="section--col_title">Email</div>
	                            <div class="section--col_icon">
	                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
	                                    <path d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41zm255-105L177 64c-9.4-9.4-24.6-9.4-33.9 0L24 183c-15.1 15.1-4.4 41 17 41h238c21.4 0 32.1-25.9 17-41z"/>
	                                </svg>
	                            </div>
	                        </div>
	                        <div class="section--table_col">
	                            <div class="section--col_title">Role</div>
	                        </div>
	                    </div>
	                </div>
	                <div class="section--table_body">
	                    <?php load_template( dirname( __FILE__ ) . '/table-content-template.php'); ?>
	                </div>
	            </div>
	        </div>
	        <div class="section--footer">
	            <span>*Information reference to go here</span>
	        </div>
</section>
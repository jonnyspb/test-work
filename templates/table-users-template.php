<?php

$page = $_POST['page'] ?: 1;
$orderby = $_POST['orderby'] ?: 'display_name';
$order = $_POST['order'] ?: 'ASC';
$role = $_POST['role'];

$user_query = new WP_User_Query( array (
	'orderby'   => $orderby,
	'order'     => $order,
	'number'    => 10,
	'paged'     => $page,
	'role'      => $role,
));

$users = $user_query -> get_results();
$total_users = $user_query -> get_total();

if ( $total_users % 10 == 0 ) {
    $pages = $total_users / 10 ;
}

else {
    $pages = floor( $total_users / 10 ) + 1;
}
?>
<div class="section--table_row_list">
    <?php
    foreach ( $users as $user ) {
        echo '<div class="section--table_row">
                <div class="section--table_col">' . $user -> display_name . '</div>
                <div class="section--table_col">' . $user -> user_email . '</div>
                <div class="section--table_col">' . $user -> roles[0] . '</div>
               </div>';
    }
    ?>
</div>

<?php if ( $pages > 1 ) {
    ?>
    <div class="section--paginations">
	    <?php for ( $i = 1; $i <= $pages; $i++ ) {
		        if ( $page == $i ) {
		            $active = 'active';
		        }
		        else $active = '';
		        echo '<div class="section--pagination_page '.$active.'" data-page="' . $i . '">' . $i . '</div>';
	    } ?>
    </div>
<?php }
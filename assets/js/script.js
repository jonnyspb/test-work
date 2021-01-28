jQuery(document).ready(function($) {
    let $users_table = $( '#users_table' ),
        $table_body = $( '.section--table_body' );
    $( '#users_table .icon--sort' ).on('click', function ( e ) {
        let order = $( this ).attr('order' );
        let orderby = $( this ).attr('orderby' );
            if ( order == "ASC" ) {
                order = "DESC";
                $( this ).attr( "order" , order );
            }
            else if ( order == "DESC" ) {
                order = "ASC";
                $( this ).attr( "order" , order );
            }
        $users_table.attr('sortby', orderby );
        $users_table.attr('sort', order );
        let data = {
            action:'users_table_ajax',
            page:$users_table.attr('page') || 1,
            order:order,
            orderby:orderby,
            role:$users_table.attr('role'),
        };
        $.post( ajax_front.url, data, function ( response ) {
            $table_body.html(response);
        });
    });
    $( '#users_table .section--table_body' ).on('click', function ( e ) {
        let page = $( e.target ).attr('page' );
        let data = {
            action:'users_table_ajax',
            page:page,
            order:$users_table.attr('sort'),
            orderby:$users_table.attr('sortby' ),
            role:$users_table.attr('role' ),
        };
        $users_table.attr('page', page );

        $.post( ajax_front.url, data, function ( response ) {
            $table_body.html( response );
        });
    });
    $( "#table_filter_role" ).change(function() {
        let role = $( "option:selected" ).val();
        let data = {
            action:'users_table_ajax',
            role:role,
        };
        $users_table.attr('role', role );
        $.post(ajax_front.url, data, function ( response ) {
            $table_body.html( response );
        });
    });
});

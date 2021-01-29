jQuery(document).ready(function($) {
    let $users_table = $( '#users_table' ),
        $table_body = $( '.section--table_body' );
    $( '#users_table .icon--sort' ).on('click', function ( e ) {
        let order = $( this ).attr('data-order' );
        let orderby = $( this ).attr('data-orderby' );

        if ( order == "ASC" ) {
            order = "DESC";
            $( this ).attr( "data-order" , order );
        }
        else if ( order == "DESC" ) {
            order = "ASC";
            $( this ).attr( "data-order" , order );
        }
        $( "[data-orderby=" + $users_table.attr('data-sortby') + "]" ).removeClass( "active" );
        $( this ).addClass( "active" );
        $users_table.attr('data-sortby', orderby );
        $users_table.attr('data-sort', order );
        let data = {
            action:'users_table_ajax',
            page:$users_table.attr('data-page') || 1,
            order:order,
            orderby:orderby,
            role:$users_table.attr('data-role'),
        };
        $.post( ajax_front.url, data, function ( response ) {
            $table_body.html(response);
        });
    });
    $( '#users_table .section--table_body' ).on('click', function ( e ) {
        let page = $( e.target ).attr('data-page' );
        let data = {
            action:'users_table_ajax',
            page:page,
            order:$users_table.attr('data-sort'),
            orderby:$users_table.attr('data-sortby' ),
            role:$users_table.attr('data-role' ),
        };
        $users_table.attr('data-page', page );

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
        $users_table.attr('data-sortby','display_name');
        $users_table.attr('data-sort','ASC');
        $( "[data-orderby=email]" ).removeClass( "active" );
        $( "[data-orderby=display_name]" ).addClass( "active" );
        $users_table.attr('data-role', role );
        $.post(ajax_front.url, data, function ( response ) {
            $table_body.html( response );
        });
    });
});

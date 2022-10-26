jQuery( document ).ready(
    function ( $ ) {
        $( '.js-vote-answer button' ).click( function ( e ) {
            e.preventDefault();
            //Todo verifier si le fichier a post qui fonctionne
            console.log( 'test' );
            let directionVote = $( e.currentTarget ).data( 'direction' );
            let questionId    = $( e.currentTarget ).data( 'id' );
            let logVote       = $( e.currentTarget ).parent().find( '.total-vote' );
            if ( directionVote === 'up' ) {
                $( e.currentTarget ).toggleClass( 'hidden' );
            }

            $.post(
                '/answers/' + questionId + '/vote',
                {
                    direction: directionVote,
                },
                function ( response ) {
                    console.log( response );
                    logVote.text( response.votes );
                },
            );

            /*            $.ajax({
             type: "POST",
             url: '/questions/' + questionId + '/vote',
             data: '{"direction":"' + directionVote +'"}',
             contentType: "application/json; charset=utf-8",
             dataType: "json",
             success: function(data) {
             alert(data.votes);
             },
             error: function(data){
             alert("fail");
             }
             });*/
        } );

    },
);

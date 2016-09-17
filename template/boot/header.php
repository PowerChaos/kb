<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="PowerChaos">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Knowledge Base</title>

<!-- JQuery -->
	<script   src="http://code.jquery.com/jquery-1.12.3.js"   integrity="sha256-1XMpEtA4eKXNNpXcJ1pmMPs8JV+nwLdEqwiJeCQEkyc="   crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="//<?php echo $_SERVER['SERVER_NAME']?>/template/boot/js/jquery.ui.shake.js"></script>
<!-- bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- moment -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
<!-- Datatables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/bs-3.3.6/jq-2.2.0,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.11,af-2.1.1,b-1.1.2,b-colvis-1.1.2,b-flash-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,fc-3.2.1,fh-3.1.1,kt-2.1.1,r-2.0.2,rr-1.1.1,sc-1.4.1,se-1.1.2/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/t/bs-3.3.6/jq-2.2.0,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.11,af-2.1.1,b-1.1.2,b-colvis-1.1.2,b-flash-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,fc-3.2.1,fh-3.1.1,kt-2.1.1,r-2.0.2,rr-1.1.1,sc-1.4.1,se-1.1.2/datatables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.12/dataRender/ellipsis.js"></script>

<!-- Tree -->
<link href="//<?php echo $_SERVER['SERVER_NAME']?>/template/boot/css/tree.css" rel="stylesheet" />
<script type="text/javascript" src="//<?php echo $_SERVER['SERVER_NAME']?>/template/boot/js/tree.js"></script>
<!-- Fonts -->
    <link rel="stylesheet" href="//glyphsearch.com/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="//glyphsearch.com/bower_components/foundation-icon-fonts/foundation-icons.css">
    <link rel="stylesheet" href="//glyphsearch.com/bower_components/icomoon/dist/css/style.css">
    <link rel="stylesheet" href="//glyphsearch.com/bower_components/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="//glyphsearch.com/bower_components/material-design-icons/iconfont/material-icons.css">
    <link rel="stylesheet" href="//glyphsearch.com/bower_components/octicons/octicons/octicons.css">
<!-- end Fonts -->

<!-- required plugins -->
<!--[if IE]><script type="text/javascript" src="scripts/jquery.bgiframe.js"></script><![endif]-->
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<body>
	<script type="text/javascript" class="init">
$(document).ready(function() {
 $('table.table').DataTable( {
        scrollY:        '35vh',
        scrollCollapse: true,
        paging:         false,
		dom: 'LBfrtip',
		buttons: true,
		aaSorting: [],
		columnDefs: [ {
        targets: 3,
		render: $.fn.dataTable.render.ellipsis(150,1,0)
    } ]
		
    } ); 
$.fn.dataTable.render.ellipsis = function ( cutoff, wordbreak, escapeHtml ) {
    var esc = function ( t ) {
        return t
            .replace( /&/g, '&amp;' )
            .replace( /</g, '&lt;' )
            .replace( />/g, '&gt;' )
            .replace( /"/g, '&quot;' );
    };
 
    return function ( d, type, row ) {
        // Order, search and type get the original data
        if ( type !== 'display' ) {
            return d;
        }
 
        if ( typeof d !== 'number' && typeof d !== 'string' ) {
            return d;
        }
 
        d = d.toString(); // cast numbers
 
        if ( d.length < cutoff ) {
            return d;
        }
 
        var shortened = d.substr(0, cutoff-1);
 
        // Find the last white space character in the string
        if ( wordbreak ) {
            shortened = shortened.replace(/\s([^\s]*)$/, '');
        }
 
        // Protect against uncontrolled HTML input
        if ( escapeHtml ) {
            shortened = esc( shortened );
        }
 
        return '<span class="ellipsis" title="'+esc(d)+'">'+shortened+'&#8230;</span>';
    };
};
	} );
</script>
    <div id="wrapper" class='toggled'>
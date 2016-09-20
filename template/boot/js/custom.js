$(document).ready(function() {
//selectize
       $('#hc').selectize({
    valueField: 'name',
    labelField: 'name',
    searchField: 'name',
    options: [],
    create: true,
    load: function(query, callback) {
        if (!query.length) return callback();
        $.ajax({
            url: '../ajax/cat.php',
            type: 'POST',
		   dataType: 'json',
            data: {
                name: query,
				hc: '1',
            },
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res);
            }
        });
    }
			
        });
$('#shc').selectize({
    valueField: 'name',
    labelField: 'name',
    searchField: 'name',
    options: [],
    create: true,
    load: function(query, callback) {
        if (!query.length) return callback();
        $.ajax({
            url: '../ajax/cat.php',
            type: 'POST',
		   dataType: 'json',
            data: {
                name: query,
				shc: "1",
            },
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res);
            }
        });
    }
			
        });	

//syntax HighLighter
  $('pre').each(function(i, block) {
    hljs.highlightBlock(block);
  });
		
//Initialization of treeviews
$('#tree1').treed();

//summernote
	$('#summernote').summernote({
		height: 300,                 	// set editor height
		minHeight: null,             	// set minimum height of editor
		maxHeight: null,             	// set maximum height of editor
		focus: true,				 	// set focus to editable area after initializing summernote
		codemirror: {theme: 'monokai'}	//Code Mirror	
	});

//header DropDown Fix
	$('.dropdown-toggle').click(function(){
		var parent = $(this).parent();
		if(parent.hasClass('open')) { 
			parent.removeClass('open'); 
		} else {
			parent.addClass('open');
		}
	});	
	} );
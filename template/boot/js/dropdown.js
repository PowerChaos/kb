$(document).ready(function() {
//selectize
var xhr;
var select_hc, $select_hc;
var select_shc, $select_shc;

$select_hc = $('#hc').selectize({
	valueField: 'id',
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
				hc: "1",
            },
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res);
            }
        });
    },
			
    onChange: function(value) {
        if (!value.length) return;
        select_shc.disable();
        select_shc.clearOptions();
        select_shc.load(function(callback) {
            xhr && xhr.abort();
            xhr = $.ajax({
             url: '../ajax/cat.php',
            type: 'POST',
		   dataType: 'json',
            data: {
				id: value,
                name: $("#hc option:selected").text(),
				shc: '1',
            },
                success: function(results) {
                    select_shc.enable();
                    callback(results);
                },
                error: function() {
					select_shc.disable();
                    callback();
                }
            })
        });
    }
});

$select_shc = $('#shc').selectize({
    valueField: 'id',
    labelField: 'name',
    searchField: 'name',
	options: [],
    create: true,
});

select_shc  = $select_shc[0].selectize;
select_hc = $select_hc[0].selectize;

select_shc.disable();
});
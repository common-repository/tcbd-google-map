(function() {
	tinymce.PluginManager.add('tcbd_map_mce_button', function( editor, url ) {
		editor.addButton( 'tcbd_map_mce_button', {
			icon: false,
			type: 'button',
			title: 'TCBD Map',
			image : url + '/icon.png',
			onclick: function() {
				editor.windowManager.open( {
					title: 'TCBD Google Map Shortcode Generator',
					body: [
						{
							type: 'textbox',
							name: 'heightBox',
							label: 'Map Height',
							value: '300px',
							disc: 'your'
						},
						{
							type: 'textbox',
							name: 'widthBox',
							label: 'Map Width',
							value: '100%'
						}
					],
					onsubmit: function( e ) {
						editor.insertContent( '[tcbd-map height="' + e.data.heightBox + '" width="' + e.data.widthBox + '"]');
					}
				});
			}
		});
	});
})();
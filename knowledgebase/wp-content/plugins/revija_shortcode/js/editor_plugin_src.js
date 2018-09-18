(function() 
{
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('revija_shortcode');

	tinymce.create('tinymce.plugins.PostsPlugin', 
		{
			/**
			 * Initializes the plugin, this will be executed after the plugin has been created.
			 * This call is done before the editor instance has finished it's initialization so use the onInit event
			 * of the editor instance to intercept that event.
			 *
			 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
			 * @param {string} url Absolute URL to where the plugin is located.
			 */
			init : function(ed, url) 
			{
				// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceTooltip');
				ed.addCommand('mceTooltip', 
					function() 
					{
						var content = tinyMCE.activeEditor.selection.getContent({format : 'raw'});
						var newcontent = '[revija_shortcode text="Example Tooltip" title="Title Tooltip" position="top"]';
						
						tinyMCE.activeEditor.selection.setContent(newcontent);
					}
				);
				
				ed.addCommand('mceMessage', 
					function() 
					{
						var content = tinyMCE.activeEditor.selection.getContent({format : 'raw'});
						var newcontent = '[message_shortcode type="warning" text="Text"]';
						
						tinyMCE.activeEditor.selection.setContent(newcontent);
					}
				);

				ed.addCommand('mceHighlights', function() {
					var selected_text = ed.selection.getContent();
					var return_text = '';
					return_text = '<span class="pointed">' + selected_text + '</span>';
					
					ed.execCommand('mceInsertContent', 0, return_text);
				});
				
				ed.addCommand('mceSmall', function() {
					var selected_text = ed.selection.getContent();
					var return_text = '';
					return_text = '<span class="text_type_13">' + selected_text + '</span>';
					
					ed.execCommand('mceInsertContent', 0, return_text);
				});
				
				
				
				
				
				
				
				
				// Register jusers button
				ed.addButton('revija_shortcode', 
					{
						title : 'Tooltip',
						cmd : 'mceTooltip',
						image : url + '/img/tooltip.png'
					}
				);
				
				
				ed.addButton('message_shortcode', 
					{
						title : 'Message',
						cmd : 'mceMessage',
						image : url + '/img/icon_m.png'
					}
				);
				
				ed.addButton('highlights_shortcode', {
					title : 'Highlights',
					cmd : 'mceHighlights',
					image : url + '/img/icon_h.png'
				});	
				
				ed.addButton('small_shortcode', {
					title : 'Small',
					cmd : 'mceSmall',
					image : url + '/img/icon_s.png'
				});	
			
			},
		
			/**
			 * Creates control instances based in the incomming name. This method is normally not
			 * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
			 * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
			 * method can be used to create those.
			 *
			 * @param {String} n Name of the control to create.
			 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
			 * @return {tinymce.ui.Control} New control instance or null if no control was created.
			 */
			createControl : function(n, cm) 
			{
				return null;
			},

			/**
			 * Returns information about the plugin as a name/value array.
			 * The current keys are longname, author, authorurl, infourl and version.
			 *
			 * @return {Object} Name/value array containing information about the plugin.
			 */
			getInfo : function() 
			{
				return {
					longname : 'Shortcodes plugin',
					author : 'mad_velikorodnov',
					authorurl : 'inthe7heaven.com',
					infourl : 'inthe7heaven.com',
					version : "1.0"
				};
			}
		});

	// Register plugin
	tinymce.PluginManager.add('revija_shortcode', tinymce.plugins.PostsPlugin);
})();

/**
* Class name: custom-post-types-columns.js
* Author: David Rugendyke - david@ironcode.com.au
* Platform: Mootools - no conflict mode just incase
* Allows column sorting on the custom post types
*/

var kontrol_cpt_columns;

(function($){
	
	// Prepopulates other fields when adding a new custom post type
	kontrol_cpt_columns = new Class({
		
			Implements: [Events, Options],
			
			/**
			* Constructor
			*/
			initialize: function(options)
			{
				
				this.setOptions(options);
				
				this.col_containers = $$('#kontrol .row-cols');
				
				// Set the listeners
				this.listeners();
				
			},
			
				
			/**
			* Save the columns
			*/
			save_cols: function(container) {
				
				// Change the icon to normal
				container.getElement('.save-cols').addClass('saved');
				// Get all the columns values and save
				var cpt_id = container.get('data-cpt-id');
						
				new Request({
					url: this.options.ajax_url+"/savecols/"+cpt_id+"&noheader=true",
					data: container.toQueryString(),
					method: 'POST',
					onComplete: function(resp) {
						// Change the icon to 'saved'
						container.getElement('.save-cols').removeClass('saved');
					}
					
				}).send();
				
			},
			
			/**
			* Main event listeners
			*/
			listeners: function() {
				
				// Listen for when a new col is created, make it sortable
				window.addEvent('duplication-event-completed', function(duplicate, parent) {
					// Makes the rows sortable
					new sort_rows();
				});
				
				// Saving cols
				this.col_containers.getElement('.save-cols').addEvent('click', function(e) {
						this.save_cols(e.target.getParent('.row-cols'));
				}.bind(this));
				
			}
		
			
	});

})(document.id);
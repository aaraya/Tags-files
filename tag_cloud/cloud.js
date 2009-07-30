	window.addEvent('domready', function() {

	var gallery = $('gallery');
	
	var addTags = function(tags) {
	
		var head = new Element('div',{ 
				  'class':'tag_header',
				  'html':'Event Tags'
		});
				
	if (tags != " "){
		
		head.inject(gallery);
	}
		var el = new Element('div', {'class': 'preview'});
		tags.each(function(tag) {
			var name = new Element('a', {	
				'html': tag.tag,
				'href': "../programs/programs.php?tag=" + tag.tag
			}).inject(el);
	
			if (tag.frequency <= 10){ 
				name.setStyles({		
					'font-size': '8px'	
				});
			};
			if (tag.frequency > 10 && tag.frequency <= 15 ){
				name.setStyles({		
					'font-size': '12px'
				});
			};	
			if (tag.frequency > 15 && tag.frequency <= 20 ){
			   name.setStyles({		
					'font-size': '14px'
				});
			};
		
			if (tag.frequency > 20 && tag.frequency <= 25 ){
			   name.setStyles({		
					'font-size': '20px'
				});
			};
		
			if (tag.frequency > 25 && tag.frequency <= 30 ){
			   name.setStyles({		
					'font-size': '25px'
				});
			};
		
		
			if (tag.frequency > 30 && tag.frequency <= 35 ){
			   name.setStyles({		
					'font-size': '30px'
				});
			};
			
			if (tag.frequency > 35 && tag.frequency <= 40 ){
			   name.setStyles({		
					'font-size': '30px'
				});
			};
			
			if (tag.frequency > 40 && tag.frequency <= 45 ){
			   name.setStyles({		
					'font-size': '30px'
				});
			};
		
			if (tag.frequency >= 100 ){
			   name.setStyles({		
					'font-size': '40px'
				});
			};
			
			el.inject(gallery);
			
		});
	  }
	  
	window.addEvent('domready', function (){ 	

		var params; 
		
		if (location.search != ""){
		
		params = location.search;
		
		var request = new Request.JSON({
			url: '../programs/tag_cloud/json.php' + params,
			onComplete: function(jsonObj) {
				addTags(jsonObj.tags);
			}
		}).send();
	 }});

});

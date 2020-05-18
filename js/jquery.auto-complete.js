/**
 * Original :
 * 
 * Auto Complete v2.1
 * June 11, 2009
 * Corey Hart @ http://www.codenothing.com
 *
 * Auto Complete takes input from the user and runs a check through PHP to find what the user
 * is looking for. This test case runs a limited search on words that begin with the letter 'a'.
 *
 * @css: Optional class for list rollovers, defaults to 'non-404'
 */ 
var SEARCH=16;

;(function($){
	var requestCount=0;
	$.fn.autoComplete = function(css){
		this.each(function(){
			// Cache objects
			var $obj = $(this), 
				$input = $("input[name='searchfit']", $obj), 
				$id = $("input[name='id']", $obj)
				$q =  $("input[name='q']", $obj)
				settings = {
					opt: -1,
					inputval: '',
					idval: '',
					css: (css) ? css : 'non-404',
					ajax: $("input[name='href']", $obj).val()
				};

			// Run on keyup
			$input.keyup(function(e){
				var key = e.keyCode;
				if ((key > 47 && key < 91) || key == 8){
					settings.opt = -1;
					settings.inputval = $input.val();
					$id.val("");
					settings.idval="";
					sendRequest(settings.inputval);
				}
				else if (key == 37 || key == 39){
					settings.opt = -1;
					$('ul', $obj).html('');
					$("ul.searchresults").hide();
				}
				else if (key == 38){
					if (settings.opt >= 0){
						settings.opt--;
						var val = $('ul li', $obj).removeClass(settings.css).eq(settings.opt).addClass(settings.css);
						if (val) {
							$input.val((settings.opt < 0) ? settings.inputval : val.text());
							$id.val((settings.opt < 0) ? "" : val.attr('rel'));
						}
					}
				}
				else if (key == 40){
					if (settings.opt < $('ul li', $obj).length-1){
						settings.opt++;
						var val = $('ul li', $obj).removeClass(settings.css).eq(settings.opt).addClass(settings.css);
						if (val) {
							$input.val((settings.opt < 0) ? settings.inputval : val.text() );
							$id.val((settings.opt < 0) ? "" : val.attr('rel'));
						}	
					}
				} else if (key == 13){
					if (settings.opt >= 0){
						settings.inputval=$input.val();
						settings.idval=$id.val();
						settings.opt = -1;
						$("ul.searchresults").hide();
						$('ul', $obj).html('');
					}
					else {
						valid();
					}
				}
				
				
			}).blur(function(){
				
			});
	
			// Ajax Request
			var sendRequest = function(val){
				if (val.length==0) return;
				
				requestCount++;
				
				//$("ul.searchresults").hide("clip");
				$.post(settings.ajax, {query: val}, function(json){
					var content="";
					// Evaluate the return obj
					json = eval(json);
					// Show the list if there is a return
					if (json && json.length > 0){
						for (i in json){
							content+='<li c="'+i+'" '+((i%2==1)?'class="even"':'')+' rel="'+json[i].value+'">'+json[i].display+'</li>';
						}
					
						requestCount--;
						if (requestCount>0) return;
						
						$('ul', $obj).html(content);
						
						// Start mouse actions after list is set
						mouseaction();
						
						if ($("ul.searchresults:hidden")) {
							$("ul.searchresults").show();
						}
					}
					else {
						$("ul.searchresults").hide();
					}
				});
			}
	
			// Run Mouse Actions
			function mouseaction(){
				// List effects
				$('ul li', $obj).mouseover(function(){
					$('ul li', $obj).removeClass(settings.css);
					var elem=$(this).addClass(settings.css);
					settings.opt = elem.attr('c');
					
				});
				$('ul li', $obj).click(function(){
                    var elem=$(this);
					$input.val( elem.text() );
					$id.val( elem.attr('rel') );
					settings.inputval=elem.text();
					settings.idval=elem.attr('rel');
					settings.opt = -1;
					$("ul.searchresults").hide();
					$('ul', $obj).html('');
				});
	
				// Return orignal val when not hovering
				$('ul', $obj).mouseout(function(){
				});
			}
			
			function valid () {
                if (settings.idval.length>0)
				    window.location.href="annuaire.php?ex="+SEARCH+"&id="+settings.idval;
                else 
				    window.location.href="annuaire.php?ex="+SEARCH+"&q="+settings.inputval;
			}
			
			$("a", $obj).click(function () {
				valid();	
			});
		});
	};
})(jQuery);

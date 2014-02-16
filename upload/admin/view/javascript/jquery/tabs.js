$.fn.tabs = function() {
	var selector = this;
	
	this.each(function() {
		var obj = $(this); 
		
		$(obj.attr('href')).hide();
		
		$(obj).click(function() {
			$(selector).removeClass('selected');
			
			$(selector).each(function(i, element) {
				$($(element).attr('href')).hide();
			});
			
			$(this).addClass('selected');
			
			$($(this).attr('href')).show();
			
			return false;
		});
	});

	$(this).show();
	
	$(this).first().click();
};
$(document).ready(function(){
	if ($('#help ul li:last a').text() == '') {
		$('#help ul li:last a').text('中文支援(Dnono.com)');
	}  else if ($('#help ul li').hasClass('support') == false){
		$('#help ul li:last').after('<li class="support"><a onclick="window.open(\'http://www.dnono.com\');">中文支援(Dnono.com)</a></li>');
	}
	
	if ($('#footer p').text() == '') {
		$('#footer p').html('中文版本提供<a href="http://www.Dnono.com"><b>Dnono</b></a>');
	} 
	if ($('#footer p').hasClass('footer') == false){
		$('#footer').append('<p class="footer"> 中文版本提供  <a href="http://www.Dnono.com"><b>Dnono</b></a></p>');
	}
	
});

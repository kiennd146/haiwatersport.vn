window.addEvent('domready', function(){
	// script to generate equal columns - unnecessary in the penguinMail template
	if(document.id('gkLeftLeft') && document.id('gkLeftRight')) {
		if(document.id('gkLeftLeft').getSize().x - 12 > 0) {
			document.id('gkLeftLeft').setStyle('width', (document.id('gkLeftLeft').getSize().x - 12) + "px");
		}
	}
	
	if(document.id('gkRightLeft') && document.id('gkRightRight')) {
		if(document.id('gkRightLeft').getSize().x - 12 > 0) {
			document.id('gkRightLeft').setStyle('width', (document.id('gkRightLeft').getSize().x - 12) + "px");
		}
	}
	
	if(document.id('gkInset1')) {
		if(document.id('gkInset1').getSize().x - 110 > 0) {
			document.id('gkInset1').setStyle('width', (document.id('gkInset1').getSize().x - 110) + "px");
		}
	}
	
	if(document.id('gkComponentWrap') && document.id('gkInset2')) {
		if(document.id('gkComponentWrap').getSize().x - 60 > 0) { 
			document.id('gkComponentWrap').setStyle('width', (document.id('gkComponentWrap').getSize().x - 60) + "px");
		}
	}
    
    if(document.id('gkContent') && document.id('gkLeft') && document.id('gkRight')) {
        if(document.id('gkContent').getSize().x - 60 > 0) { 
    		document.id('gkContent').setStyle('width', (document.id('gkContent').getSize().x - 60) + "px");
    	}
    } else if(document.id('gkContent') && document.id('gkLeft')) {
        if(document.id('gkContent').getSize().x - 30 > 0) { 
			document.id('gkContent').setStyle('width', (document.id('gkContent').getSize().x - 30) + "px");
		}
    } else if(document.id('gkContent') && document.id('gkRight')) {
        if(document.id('gkContent').getSize().x - 30 > 0) { 
			document.id('gkContent').setStyle('width', (document.id('gkContent').getSize().x - 30) + "px");
		}
    }
    
});
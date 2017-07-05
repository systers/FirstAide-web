/*Created by Akanksha
  Desc: jQuery for menu
*/
$(document).ready(function(){

	if(Cookies.get("safetyTools")=='1'){
		$("#safetyTools").next().slideDown();
	}	

	if(Cookies.get("supportServices")=='1'){
		$("#supportServices").next().slideDown();
	}	

	if(Cookies.get("sexualAssaultAwareness")=='1'){
		$("#sexualAssaultAwareness").next().slideDown();
	}

	if(Cookies.get("policyAndGlossary")=='1'){
		$("#policyAndGlossary").next().slideDown();
	}

	$("#accordian h3").click(function(){
		//slide up all the link lists
		$("#accordian ul ul").slideUp();

		Cookies.set('safetyTools',0);
		Cookies.set('supportServices',0);
		Cookies.set('sexualAssaultAwareness',0);
		Cookies.set('policyAndGlossary',0);
		
		//slide down the link list below the h3 clicked - only if its closed
		if(!$(this).next().is(":visible"))
		{
			$(this).next().slideDown();
			var id = $(this).attr('id');
			Cookies.set(id, 1);

		}
	});
});


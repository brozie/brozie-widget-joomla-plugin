<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

class  plgSystemBroziefreechat extends JPlugin {

	function onAfterRender() {
	
		$app = JFactory::getApplication();
		if(!$app->isSite()) return true;
		
		$output = JResponse::getBody();
		
		$colorscheme	= $this->params->get('colorscheme', '');
		$width			= $this->params->get('width', '650');
		$height			= $this->params->get('height', '300');
		$direction		= $this->params->get('direction', '');
		
			
		$r = '<script>
	(function(d,w,o,s,t){
		s=d.createElement("script");
		s.src="//d2qfrhunzv3jwi.cloudfront.net/static/widget/brozie-widget.js";
		s.async=true;
		s.onload=s.onreadystatechange=function(r){
			r=this.readyState;
			if((r==null||(/complete|loaded/).test(r))&&((t=w.brozieWidget)&&(t=t.widgetChat)))t.init(o);
		};
		(d.head||d.body).appendChild(s);
	})(document,window,{';
	if(!empty($colorscheme)) $r.=' skin:\''.$colorscheme.'\',';
	if(!empty($direction)) $r.=' dir:\''.$direction.'\',';
	$r.= ' width:\''.$width.'\',
		  height:\''.$height.'\'
	});
</script>';
		
		$output = preg_replace('/<\/body>/i', $r.'</body>', $output);
		JResponse::setBody($output);
		
		return true;
	}	

}
var imgLiquid=imgLiquid||{VER:"0.9.943"};imgLiquid.bgs_Available=false;imgLiquid.bgs_CheckRunned=false;imgLiquid.injectCss=".imgLiquid img {visibility:hidden}";(function(b){function a(){if(imgLiquid.bgs_CheckRunned){return}else{imgLiquid.bgs_CheckRunned=true}var c=b('<span style="background-size:cover" />');b("body").append(c);!function(){var d=c[0];if(!d||!window.getComputedStyle){return}var e=window.getComputedStyle(d,null);if(!e||!e.backgroundSize){return}imgLiquid.bgs_Available=(e.backgroundSize==="cover")}();c.remove()}b.fn.extend({imgLiquid:function(c){this.defaults={fill:true,verticalAlign:"center",horizontalAlign:"center",useBackgroundSize:true,useDataHtmlAttr:true,responsive:true,delay:0,fadeInTime:0,removeBoxBackground:true,hardPixels:true,responsiveCheckTime:500,timecheckvisibility:500,onStart:null,onFinish:null,onItemStart:null,onItemFinish:null,onItemError:null};a();var d=this;this.options=c;this.settings=b.extend({},this.defaults,this.options);if(this.settings.onStart){this.settings.onStart()}return this.each(function(n){var i=d.settings,e=b(this),f=b("img:first",e);if(!f.length){k();return}if(!f.data("imgLiquid_settings")){i=b.extend({},d.settings,j())}else{e.removeClass("imgLiquid_error").removeClass("imgLiquid_ready");i=b.extend({},f.data("imgLiquid_settings"),d.options)}f.data("imgLiquid_settings",i);if(i.onItemStart){i.onItemStart(n,e,f)}if(imgLiquid.bgs_Available&&i.useBackgroundSize){h()}else{o()}function h(){if(e.css("background-image").indexOf(encodeURI(f.attr("src")))===-1){e.css({"background-image":"url("+encodeURI(f.attr("src"))+")"})}e.css({"background-size":(i.fill)?"cover":"contain","background-position":(i.horizontalAlign+" "+i.verticalAlign).toLowerCase(),"background-repeat":"no-repeat"});b("a:first",e).css({display:"block",width:"100%",height:"100%"});b("img",e).css({display:"none"});if(i.onItemFinish){i.onItemFinish(n,e,f)}e.addClass("imgLiquid_bgSize");e.addClass("imgLiquid_ready");l()}function o(){if(f.data("oldSrc")&&f.data("oldSrc")!==f.attr("src")){var q=f.clone().removeAttr("style");q.data("imgLiquid_settings",f.data("imgLiquid_settings"));f.parent().prepend(q);f.remove();f=q;f[0].width=0;setTimeout(o,10);return}if(f.data("imgLiquid_oldProcessed")){m();return}f.data("imgLiquid_oldProcessed",false);f.data("oldSrc",f.attr("src"));b("img:not(:first)",e).css("display","none");e.css({overflow:"hidden"});f.fadeTo(0,0).removeAttr("width").removeAttr("height").css({visibility:"visible","max-width":"none","max-height":"none",width:"auto",height:"auto",display:"block"});f.on("error",k);f[0].onerror=k;function p(){if(f.data("imgLiquid_error")||f.data("imgLiquid_loaded")||f.data("imgLiquid_oldProcessed")){return}if(e.is(":visible")&&f[0].complete&&f[0].width>0&&f[0].height>0){f.data("imgLiquid_loaded",true);setTimeout(m,n*i.delay)}else{setTimeout(p,i.timecheckvisibility)}}p();g()}function g(){if(!i.responsive&&!f.data("imgLiquid_oldProcessed")){return}if(!f.data("imgLiquid_settings")){return}i=f.data("imgLiquid_settings");e.actualSize=e.get(0).offsetWidth+(e.get(0).offsetHeight/10000);if(e.sizeOld&&e.actualSize!==e.sizeOld){m()}e.sizeOld=e.actualSize;setTimeout(g,i.responsiveCheckTime)}function k(){f.data("imgLiquid_error",true);e.addClass("imgLiquid_error");if(i.onItemError){i.onItemError(n,e,f)}l()}function j(){var s={};if(d.settings.useDataHtmlAttr){var q=e.attr("data-imgLiquid-fill"),p=e.attr("data-imgLiquid-horizontalAlign"),r=e.attr("data-imgLiquid-verticalAlign");if(q==="true"||q==="false"){s.fill=Boolean(q==="true")}if(p!==undefined&&(p==="left"||p==="center"||p==="right"||p.indexOf("%")!==-1)){s.horizontalAlign=p}if(r!==undefined&&(r==="top"||r==="bottom"||r==="center"||r.indexOf("%")!==-1)){s.verticalAlign=r}}if(imgLiquid.isIE&&d.settings.ieFadeInDisabled){s.fadeInTime=0}return s}function m(){var z,r,y,p,t,x,u,B,s=0,A=0,v=e.width(),q=e.height();if(f.data("owidth")===undefined){f.data("owidth",f[0].width)}if(f.data("oheight")===undefined){f.data("oheight",f[0].height)}if(i.fill===(v/q)>=(f.data("owidth")/f.data("oheight"))){z="100%";r="auto";y=Math.floor(v);p=Math.floor(v*(f.data("oheight")/f.data("owidth")))}else{z="auto";r="100%";y=Math.floor(q*(f.data("owidth")/f.data("oheight")));p=Math.floor(q)}t=i.horizontalAlign.toLowerCase();u=v-y;if(t==="left"){A=0}if(t==="center"){A=u*0.5}if(t==="right"){A=u}if(t.indexOf("%")!==-1){t=parseInt(t.replace("%",""),10);if(t>0){A=u*t*0.01}}x=i.verticalAlign.toLowerCase();B=q-p;if(x==="left"){s=0}if(x==="center"){s=B*0.5}if(x==="bottom"){s=B}if(x.indexOf("%")!==-1){x=parseInt(x.replace("%",""),10);if(x>0){s=B*x*0.01}}if(i.hardPixels){z=y;r=p}f.css({width:z,height:r,"margin-left":Math.floor(A),"margin-top":Math.floor(s)});if(!f.data("imgLiquid_oldProcessed")){f.fadeTo(i.fadeInTime,1);f.data("imgLiquid_oldProcessed",true);if(i.removeBoxBackground){e.css("background-image","none")}e.addClass("imgLiquid_nobgSize");e.addClass("imgLiquid_ready")}if(i.onItemFinish){i.onItemFinish(n,e,f)}l()}function l(){if(n===d.length-1){if(d.settings.onFinish){d.settings.onFinish()}}}})}})})(jQuery);!function(){var b=imgLiquid.injectCss,a=document.getElementsByTagName("head")[0],c=document.createElement("style");c.type="text/css";if(c.styleSheet){c.styleSheet.cssText=b}else{c.appendChild(document.createTextNode(b))}a.appendChild(c)}();

(function($, doc, win) {
       
    $(window).load(function () { 
        $('.slider').fractionSlider({
            'controls' : fxparams.controls, // controls on/off
            'pager' : fxparams.pager, // pager on/off
            'autoChange' : fxparams.autochange, // auto change slides
            'pauseOnHover' : fxparams.pauseonhover, // pauses slider on hover (current step will still be completed)
            'slideEndAnimation' : fxparams.slideendanimation, // if set true, objects will transition out before next slide moves in 
            'backgroundAnimation' : fxparams.backgroundanimation, // background animation
            'backgroundX' : fxparams.backgroundx, // background animation x distance
            'backgroundY' : fxparams.backgroundy, // background animation y distance
            'backgroundSpeed' : fxparams.backgroundspeed, // default background animation speed
            'backgroundEase' : fxparams.backgroundease, // default background animation easing
            'fullWidth': fxparams.fullwidth,
            'responsive': fxparams.responsive, // responsive slider (see below for some implementation tipps)
            'increase': fxparams.increase, // if set, slider is allowed to get bigger than basic dimensions
            'dimensions': fxparams.dimensions, // slider dimensions
            'timeout' : fxparams.timeout,
			'startCallback' : function(){
				jQuery('.parallaxslider').animate({"height":"100%"},600);
			}
        });
		
		function slider_align() {

				$(".fraction-slider>.slide").each(function(){ 
					if(fxparams.fullwidth != ''){
						$(">.imgWrapp", this).css({"width":$(".parallaxslider").width(),"height":$(".fs-stretcher").height()});
					} else {
						$(">.imgWrapp", this).css({"width":$(".fs-stretcher").width(),"height":$(".fs-stretcher").height()});
					}
					$(">.imgWrapp", this).imgLiquid({
						fill: true,
						horizontalAlign: "center",
						verticalAlign: "top"
					});
						asset = ($(window).width()-$(".fraction-slider").width())/2;
						if(fxparams.fullwidth != ''){
							$(".fraction-slider>.slide").each(function(){ 
								$(">.imgWrapp", this).css({"marginLeft":-asset});

							});
						}
				});
			
			
		};
		
		slider_align();
		
		$(window).resize(function () { 
			slider_align();
		});
		
    });
})(jQuery, document, window);
function changeCities()
{
 var country=$('.country_list').val();
	 if(country){	
	 $.ajax({

		 url: 'getCityList/'+country,
		 type:'get',
		 success: (response)=>{
			 var cities = response;
			 for(j=document.getElementById('city').options.length-1;j>=1;j--)
			 {
				 document.getElementById('city').remove(j);
			 }

			 for (i=0;i<cities.length;i++)
			 {
				 var optn = document.createElement("OPTION");
				 optn.text = cities[i].city_name;
				 optn.value = cities[i].id;
				 document.getElementById('city').options.add(optn);
			 }

			 $('#status').fadeOut('slow');//fade out the loader
		 },
	     error:function(exception){

	     }

	});
	}
}

/*!
 * jQuery.filer
 * Copyright (c) 2015 CreativeDream
 * Website: http://creativedream.net/plugins/jquery.filer
 * Version: 1.0.1 (30-03-2015)
 * Requires: jQuery v1.7.1 or later
 */
!function(e){"use strict";e.fn.filer=function(t){return this.each(function(i,n){var a=e(n),l=".jFiler",r=e(),o=e(),s=e(),d=[],f=e.extend(!0,{},e.fn.filer.defaults,t),u={init:function(){a.wrap('<div class="jFiler"></div>'),r=a.closest(l),u._changeInput()},_bindInput:function(){f.changeInput&&o.size()>0&&o.bind("click",u._clickHandler),a.on({focus:function(){o.addClass("focused")},blur:function(){o.removeClass("focused")},change:function(){u._onChange()}}),f.dragDrop&&(o.length>0?o:a).bind("drop",u._dragDrop.drop).bind("dragover",u._dragDrop.dragEnter).bind("dragleave",u._dragDrop.dragLeave),f.uploadFile&&f.clipBoardPaste&&e(window).on("paste",u._clipboardPaste)},_unbindInput:function(){f.changeInput&&o.size()>0&&o.unbind("click",u._clickHandler)},_clickHandler:function(){a.click()},_applyAttrSettings:function(){var e=["name","limit","maxSize","extensions","changeInput","showThumbs","appendTo","theme","addMore","excludeName","files"];for(var t in e){var i="data-jfiler-"+e[t];if(u._assets.hasAttr(i)){switch(e[t]){case"changeInput":case"showThumbs":case"addMore":f[e[t]]=["true","false"].indexOf(a.attr(i))>-1?"true"==a.attr(i):a.attr(i);break;case"extensions":f[e[t]]=a.attr(i).replace(/ /g,"").split(",");break;case"files":f[e[t]]=JSON.parse(a.attr(i));break;default:f[e[t]]=a.attr(i)}a.removeAttr(i)}}},_changeInput:function(){if(u._applyAttrSettings(),f.theme&&r.addClass("jFiler-theme-"+f.theme),"input"!=a.get(0).tagName.toLowerCase()&&"file"!=a.get(0).type)o=a,a=e('<input type="file" name="'+f.name+'" />'),a.css({position:"absolute",left:"-9999px",top:"-9999px","z-index":"-9999"}),r.prepend(a),u._isGn=a;else if(f.changeInput){switch(typeof f.changeInput){case"boolean":o=e('<div class="jFiler-input"><div class="jFiler-input-caption"><span>'+f.captions.feedback+'</span></div><div class="jFiler-input-button">'+f.captions.button+'</div></div>"');break;case"string":case"object":o=e(f.changeInput);break;case"function":o=e(f.changeInput(r,a,f))}a.after(o),a.css({position:"absolute",left:"-9999px",top:"-9999px","z-index":"-9999"})}(!f.limit||f.limit&&f.limit>=2)&&(a.attr("multiple","multiple"),"[]"!=a.attr("name").slice(-2)?a.attr("name",a.attr("name")+"[]"):null),u._bindInput(),f.files&&u._append(!1,{files:f.files})},_clear:function(){u.files=null,f.uploadFile||f.addMore||u._reset(),u._set("feedback",u._itFl&&u._itFl.length>0?u._itFl.length+" "+f.captions.feedback2:f.captions.feedback),null!=f.onEmpty&&"function"==typeof f.onEmpty?f.onEmpty(r,o,a):null},_reset:function(t){if(!t){if(!f.uploadFile&&f.addMore){for(var i=0;i<d.length;i++)d[i].remove();d=[],u._unbindInput(),a=u._isGn?u._isGn:e(n),u._bindInput()}u._set("input","")}u._itFl=[],u._itFc=null,u._ajFc=0,r.find("input[name^='jfiler-items-exclude-']:hidden").remove(),s.fadeOut("fast",function(){e(this).remove()}),s=e()},_set:function(e,t){switch(e){case"input":a.val("");break;case"feedback":o.length>0&&o.find(".jFiler-input-caption span").html(t)}},_filesCheck:function(){var t=0;if(f.limit&&u.files.length+u._itFl.length>f.limit)return alert(u._assets.textParse(f.captions.errors.filesLimit)),!1;for(var i=0;i<u.files.length;i++){var n=u.files[i].name.split(".").pop().toLowerCase(),a=u.files[i],l={name:a.name,size:a.size,size2:u._assets.bytesToSize(a.size),type:a.type,ext:n};if(null!=f.extensions&&-1==e.inArray(n,f.extensions))return alert(u._assets.textParse(f.captions.errors.filesType,l)),!1;if(null!=f.maxSize&&u.files[i].size>1048576*f.maxSize)return alert(u._assets.textParse(f.captions.errors.filesSize,l)),!1;if(4096==a.size&&0==a.type.length)return!1;t+=u.files[i].size}if(null!=f.maxSize&&t>=Math.round(1048576*f.maxSize))return alert(u._assets.textParse(f.captions.errors.filesSizeAll)),!1;if(f.addMore||f.uploadFile){var l=u._itFl.filter(function(e){return e.file.name!=a.name||e.file.size!=a.size||e.file.type!=a.type||(a.lastModified?e.file.lastModified!=a.lastModified:0)?void 0:!0});if(l.length>0)return!1}return!0},_thumbCreator:{create:function(t){var i=u.files[t],n=u._itFc?u._itFc.id:t,a=i.name,l=i.size,r=i.type.split("/",1).toString().toLowerCase(),o=-1!=a.indexOf(".")?a.split(".").pop().toLowerCase():"",d=f.uploadFile?'<div class="jFiler-jProgressBar">'+f.templates.progressBar+"</div>":"",p={id:n,name:a,size:l,size2:u._assets.bytesToSize(l),type:r,extension:o,icon:u._assets.getIcon(o,r),icon2:u._thumbCreator.generateIcon({type:r,extension:o}),image:'<div class="jFiler-item-thumb-image fi-loading"></div>',progressBar:d,_appended:i._appended},c="";return i.opts&&(p=e.extend({},i.opts,p)),c=e(u._thumbCreator.renderContent(p)).attr("data-jfiler-index",n),c.get(0).jfiler_id=n,u._thumbCreator.renderFile(i,c,p),i.forList?c:(u._itFc.html=c,c.hide()[f.templates.itemAppendToEnd?"appendTo":"prependTo"](s.find(f.templates._selectors.list)).show(),void(i._appended||u._onSelect(t)))},renderContent:function(e){return u._assets.textParse(e._appended?f.templates.itemAppend:f.templates.item,e)},renderFile:function(t,i,n){if(0==i.find(".jFiler-item-thumb-image").size())return!1;if(t.file&&"image"==n.type){var a='<img src="'+t.file+'" draggable="false" />',l=i.find(".jFiler-item-thumb-image.fi-loading");return e(a).error(function(){a=u._thumbCreator.generateIcon(n),i.addClass("jFiler-no-thumbnail"),l.removeClass("fi-loading").html(a)}).load(function(){l.removeClass("fi-loading").html(a)}),!0}if(window.File&&window.FileList&&window.FileReader&&"image"==n.type&&n.size<6e6){var r=new FileReader;r.onload=function(t){var a='<img src="'+t.target.result+'" draggable="false" />',l=i.find(".jFiler-item-thumb-image.fi-loading");e(a).error(function(){a=u._thumbCreator.generateIcon(n),i.addClass("jFiler-no-thumbnail"),l.removeClass("fi-loading").html(a)}).load(function(){l.removeClass("fi-loading").html(a)})},r.readAsDataURL(t)}else{var a=u._thumbCreator.generateIcon(n),l=i.find(".jFiler-item-thumb-image.fi-loading");i.addClass("jFiler-no-thumbnail"),l.removeClass("fi-loading").html(a)}},generateIcon:function(t){var i=new Array(3);if(t&&t.type&&t.extension)switch(t.type){case"image":i[0]="f-image",i[1]='<i class="icon-jfi-file-image"></i>';break;case"video":i[0]="f-video",i[1]='<i class="icon-jfi-file-video"></i>';break;case"audio":i[0]="f-audio",i[1]='<i class="icon-jfi-file-audio"></i>';break;default:i[0]="f-file f-file-ext-"+t.extension,i[1]=t.extension.length>0?"."+t.extension:"",i[2]=1}else i[0]="f-file",i[1]=t.extension&&t.extension.length>0?"."+t.extension:"",i[2]=1;var n='<span class="jFiler-icon-file '+i[0]+'">'+i[1]+"</span>";if(1==i[2]){var a=u._assets.text2Color(t.extension);if(a){var l=e(n).appendTo("body"),r=l.css("box-shadow");r=a+r.substring(r.replace(/^.*(rgba?\([^)]+\)).*$/,"$1").length,r.length),l.css({"-webkit-box-shadow":r,"-moz-box-shadow":r,"box-shadow":r}).attr("style","-webkit-box-shadow: "+r+"; -moz-box-shadow: "+r+"; box-shadow: "+r+";"),n=l.prop("outerHTML"),l.remove()}}return n},_box:function(t){if(null!=f.beforeShow&&"function"==typeof f.beforeShow?!f.beforeShow(u.files,s,r,o,a):!1)return!1;if(s.length<1){if(f.appendTo)var i=e(f.appendTo);else var i=r;i.find(".jFiler-items").remove(),s=e('<div class="jFiler-items jFiler-row"></div>'),s.append(u._assets.textParse(f.templates.box)).appendTo(i),s.on("click",f.templates._selectors.remove,function(i){i.preventDefault();var n=f.templates.removeConfirmation?confirm(f.captions.removeConfirmation):!0;n&&u._remove(t?t.remove.event:i,t?t.remove.el:e(this).closest(f.templates._selectors.item))})}for(var n=0;n<u.files.length;n++)u._addToMemory(n),u._thumbCreator.create(n)}},_upload:function(){var t=u._itFc.html,i=new FormData;if(i.append(a.attr("name"),u._itFc.file,u._itFc.file.name?u._itFc.file.name:!1),null!=f.uploadFile.data&&e.isPlainObject(f.uploadFile.data))for(var n in f.uploadFile.data)i.append(n,f.uploadFile.data[n]);u._ajax.send(t,i,u._itFc)},_ajax:{send:function(t,i,n){return n.ajax=e.ajax({url:f.uploadFile.url,data:i,type:f.uploadFile.type,enctype:f.uploadFile.enctype,xhr:function(){var i=e.ajaxSettings.xhr();return i.upload&&i.upload.addEventListener("progress",function(e){u._ajax.progressHandling(e,t)},!1),i},complete:function(e,t){n.ajax=!1,u._ajFc++,u._ajFc>=u.files.length&&(null!=f.uploadFile.onComplete&&"function"==typeof f.uploadFile.onComplete?f.uploadFile.onComplete(s,r,o,a,e,t):null,u._ajFc=0)},beforeSend:function(e,i){return null!=f.uploadFile.beforeSend&&"function"==typeof f.uploadFile.beforeSend?f.uploadFile.beforeSend(t,s,r,o,a,n.id,e,i):!0},success:function(e,i,l){n.uploaded=!0,null!=f.uploadFile.success&&"function"==typeof f.uploadFile.success?f.uploadFile.success(e,t,s,r,o,a,n.id,i,l):null},error:function(e,i,l){n.uploaded=!1,null!=f.uploadFile.error&&"function"==typeof f.uploadFile.error?f.uploadFile.error(t,s,r,o,a,n.id,e,i,l):null},statusCode:f.uploadFile.statusCode,cache:!1,contentType:!1,processData:!1}),n.ajax},progressHandling:function(e,t){if(e.lengthComputable){var i=Math.round(100*e.loaded/e.total).toString();null!=f.uploadFile.onProgress&&"function"==typeof f.uploadFile.onProgress?f.uploadFile.onProgress(i,t,s,r,o,a):null,t.find(".jFiler-jProgressBar").find(f.templates._selectors.progressBar).css("width",i+"%")}}},_dragDrop:{dragEnter:function(e){e.preventDefault(),e.stopPropagation(),r.addClass("dragged"),u._set("feedback",f.captions.drop),null!=f.dragDrop.dragEnter&&"function"==typeof f.dragDrop.dragEnter?f.dragDrop.dragEnter(e,o,a,r):null},dragLeave:function(e){return e.preventDefault(),e.stopPropagation(),u._dragDrop._dragLeaveCheck(e)?(r.removeClass("dragged"),u._set("feedback",f.captions.feedback),void(null!=f.dragDrop.dragLeave&&"function"==typeof f.dragDrop.dragLeave?f.dragDrop.dragLeave(e,o,a,r):null)):!1},drop:function(e){e.preventDefault(),r.removeClass("dragged"),!e.originalEvent.dataTransfer.files||e.originalEvent.dataTransfer.files.length<=0||(u._set("feedback",f.captions.feedback),u._onChange(e,e.originalEvent.dataTransfer.files),null!=f.dragDrop.drop&&"function"==typeof f.dragDrop.drop?f.dragDrop.drop(e.originalEvent.dataTransfer.files,e,o,a,r):null)},_dragLeaveCheck:function(t){var i=t.relatedTarget,n=!1;return i!==o&&(i&&(n=e.contains(o,i)),n)?!1:!0}},_clipboardPaste:function(e,t){if((t||e.originalEvent.clipboardData||e.originalEvent.clipboardData.items)&&(!t||e.originalEvent.dataTransfer||e.originalEvent.dataTransfer.items)&&!u._clPsePre){var i=t?e.originalEvent.dataTransfer.items:e.originalEvent.clipboardData.items,n=function(e,t,i){t=t||"",i=i||512;for(var n=atob(e),a=[],l=0;l<n.length;l+=i){for(var r=n.slice(l,l+i),o=new Array(r.length),s=0;s<r.length;s++)o[s]=r.charCodeAt(s);var d=new Uint8Array(o);a.push(d)}var f=new Blob(a,{type:t});return f};if(i)for(var a=0;a<i.length;a++)if(-1!==i[a].type.indexOf("image")||-1!==i[a].type.indexOf("text/uri-list")){if(t)try{window.atob(e.originalEvent.dataTransfer.getData("text/uri-list").toString().split(",")[1])}catch(e){return}var l=t?n(e.originalEvent.dataTransfer.getData("text/uri-list").toString().split(",")[1],"image/png"):i[a].getAsFile();l.name=Math.random().toString(36).substring(5),l.name+=-1!=l.type.indexOf("/")?"."+l.type.split("/")[1].toString().toLowerCase():".png",u._onChange(e,[l]),u._clPsePre=setTimeout(function(){delete u._clPsePre},1e3)}}},_onSelect:function(t){f.uploadFile&&!e.isEmptyObject(f.uploadFile)&&u._upload(t),null!=f.onSelect&&"function"==typeof f.onSelect?f.onSelect(u.files[t],u._itFc.html,s,r,o,a):null,t+1>=u.files.length&&(null!=f.afterShow&&"function"==typeof f.afterShow?f.afterShow(s,r,o,a):null)},_onChange:function(t,i){if(i){if(!i||0==i.length)return u._set("input",""),u._clear(),!1;u.files=i}else{if(!a.get(0).files||"undefined"==typeof a.get(0).files||0==a.get(0).files.length)return f.uploadFile||f.addMore||(u._set("input",""),u._clear()),!1;u.files=a.get(0).files}if(f.uploadFile||f.addMore||u._reset(!0),!u._filesCheck())return u._set("input",""),u._clear(),!1;if(u._set("feedback",u.files.length+u._itFl.length+" "+f.captions.feedback2),f.showThumbs)u._thumbCreator._box();else for(var n=0;n<u.files.length;n++)u._addToMemory(n),u._onSelect(n);if(!f.uploadFile&&f.addMore){var l=e('<input type="file" />'),r=a.prop("attributes");e.each(r,function(){l.attr(this.name,this.value)}),a.after(l),u._unbindInput(),d.push(l),a=l,u._bindInput()}},_append:function(e,t){var i=t?t.files:!1;if(i&&!(i.length<=0)&&(u.files=i,f.showThumbs)){for(var n=0;n<u.files.length;n++)u.files[n]._appended=!0;u._thumbCreator._box()}},_getList:function(e,t){var i=t?t.files:!1;if(i&&!(i.length<=0)&&(u.files=i,f.showThumbs)){for(var n=[],l=0;l<u.files.length;l++)u.files[l].forList=!0,n.push(u._thumbCreator.create(l));t.callback&&t.callback(n,s,r,o,a)}},_retryUpload:function(t,i){var n=parseInt("object"==typeof i?i.attr("data-jfiler-index"):i),a=u._itFl.filter(function(e){return e.id==n});return a.length>0?!f.uploadFile||e.isEmptyObject(f.uploadFile)||a[0].uploaded?void 0:(u._itFc=a[0],u._upload(n),!0):!1},_remove:function(t,n){if(n.binded){if(n.data.id&&(n=s.find(f.templates._selectors.item+"[data-jfiler-index='"+n.data.id+"']"),0==n.size()))return!1;n.data.el&&(n=n.data.el)}var l=n.get(0).jfiler_id||n.attr("data-jfiler-index"),d=null,p=function(t){var n=r.find("input[name^='jfiler-items-exclude-']:hidden").first(),l=u._itFl[t].file,o=[];0==n.size()?(n=e('<input type="hidden" name="jfiler-items-exclude-'+(f.excludeName?f.excludeName:("[]"!=a.attr("name").slice(-2)?a.attr("name"):a.attr("name").substring(0,a.attr("name").length-2))+"-"+i)+'">'),n.appendTo(r)):o=JSON.parse(n.val()),o.push(l.name),o=JSON.stringify(o),n.val(o)},c=function(t,i){p(i),u._itFl.splice(i,1),u._itFl.length<1?(u._reset(),u._clear()):u._set("feedback",u._itFl.length+" "+f.captions.feedback2),t.fadeOut("fast",function(){e(this).remove()})};for(var g in u._itFl)"length"!==g&&u._itFl.hasOwnProperty(g)&&u._itFl[g].id==l&&(d=g);return u._itFl.hasOwnProperty(d)?u._itFl[d].ajax?(u._itFl[d].ajax.abort(),void c(n,d)):(null!=f.onRemove&&"function"==typeof f.onRemove?f.onRemove(n,u._itFl[d].file,d,s,r,o,a):null,void c(n,d)):!1},_addToMemory:function(t){u._itFl.push({id:u._itFl.length,file:u.files[t],html:e(),ajax:!1,uploaded:!1}),u._itFc=u._itFl[u._itFl.length-1]},_assets:{bytesToSize:function(e){if(0==e)return"0 Byte";var t=1e3,i=["Bytes","KB","MB","GB","TB","PB","EB","ZB","YB"],n=Math.floor(Math.log(e)/Math.log(t));return(e/Math.pow(t,n)).toPrecision(3)+" "+i[n]},hasAttr:function(e,t){var t=t?t:a,i=t.attr(e);return i&&"undefined"!=typeof i?!0:!1},getIcon:function(t,i){var n=["audio","image","text","video"];return e.inArray(i,n)>-1?'<i class="icon-jfi-file-'+i+" jfi-file-ext-"+t+'"></i>':'<i class="icon-jfi-file-o jfi-file-type-'+i+" jfi-file-ext-"+t+'"></i>'},textParse:function(t,i){switch(i=e.extend({},{limit:f.limit,maxSize:f.maxSize},i&&e.isPlainObject(i)?i:{}),typeof t){case"string":return t.replace(/\{\{fi-(.*?)\}\}/g,function(e,t){return t=t.replace(/ /g,""),t.match(/(.*?)\|limitTo\:(\d+)/)?t.replace(/(.*?)\|limitTo\:(\d+)/,function(e,t,n){var t=i[t]?i[t]:"",a=t.substring(0,n);return a=t.length>a.length?a.substring(0,a.length-3)+"...":a}):i[t]?i[t]:""});case"function":return t(i);default:return t}},text2Color:function(e){if(!e||0==e.length)return!1;for(var t=0,i=0;t<e.length;i=e.charCodeAt(t++)+((i<<5)-i));for(var t=0,n="#";3>t;n+=("00"+(i>>2*t++&255).toString(16)).slice(-2));return n}},files:null,_itFl:[],_itFc:null,_ajFc:0};return u.init(),a.on("filer.append",function(e,t){u._append(e,t)}),a.on("filer.remove",function(e,t){t.binded=!0,u._remove(e,t)}),a.on("filer.reset",function(){return u._reset(),u._clear(),!0}),a.on("filer.generateList",function(e,t){return u._getList(e,t)}),a.on("filer.retry",function(e,t){return u._retryUpload(e,t)}),this})},e.fn.filer.defaults={limit:null,maxSize:null,extensions:null,changeInput:!0,showThumbs:!1,appendTo:null,theme:null,templates:{box:null,item:null,itemAppend:null,progressBar:null,itemAppendToEnd:!1,removeConfirmation:!0,_selectors:{list:null,item:null,progressBar:null,remove:null}},files:null,uploadFile:null,dragDrop:null,addMore:!1,clipBoardPaste:!0,excludeName:null,beforeShow:null,onSelect:null,afterShow:null,onRemove:null,onEmpty:null,captions:{button:"Choose Files",feedback:"Choose files To Upload",feedback2:"files were chosen",drop:"Drop file here to Upload",removeConfirmation:"Are you sure you want to remove this file?",errors:{filesLimit:"Only 4 files are allowed to be uploaded.",filesType:"Only Images are allowed to be uploaded.",filesSize:"{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",filesSizeAll:"Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."}}}}(jQuery);

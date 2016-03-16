/*
 * NoGray Time Picker Component
 *
 * Copyright (c), All right reserved
 * Gazing Design - http://www.NoGray.com
 * http://www.nogray.com/license.php
 */
 
ng.Assets.load_style(ng_config.assets_dir+"components/timepicker/css/"+ng_config.css_skin_prefix+"timepicker_style.css");ng.TimePicker=function(b){this.p=this.create_options(b,{top_hour:0,start:"12:00 am",end:"11:59 pm",range_off:null,hour_select:null,minute_select:null,ampm_select:null,value:null,format:"h:i a",server_format:"h:i a",use24:false,css_prefix:"ng_timepicker_",radius:75,always_simple:false,picker_image:ng_config.assets_dir+"components/timepicker/images/clock_icon.png",picker_image_disabled:ng_config.assets_dir+"components/timepicker/images/clock_icon_disabled.png",sun:"&#9728;",moon:"&#9790;",close_on_select:true});this.create_events();if(this.p.disabled){this.p.disabled=false;this.disable.delay(100,this)}this.make_id("timepicker");var a=new Date();this.p.date=new Date(a.getFullYear(),a.getMonth(),a.getDate(),0,0,0,0);this.set_start(this.p.start,true).set_end(this.p.end,true);this.set_top_hour(this.p.top_hour,true);if(ng.defined(this.p.range_off)){this.process_range_off()}if((ng.defined(this.p.input))||(ng.defined(this.p.object))){this.make()}};ng.TimePicker.inherit(ng.Component);ng.extend_proto(ng.TimePicker,{has_type:"slider",select_time:function(c,d){var b=c;var c=this.process_time(c);if(this.is_time_off(c)){var f=this.is_out_of_range(c);if(f[0]){var a=f[2];var h=1;if(Math.abs(c-f[1])<Math.abs(c-f[2])){a=f[1];var h=-1}var e=new Date(a);var g=e.getMinutes()+(5*h);g=g-(g%5);e.setMinutes(g);this.fire_event("selectRangeOff");return this.select_time(e.getHours()+":"+e.getMinutes())}else{this.fire_event("selectBeforeStart");return this.unselect_time()}}if(ng.defined(this.p.value)){this.unselect_time()}this.p.value=c;if(!ng.defined(d)){this.fire_event("select")}this.update_field_value();return this.update_status()},unselect_time:function(){if(ng.defined(this.p.value)){this.p.value=null;this.fire_event("unselect");this.update_field_value();return this.update_status()}return this},update_field_value:function(){if(ng.defined(this.p.value)){var b="en";if((ng.is_lite)&&(!ng.defined(ng_lang.en))){b=this.get_language()}ng.Language.load("general",b);var e=new Date(this.process_time(this.p.value));var g=e.print(this.p.server_format,b);var d=e.print(this.p.format,this.get_language());if(ng.defined(this.p.ampm_select)){var f=e.print("h",b)}else{var f=e.print("H",b)}var c=e.print("i",b);if(ng.defined(this.p.ampm_select)){if(this.p.server_format.indexOf("A")!=-1){var a=e.print("A",b)}else{var a=e.print("a",b)}}}else{var g="";var d="";var f="";var c="";var a=""}if(ng.defined(this.p.input_field)){this.p.input_field.value=g}if(ng.defined(this.get_input())){this.get_input().value=d}if(ng.defined(this.p.hour_select)){this.p.hour_select.value=f}if(ng.defined(this.p.minute_select)){this.p.minute_select.value=c}if(ng.defined(this.p.ampm_select)){this.p.ampm_select.value=a}return this},process_time:function(c){if(ng.type(c)=="number"){return c}else{if(ng.type(c)=="date"){return c.getTime()}else{c=c.toLowerCase();if(this.get_language()!="en"){c=ng.Language.numbers_to_english(c,this.get_language());var d=ng.Language.get_language(this.get_language()).date.am_pm;c=c.replace(d.lowercase[0],"am").replace(d.lowercase[1],"pm").replace(d.uppercase[0],"am").replace(d.uppercase[0],"pm")}var e=this.p.date.clone();var b=new Date(this.p.start_time);var f=0;if(c.indexOf("pm")!=-1){f=12}var a=c.split(":");a[0]=a[0].to_int();if(isNaN(a[0])){a[0]=b.getHours()}if((a[0]==12)&&(f==12)){a[0]=0}else{if((a[0]==12)&&(c.indexOf("am")!=-1)){a[0]=0}}a[0]=(a[0]+f)%24;e.setHours(a[0]);if(!ng.defined(a[1])){a[1]=b.getMinutes()}a[1]=a[1].to_int();if(isNaN(a[1])){a[1]=0}e.setMinutes(a[1]);return e.getTime()}}return c},is_time_off:function(a){a=this.process_time(a);if(a<this.p.start_time){return true}if(a>this.p.end_time){return true}if(this.is_out_of_range(a)[0]){return true}return false},is_out_of_range:function(a){if(ng.defined(this.p.range_off)){a=this.process_time(a);var c=this.p.range_off;for(var b=0;b<c.length;b++){if((a>=c[b][0])&&(a<=c[b][1])){return[true,c[b][0],c[b][1]]}}}return[false,0,0]},make:function(k){var b="";var a=false;if(ng.defined(k)){this.p.input=k}if(ng.defined(this.p.input)){if(ng.type(this.p.input)=="object"){var l=ng.get(this.p.input.hour);this.p.hour_select=ng.create("input",{type:"hidden",name:l.name,id:l.id,styles:{display:"none"}});b=l.value;l.replace(this.p.hour_select);var c=ng.get(this.p.input.minute);this.p.minute_select=ng.create("input",{type:"hidden",name:c.name,id:c.id,styles:{display:"none"}});if(c.value!=""){b+=":"+c.value}c.replace(this.p.minute_select);if(ng.defined(this.p.input.ampm)){var g=ng.get(this.p.input.ampm);this.p.ampm_select=ng.create("input",{type:"hidden",name:g.name,id:g.id,styles:{display:"none"}});if(g.value!=""){b+=" "+g.value}g.replace(this.p.ampm_select)}}else{this.p.input_field=ng.get(this.p.input);b=this.p.input_field.value}a=true}if(a){var e=this.get_input_html();ng.hold_html(e);this.p.input_container=ng.get("input_button_container"+this.id);this.set_input(ng.create("input",{id:"input_field"+this.id,events:{change:function(){var i=this.get_input().value;if(i!=""){this.select_time(i)}else{this.unselect_time()}if(this.p.close_on_select){this.close.delay(100,this)}this.fire_event("change")}.bind(this),keydown:function(s){var q=this.get_input();if((s.get_key()=="enter")&&(this.is_open())){q.fire_event("change");q.blur();this.close();s.stop();return this}var m=function(w){if(ng.defined(q.selectionStart)){q.selectionStart=w;q.selectionEnd=w;q.focus();s.stop()}else{if(document.selection){q.focus();var v=document.selection.createRange();v.moveStart("character",w-q.value.length);v.moveEnd("character",w-q.value.length);v.select()}}}.bind(this);var r=function(){var x=this.get_input();if(ng.defined(this.p.input.selectionStart)){var v=x.selectionStart}else{if(document.selection){x.focus();var y=document.selection.createRange();var w=y.text.length;y.moveStart("character",-x.value.length);var v=y.text.length-w}}return[x.value.substr(0,v),x.value.substr(v)]}.bind(this);var u=0;if(s.get_key().toLowerCase()=="up"){u=-1;var t=this.p.end_time}else{if(s.get_key().toLowerCase()=="down"){u=1;var t=this.p.start_time}}if(u!=0){if(!ng.defined(this.p.value)){this.select_time(t);m(0)}else{var n=new Date(this.p.value);var p=r();if(p[0].indexOf(":")==-1){n.setHours((n.getHours()+u)%24)}else{var o=n.getMinutes()+(u*5);o=o-(o%5);n.setMinutes(o)}var i=this.is_out_of_range(n);if(i[0]){if(u==-1){var n=new Date(i[1])}else{var n=new Date(i[2])}}this.select_time(n.getHours()+":"+n.getMinutes());m(p[0].length)}}}.bind(this)}}));var f=this.get_input();if(ng.defined(ng.UI)){this.p.input_container.append_element(f)}else{ng.get("input_holder_td"+this.id).append_element(f)}if(ng.defined(this.p.input_field)){var j=this.p.input_field;j.type="text";j.append_element(this.p.input_container,"before");f.className+=" "+j.className;f.readOnly=j.readOnly;f.size=j.size;f.placeholder=j.placeholder;if(j.disabled){this.disable.delay(100,this)}j.value="";j.set_style("display","none")}else{this.p.hour_select.append_element(this.p.input_table_holder,"before");if(this.p.hour_select.disabled){this.disable.delay(100,this)}this.p.hour_select.value=this.p.minute_select.value="";if(ng.defined(this.p.ampm_select)){this.p.ampm_select.value=""}}this.p.icon_button=new ng.Button({icon:this.p.picker_image,stop_default:true,hide_component:true,language:this.get_language(),color:this.p.buttons_color,over_color:this.p.buttons_over_color,down_color:this.p.buttons_down_color,disable_color:this.p.buttons_disable_color,gloss:this.p.buttons_gloss,checked_color:this.p.buttons_checked_color,light_border:this.p.buttons_light_border,events:{disable:function(){this.p.icon_button.set_icon(this.p.picker_image_disabled)}.bind(this),enable:function(){this.p.icon_button.set_icon(this.p.picker_image)}.bind(this)}});if(ng.defined(ng.UI)){this.p.icon_button.make(this.p.input_container)}else{this.p.icon_button.make("button_holder_td"+this.id)}this.set_button(this.p.icon_button)}var e='<div id="'+this.id+'_holder" class="'+this.p.css_prefix+'holder"></div>';this.set_html(e);this.p.holder_div=ng.get(this.id+"_holder");this.p.holder_div.add_events({click:function(r){if(this.is_disabled()){return}var m=r.src_element;var t=m.get("rel");if(m.has_class(this.p.css_prefix+"off")){return}if((ng.defined(t))&&(t!="")){var i=this.get_render_date();var q=i.getHours();var n=i.getMinutes();var o=new Date(this.p.start_time);var p=new Date(this.p.end_time);var s=false;if(t.indexOf("hour_")!=-1){q=t.replace("hour_","").to_int();if((q==o.getHours())&&(n<o.getMinutes())){n=o.getMinutes()}else{if((q==p.getHours())&&(n>p.getMinutes())){n=p.getMinutes()}}}else{if(t.indexOf("minute_")!=-1){n=t.replace("minute_","").to_int();s=true}}this.select_time(q+":"+n);if((s)&&(this.p.close_on_select)){this.close.delay(100,this)}}}.bind(this),mouseover:function(m){if(this.is_disabled()){return this}var o=m.src_element;var i=o.get("rel");if(o.has_class(this.p.css_prefix+"off")){return this.update_display_time()}if((ng.defined(i))&&(i!="")){var p=this.get_render_date();var n=p.getHours();var q=p.getMinutes();if(i.indexOf("hour_")!=-1){n=i.replace("hour_","").to_int()}else{if(i.indexOf("minute_")!=-1){q=i.replace("minute_","").to_int()}}this.update_display_time(n+":"+q)}}.bind(this),mouseout:function(){if(this.is_disabled()){return this}this.update_display_time()}.bind(this)});this.p.is_advance=false;if(!ng.is_lite){var h=["transform","msTransform","WebkitTransform","MozTransform","OTransform"];for(var d=0;d<h.length;d++){if(h[d] in this.p.holder_div.style){this.p.is_advance=true;break}}}this.render();if(ng.defined(this.p.value)){this.select_time(this.p.value,true)}if((b!="")&&(!ng.defined(this.p.value))){this.select_time(b,true)}return this},render:function(){if((this.p.is_advance)&&(!this.p.always_simple)){return this.advance_render()}else{return this.simple_render()}},update_display_time:function(a){if((!ng.defined(a))||(a=="")){if((this.p.is_advance)&&(!this.p.always_simple)){ng.get(this.id+"_faceplate").set_html("")}else{ng.get(this.id+"_simple_display").set_html("")}return this}var a=this.process_time(a);var e=new Date(a);var f=this.get_language();if((this.p.is_advance)&&(!this.p.always_simple)){var b=ng.create("div",{html:e.print(this.p.format,f)});ng.get(this.id+"_faceplate").set_html("");ng.get(this.id+"_faceplate").append_element(b);var d=b.get_height();var c=this.p.radius-(d/2).to_int();b.set_style("margin-top",c)}else{ng.get(this.id+"_simple_display").set_html(e.print(this.p.format,f))}return this},advance_render:function(){var p=this.p.radius;var j=p*2;var k=this.p.css_prefix;var e=ng.Language.get_dir(this.get_language());this.p.holder_div.set_html('<div id="'+this.id+'_faceplate" class="'+k+'faceplate">&nbsp;</div><div id="'+this.id+'_numholder"></div>');this.p.num_holder=ng.get(this.id+"_numholder");this.p.faceplate_div=ng.get(this.id+"_faceplate");this.p.num_holder.set_styles({width:j,height:j});if(e=="ltr"){var h="margin-left"}else{var h="margin-right"}var u=(p-(j/12)).to_int();var x=(j/6*1.5).to_int();var d=((x-(j/6))/2).to_int();var b=this.get_top_hour();var m=1;if(e=="rtl"){m=-1}for(var s=0;s<24;s++){var v=(b+s);var z=v;v=v%24;if(z==12){z=this.p.sun;var y=this.p.sun}else{if((z==24)||(z==0)){z=this.p.moon;var y=this.p.moon}else{z=z%12;if(this.p.use24){var y=ng.Language.translate_numbers(v,this.get_language())}else{var y=ng.Language.translate_numbers(z,this.get_language())}}}var l='<div id="'+this.id+"_hour_"+v+'" rel="hour_'+v+'" class="'+k+"hour "+k+"hour_"+v+'">'+y+"</div>";if(s%2==0){var t=(((s/2)*5)%60);l+='<div id="'+this.id+"_minute_"+t+'" rel="minute_'+t+'" class="'+k+"minute "+k+"minute_"+t+'">'+ng.Language.translate_numbers(t,this.get_language())+"</div>"}var o=ng.create("div",{html:(l),className:k+"number",styles:{textAlign:"center",width:(j/6).to_int(),height:(j/2).to_int(),"transform-rotate":(360/24*s).to_int()*m,"transform-origin":"bottom center"}});o.set_style(h,u);this.p.num_holder.append_element(o)}var c=this.p.faceplate_div;var n=c.get_style("paddingTop").to_int();var a=c.get_style("borderTopWidth").to_int();var q=c.get_style("paddingLeft").to_int();var g=c.get_style("borderLeftWidth").to_int();var f={marginTop:(-1*(n+a)).to_int(),width:j,height:j,"-webkit-border-radius":j,"-moz-border-radius":j,"border-radius":j};f[h]=(-1*(q+g)).to_int();c.set_styles(f);return this.update_status()},simple_render:function(){var c=this.p.css_prefix;var e=this.p.top_hour;var f=function(g){var j=(e+g);var h=j;j=j%24;if(h==12){h=this.p.sun;var k=this.p.sun}else{if((h==24)||(h==0)){h=this.p.moon;var k=this.p.moon}else{h=h%12;if(this.p.use24){var k=ng.Language.translate_numbers(j,this.get_language())}else{var k=ng.Language.translate_numbers(h,this.get_language())}}}return'<td id="'+this.id+"_hour_"+j+'" rel="hour_'+j+'" class="'+c+"hour "+c+"hour_"+j+'">'+k+"</td>"}.bind(this);var b=function(i,g){var h='<td id="'+this.id+"_minute_"+i+'" rel="minute_'+i+'" class="'+c+"minute "+c+"minute_"+i+'"';if(ng.defined(g)){h+=' colspan="'+g+'" '}h+=">"+ng.Language.translate_numbers(i,this.get_language())+"</td>";return h}.bind(this);var d=ng.Language.get_dir(this.get_language());var a=['<table cellspacing="0" cellpadding="0" class="'+c+'simple_table">'];a.push("<tr>"+f(21)+f(22)+f(23)+f(0)+f(1)+f(2)+f(3)+"</tr>");a.push("<tr>"+f(20)+b(55,2)+b(0)+b(5,2)+f(4)+"</tr>");a.push("<tr>"+f(19)+b(50));a.push('<td id="'+this.id+'_simple_display" class="'+c+'simple_display" rowspan="3" colspan="3">&nbsp;</td>');a.push(b(10)+f(5)+"</tr>");a.push("<tr>"+f(18)+b(45)+b(15)+f(6)+"</tr>");a.push("<tr>"+f(17)+b(40)+b(20)+f(7)+"</tr>");a.push("<tr>"+f(16)+b(35,2)+b(30)+b(25,2)+f(8)+"</tr>");a.push("<tr>"+f(15)+f(14)+f(13)+f(12)+f(11)+f(10)+f(9)+"</tr>");a.push("</table>");this.p.holder_div.set_html(a);return this.update_status()},update_status:function(){if(this.p.value==""){this.p.value=null}var b=ng.defined(this.p.value);var h=-1;var c=-1;if(b){var j=this.process_time(this.p.value);var a=new Date(j);h=a.getHours();c=a.getMinutes();c=c-(c%5)}else{this.disable_all_minutes()}var g=this.p.css_prefix;for(var e=0;e<24;e++){var k=ng.get(this.id+"_hour_"+e);if((this.is_time_off(e+":59"))&&(this.is_time_off(e+":00"))){k.add_class(g+"off");k.remove_class(g+"selected")}else{if(h==e){k.add_class(g+"selected")}else{k.remove_class(g+"selected")}k.remove_class(g+"off")}}if(b){for(var e=0;e<12;e++){var d=(e*5)%60;var f=ng.get(this.id+"_minute_"+d);if(this.is_time_off(h+":"+d)){f.add_class(g+"off");f.remove_class(g+"selected")}else{f.remove_class(g+"off");if(c==d){f.add_class(g+"selected")}else{f.remove_class(g+"selected")}}}}return this},disable_all_minutes:function(){for(var b=0;b<12;b++){var c=(b*5)%60;var a=ng.get(this.id+"_minute_"+c);a.add_class(this.p.css_prefix+"off");a.remove_class(this.p.css_prefix+"selected")}},get_render_date:function(){if(ng.defined(this.p.value)){return new Date(this.process_time(this.p.value))}return this.p.date.clone()},set_top_hour:function(a,b){a=a.to_int();if(a<0){a=0}if(a>23){a=23}this.p.top_hour=a;if(!ng.defined(b)){this.render()}return this},get_top_hour:function(){return this.p.top_hour},set_start:function(a,b){this.p.start=a;this.p.start_time=this.process_time(this.p.start);if(!ng.defined(b)){this.update_status()}return this},get_start:function(){return this.p.start},set_end:function(a,b){this.p.end=a;this.p.end_time=this.process_time(this.p.end);if(!ng.defined(b)){this.update_status()}return this},get_end:function(){return this.p.end},process_range_off:function(){var c=this.p.range_off;if(!ng.defined(c)){return this}var a=[];if(ng.type(c[0])!="array"){c=[[c[0],c[1]]]}for(var b=0;b<c.length;b++){a.push([this.process_time(c[b][0]),this.process_time(c[b][1])])}this.p.range_off=a;return this},set_range_off:function(a){this.p.range_off=a;this.process_range_off();return this.update_status()},get_range_off:function(a){return this.p.range_off},set_format:function(a){this.p.format=a;return this.update_field_value()},get_format:function(){return this.p.format},set_server_format:function(a){this.p.server_format=a;return this.update_field_value()},get_server_format:function(){return this.p.server_format},set_radius:function(a){this.p.radius=a;return this.render()},get_radius:function(){return this.p.radius},set_always_simple:function(a){this.p.always_simple=a;return this.render()},get_always_simple:function(){return this.p.always_simple},set_sun:function(a){this.p.sun=a;ng.get(this.id+"_hour_12").set_html(a);return this},get_sun:function(){return this.p.sun},set_moon:function(a){this.p.moon=a;ng.get(this.id+"_hour_0").set_html(a);return this},get_moon:function(){return this.p.moon},set_close_on_select:function(a){this.p.close_on_select=a;return this},get_close_on_select:function(){return this.p.close_on_select},set_use24:function(a){this.p.use24=a;return this.render()},get_use24:function(){return this.p.use24}});ng.map_html5_prop("time",{min:"start",max:"end"});if(ng.defined(ng.UI)){ng.UI.add_to_ini("ng-timepicker",function(a){ng.UI.common_ini(a,ng.TimePicker)})};

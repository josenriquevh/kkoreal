/*
 * NoGray JavaScript Library
 *
 * Copyright (c), All right reserved
 * Gazing Design - http://www.NoGray.com
 * http://www.nogray.com/license.php
 */

(function(){if(!ng_config.use_ui){return}if((ng.browser.ie)&&(ng.browser.get_ie_version()<9)){return}ng.Assets.load_style(ng_config.assets_dir+"css/"+ng_config.css_skin_prefix+"ui.css");if(ng_config.load_icons){ng.Assets.load_style(ng_config.assets_dir+"css/"+ng_config.css_skin_prefix+"icons.css")}ng.UI={ini_funcs:{},add_to_ini:function(b,c){ng.UI.ini_funcs[b]=c},common_ini:function(c,b){var c=ng.get(c);if(c.getAttribute("data-ng_skip")=="1"){return}c.setAttribute("data-ng_skip","1");new b(c)},ini:function(){ng.obj_each(ng.UI.ini_funcs,function(c,b){ng.UI.create(b,c,document.body)})},create:function(b,f,d){var e=ng.get(d).get_children_by_class_name(b,"");for(var c=0;c<e.length;c++){if(e[c].getAttribute("data-ng_skip")!="1"){f(e[c])}}},match_buttons_height:function(c){var b=0;ng.get(c).get_children_by_class_name("ng-button","*",function(d){b=Math.max(b,d.get_style("height").to_int())});if(b==0){return}ng.get(c).get_children_by_class_name("ng-button","*",function(d){d.set_style("height",b)})}};var a=function(e){if(e.getAttribute("data-ng_skip")=="1"){return}if(e.get("tag")=="label"){var d=e.getElementsByTagName("input");if(d.length){d=ng.get(d[0]);e.append_element(d,"after");d.set_style("display","none");var b=d.type.toLowerCase();var c=ng.create("a",{className:d.className+" "+b,html:e.innerHTML});if(ng.defined(e.dataset)){ng.obj_each(e.dataset,function(h,g){c.dataset[g]=e.dataset[g]})}c.setAttribute("data-stop_default","1");if(d.checked){c.setAttribute("data-checked","1")}if(d.disabled){c.setAttribute("data-disabled","1")}e.append_element(c,"before");e.remove_element();var e=f(c);e.p.input_field=d;if(b=="radio"){if(!ng.defined(ng.radio_buttons)){ng.radio_buttons={}}if(d.checked){ng.radio_buttons[d.name]=e}e.add_event("click",function(){if(ng.defined(ng.radio_buttons[this.p.input_field.name])){ng.radio_buttons[this.p.input_field.name].uncheck()}this.p.input_field.checked=true;ng.radio_buttons[this.p.input_field.name]=this;this.check()})}else{if(d.type.toLowerCase()=="checkbox"){e.add_event("click",function(){this.p.input_field.checked=!this.p.input_field.checked;if(this.p.input_field.checked){this.check()}else{this.uncheck()}})}}}}else{f(e)}function f(l){var m=l.get("data-split");if((ng.defined(m))&&(m!="")){var n=ng.create("span",{className:"ng-split-button"});l.append_element(n,"before");n.append_element(l);var j=ng.create(l.get("tag"),{className:l.className});j.setAttribute("data-options",m);n.append_element(j);f(j)}var g=l.get("data-options");var k;if((ng.defined(g))&&(g!="")){k=new ng.Component();var h=k.get_content_div();g=ng.get(g);h.remove_class("ng-comp-main-div").append_element(g);g.add_class("ng-floating").remove_class("ng-sub-buttons");g.add_event("mouseup",function(p){k.close()});l.setAttribute("data-stop_default",1)}var o=l.className.replace("ng-button","").trim();if(o!=""){l.setAttribute("data-ui_class",o)}var i=new ng.Button(l);if(ng.defined(k)){i.set_component(k).show_component()}return i}};ng.UI.add_to_ini("ng-button",a);ng.UI.add_to_ini("ng-buttons-horizontal",ng.UI.match_buttons_height);ng.ready(ng.UI.ini)})();

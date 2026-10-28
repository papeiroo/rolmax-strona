/* Rolmax — warstwa interakcji motywu (bez zależności) */
(function(){
"use strict";
var RM = matchMedia("(prefers-reduced-motion: reduce)").matches;
var $ = function(s,r){return (r||document).querySelector(s);};
var $$ = function(s,r){return Array.prototype.slice.call((r||document).querySelectorAll(s));};

/* ---------- Sceny canvas (rysowane na żywo) ---------- */
function rnd(seed){var s=seed||1;return function(){s=(s*16807)%2147483647;return (s-1)/2147483646;};}
var scenes=[];
function Scene(cv){
  this.cv=cv;this.ctx=cv.getContext("2d");this.type=cv.dataset.scene;this.tractor=!!cv.dataset.tractor;this.big=!!cv.dataset.big;
  this.t=0;this.visible=true;this.parts=[];this.seed=(this.type.length*997)%9973+3;this.resize();
}
Scene.prototype.resize=function(){
  var r=this.cv.getBoundingClientRect(),dpr=Math.min(window.devicePixelRatio||1,2);
  this.w=Math.max(1,r.width);this.h=Math.max(1,r.height);
  this.cv.width=Math.round(this.w*dpr);this.cv.height=Math.round(this.h*dpr);
  this.ctx.setTransform(dpr,0,0,dpr,0,0);
  var R=rnd(this.seed);this.parts=[];
  var n=Math.round(this.w*this.h/9000);
  for(var i=0;i<Math.min(n,160);i++)this.parts.push({x:R()*this.w,y:R()*this.h,r:R()*1.6+.3,v:R()*.25+.05,a:R()*.6+.2,p:R()*6.28});
  this.bg=null;this.draw();
};
Scene.prototype.paintBG=function(){
  var w=this.w,h=this.h,o=document.createElement("canvas"),dpr=this.cv.width/w;
  o.width=this.cv.width;o.height=this.cv.height;var c=o.getContext("2d");c.setTransform(dpr,0,0,dpr,0,0);
  var R=rnd(this.seed),T=this.type;
  if(T==="field"||T==="dusk"||T==="rows"){
    var hz = T==="rows"? h*.32 : h*.58;
    var sky=c.createLinearGradient(0,0,0,hz);
    if(T==="dusk"){sky.addColorStop(0,"#000B26");sky.addColorStop(.6,"#0A2C6E");sky.addColorStop(1,"#C46A3A");}
    else{sky.addColorStop(0,"#000B26");sky.addColorStop(.45,"#00205B");sky.addColorStop(.82,"#3D5C9C");sky.addColorStop(1,"#F2C46B");}
    c.fillStyle=sky;c.fillRect(0,0,w,hz+2);
    var sx=T==="dusk"?w*.3:w*.68,sg=c.createRadialGradient(sx,hz,0,sx,hz,Math.max(w,h)*.55);
    sg.addColorStop(0,"rgba(255,214,130,.95)");sg.addColorStop(.08,"rgba(255,190,90,.55)");sg.addColorStop(.35,"rgba(227,176,75,.12)");sg.addColorStop(1,"rgba(227,176,75,0)");
    c.fillStyle=sg;c.fillRect(0,0,w,h);
    var cr=Math.max(14,w*.03),core=c.createRadialGradient(sx,hz,0,sx,hz,cr);core.addColorStop(0,"rgba(255,248,225,1)");core.addColorStop(.35,"rgba(255,226,160,.85)");core.addColorStop(1,"rgba(255,200,110,0)");c.fillStyle=core;c.beginPath();c.arc(sx,hz,cr,0,6.283);c.fill();
    // wzgórza
    var layers=[["#0E2A63",.0,26],["#0A2252",.04,18],["#061A42",.09,12]];
    layers.forEach(function(L,li){
      c.fillStyle=L[0];c.beginPath();c.moveTo(0,h);
      for(var x=0;x<=w;x+=8){var y=hz+h*L[1]-Math.sin(x/(180+li*70)+li*2)*L[2]-Math.sin(x/53+li)*3;c.lineTo(x,y);}
      c.lineTo(w,h);c.closePath();c.fill();
    });
    // pole z rzędami w perspektywie
    var top=hz+h*.1,fg=c.createLinearGradient(0,top,0,h);
    fg.addColorStop(0,"#071E4A");fg.addColorStop(1,"#000B26");
    c.fillStyle=fg;c.fillRect(0,top,w,h-top);
    var vx=sx;c.lineWidth=1;
    for(var i=-40;i<=40;i++){
      var bx=w/2+i*(w/14);
      var lg=c.createLinearGradient(0,top,0,h);lg.addColorStop(0,"rgba(227,176,75,0)");lg.addColorStop(1,"rgba(227,176,75,"+(T==="rows"?.32:.16)+")");
      c.strokeStyle=lg;c.beginPath();c.moveTo(vx+(bx-vx)*.02,top);c.lineTo(bx,h);c.stroke();
    }
    // kłosy na pierwszym planie
    for(var k=0;k<w/5;k++){
      var x=R()*w,hh=h*(.04+R()*.08),y=h+4;
      c.strokeStyle="rgba(227,176,75,"+(.15+R()*.35)+")";c.lineWidth=1;
      c.beginPath();c.moveTo(x,y);c.quadraticCurveTo(x+4,y-hh*.6,x+(R()-.5)*14,y-hh);c.stroke();
      c.fillStyle="rgba(240,200,110,"+(.2+R()*.4)+")";c.beginPath();c.ellipse(x+(R()-.5)*14,y-hh,1.6,5,R()-.5,0,6.283);c.fill();
    }
    this.hz=hz+h*.03;this.sx=sx;
  } else { // workshop / gears
    var g=c.createRadialGradient(w*.7,h*.25,0,w*.7,h*.25,Math.max(w,h)*.9);
    g.addColorStop(0,"#123A85");g.addColorStop(.4,"#00205B");g.addColorStop(1,"#000818");
    c.fillStyle=g;c.fillRect(0,0,w,h);
    // siatka technicznego rysunku
    c.strokeStyle="rgba(255,255,255,.035)";c.lineWidth=1;
    var step=Math.max(28,w/32);
    for(var gx=0;gx<w;gx+=step){c.beginPath();c.moveTo(gx,0);c.lineTo(gx,h);c.stroke();}
    for(var gy=0;gy<h;gy+=step){c.beginPath();c.moveTo(0,gy);c.lineTo(w,gy);c.stroke();}
    // promień światła
    var beam=c.createLinearGradient(w*.8,0,w*.4,h);beam.addColorStop(0,"rgba(255,214,130,.16)");beam.addColorStop(1,"rgba(255,214,130,0)");
    c.fillStyle=beam;c.beginPath();c.moveTo(w*.62,0);c.lineTo(w*.92,0);c.lineTo(w*.6,h);c.lineTo(w*.15,h);c.closePath();c.fill();
  }
  this.bg=o;
};
function gear(c,x,y,r,teeth,rot,col,lw){
  c.save();c.translate(x,y);c.rotate(rot);c.strokeStyle=col;c.lineWidth=lw;c.beginPath();
  var ti=r*.84,n=teeth*2;
  for(var i=0;i<=n;i++){var a0=i/n*6.2832,a1=(i+1)/n*6.2832,rr=i%2?ti:r;c.lineTo(Math.cos(a0)*rr,Math.sin(a0)*rr);c.lineTo(Math.cos(a1)*rr,Math.sin(a1)*rr);}
  c.closePath();c.stroke();
  c.beginPath();c.arc(0,0,r*.55,0,6.283);c.stroke();
  c.beginPath();c.arc(0,0,r*.18,0,6.283);c.stroke();
  for(var s=0;s<6;s++){var a=s/6*6.283;c.beginPath();c.moveTo(Math.cos(a)*r*.18,Math.sin(a)*r*.18);c.lineTo(Math.cos(a)*r*.55,Math.sin(a)*r*.55);c.stroke();}
  c.restore();
}
function tractor(c,x,y,s){
  c.save();c.translate(x,y);c.scale(s,s);c.fillStyle="#000B26";
  c.beginPath();
  c.moveTo(-30,-14);c.lineTo(-30,-44);c.lineTo(-4,-44);c.lineTo(0,-24);c.lineTo(34,-24);c.lineTo(40,-18);c.lineTo(40,-6);c.lineTo(-30,-6);c.closePath();c.fill();
  c.fillRect(22,-34,2.4,10); // wydech
  c.beginPath();c.arc(-18,-6,17,0,6.283);c.fill();
  c.beginPath();c.arc(30,-2,10,0,6.283);c.fill();
  c.fillStyle="rgba(255,214,130,.55)";c.fillRect(-26,-40,18,13); // szyba kabiny
  c.fillStyle="rgba(255,236,190,.9)";c.fillRect(39,-16,2,3); // światło
  c.restore();
}
Scene.prototype.draw=function(){
  var c=this.ctx,w=this.w,h=this.h,t=this.t;
  if(!this.bg)this.paintBG();
  c.clearRect(0,0,w,h);c.drawImage(this.bg,0,0,w,h);
  var T=this.type;
  if(T==="workshop"||T==="gears"){
    var base=Math.min(w,h);
    var g1=this.big?base*.42:base*.36;
    gear(c,w*.78,h*.32,g1,18,t*.0016,"rgba(227,176,75,.38)",1.2);
    gear(c,w*.78-g1*1.55,h*.32+g1*.95,g1*.62,12,-t*.0016*18/12+.13,"rgba(227,176,75,.22)",1);
    gear(c,w*.78+g1*.2,h*.32+g1*1.65,g1*.38,9,t*.0016*18/9,"rgba(255,255,255,.12)",1);
  }
  if((T==="field"||T==="dusk")&&this.tractor){
    var span=w+240,x=((t*.25)%span)-120,y=this.hz;
    // pył za ciągnikiem
    for(var d=0;d<14;d++){c.fillStyle="rgba(240,205,140,"+(.06-d*.004)+")";c.beginPath();c.arc(x-40-d*9,y-6-d*1.2,6+d*2.2,0,6.283);c.fill();}
    tractor(c,x,y,Math.max(.55,w/1600));
  }
  // drobinki światła / pyłki
  for(var i=0;i<this.parts.length;i++){
    var p=this.parts[i],yy=(p.y-t*p.v*.6)%h;if(yy<0)yy+=h;
    var xx=p.x+Math.sin(t*.01+p.p)*8,al=p.a*(.5+.5*Math.sin(t*.02+p.p));
    c.fillStyle=(T==="workshop"||T==="gears")?"rgba(255,214,130,"+al*.5+")":"rgba(255,226,160,"+al*.7+")";
    c.beginPath();c.arc(xx,yy,p.r,0,6.283);c.fill();
  }
};
$$("canvas[data-scene]").forEach(function(cv){scenes.push(new Scene(cv));});
var io = "IntersectionObserver" in window ? new IntersectionObserver(function(es){es.forEach(function(e){var s=scenes.find(function(x){return x.cv===e.target;});if(s)s.visible=e.isIntersecting;});}) : null;
scenes.forEach(function(s){if(io)io.observe(s.cv);});
var rt;window.addEventListener("resize",function(){clearTimeout(rt);rt=setTimeout(function(){scenes.forEach(function(s){if(s.cv.offsetParent!==null)s.resize();});},150);});
function loop(){
  scenes.forEach(function(s){if(s.visible&&s.cv.offsetParent!==null){s.t++;s.draw();}});
  requestAnimationFrame(loop);
}
if(!RM)requestAnimationFrame(loop);


/* ---------- Nagłówek i menu ---------- */
function onScroll(){$$("header.hd").forEach(function(h){h.classList.toggle("solid",window.scrollY>40);});}
window.addEventListener("scroll",onScroll,{passive:true});onScroll();
$$("nav.nav li > button.nl").forEach(function(b){
  b.addEventListener("click",function(e){
    e.stopPropagation();var li=b.parentElement,open=!li.classList.contains("open");
    $$("li.open",li.parentElement).forEach(function(o){o.classList.remove("open");o.firstElementChild.setAttribute("aria-expanded","false");});
    if(open){li.classList.add("open");b.setAttribute("aria-expanded","true");}
  });
});
document.addEventListener("click",function(e){if(!e.target.closest("nav.nav"))$$("nav.nav li.open").forEach(function(o){o.classList.remove("open");o.firstElementChild.setAttribute("aria-expanded","false");});});
document.addEventListener("keydown",function(e){if(e.key==="Escape"){$$("li.open").forEach(function(o){o.classList.remove("open");});$$("nav.nav").forEach(function(n){n.classList.remove("show");});}});
$$(".xopen").forEach(function(b){b.addEventListener("click",function(){$("nav.nav",b.parentElement).classList.add("show");});});
$$(".xclose").forEach(function(b){b.addEventListener("click",function(){b.closest("nav.nav").classList.remove("show");});});


/* ---------- Wstążka maszyn: najechanie na kategorię pokazuje modele ---------- */
$$(".mega-m").forEach(function(m){
  var tabs=$$("[data-mm]",m);
  function pick(t){
    tabs.forEach(function(x){x.setAttribute("aria-selected",String(x===t));});
    $$(".mm-panel",m).forEach(function(p){p.hidden=p.id!=="mmp-"+t.dataset.mm;});
  }
  tabs.forEach(function(t,i){
    t.addEventListener("mouseenter",function(){pick(t);});
    t.addEventListener("focus",function(){pick(t);});
    t.addEventListener("keydown",function(e){
      var n=null;if(e.key==="ArrowDown")n=(i+1)%tabs.length;if(e.key==="ArrowUp")n=(i-1+tabs.length)%tabs.length;
      if(n!==null){e.preventDefault();tabs[n].focus();}
    });
  });
});
/* ---------- Zakładki oddziałów ---------- */
$$("[data-tabs]").forEach(function(box){
  var tabs=$$('[role="tab"]',box),panels=$$('[role="tabpanel"]',box);
  function show(i,focus){
    tabs.forEach(function(t,j){t.setAttribute("aria-selected",String(j===i));t.tabIndex=j===i?0:-1;});
    panels.forEach(function(p,j){p.hidden=j!==i;});
    if(focus)tabs[i].focus();
  }
  tabs.forEach(function(t,i){t.addEventListener("click",function(){show(i);});});
  box.querySelector('[role="tablist"]').addEventListener("keydown",function(e){
    var cur=tabs.findIndex(function(t){return t.getAttribute("aria-selected")==="true";}),n=null;
    if(e.key==="ArrowRight"||e.key==="ArrowDown")n=(cur+1)%tabs.length;
    if(e.key==="ArrowLeft"||e.key==="ArrowUp")n=(cur-1+tabs.length)%tabs.length;
    if(n!==null){e.preventDefault();show(n,true);}
  });
});

/* ---------- Ujawnianie przy przewijaniu (treść widoczna bez JS) ---------- */
if(!RM && "IntersectionObserver" in window){
  var rio=new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting){e.target.classList.remove("pre");rio.unobserve(e.target);}});},{rootMargin:"0px 0px -8% 0px"});
  $$(".rv").forEach(function(el){if(el.getBoundingClientRect().top>window.innerHeight){el.classList.add("pre");rio.observe(el);}});
}

/* ---------- Odliczanie ---------- */
var T0=new Date(2027,0,1).getTime();
function pad(n){return n<10?"0"+n:""+n;}
function tick(){
  var ms=Math.max(0,T0-Date.now()),d=Math.floor(ms/864e5),h=Math.floor(ms%864e5/36e5),m=Math.floor(ms%36e5/6e4);
  $$('[data-cd="d"]').forEach(function(e){e.textContent=d;});
  $$('[data-cd="h"]').forEach(function(e){e.textContent=pad(h);});
  $$('[data-cd="m"]').forEach(function(e){e.textContent=pad(m);});
}
tick();setInterval(tick,20000);

})();

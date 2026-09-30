// usage: node build.js spec.json -> writes <name>.filter and prints ffmpeg args
const fs=require('fs');const spec=JSON.parse(fs.readFileSync(process.argv[2],'utf8'));
const W=1080,H=1350,D=spec.duration;let n=0;const f=[];
const fonts={bold:'fonts/bold.otf',reg:'fonts/reg.otf',mincho:'fonts/mincho.ttc'};
f.push(`[0:v]scale=${W*1.08|0}:-1,zoompan=z='1+0.0015*on':x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':d=1:s=${W}x${H}:fps=30,trim=duration=${D},setpts=PTS-STARTPTS,format=gbrp[bg]`);
f.push(`[1:v]format=gray,loop=-1:1,trim=duration=${D},setpts=PTS-STARTPTS,fps=30,format=gbrp[s1]`);
f.push(`[1:v]format=gray,hflip,vflip,loop=-1:1,trim=duration=${D},setpts=PTS-STARTPTS,fps=30[s2r]`);
f.push(`[s2r]geq=lum='lum(X,Y)*(0.35+0.65*(0.5+0.5*sin(T*2.2)))',format=gbrp[s2]`);
f.push(`[s1][s2]blend=all_mode=lighten[stars]`);
f.push(`[bg][stars]blend=all_mode=screen:all_opacity=0.9[v0]`);let cur='v0';
if(spec.moon){f.push(`[2:v]format=gray,loop=-1:1,trim=duration=${D},setpts=PTS-STARTPTS,fps=30,format=gbrp,colorchannelmixer=rr=1:gg=0.93:bb=0.78[moonc]`);
 f.push(`[${cur}][moonc]blend=all_mode=screen:all_expr='255-(255-A)*(255-B*min(1,T/1.5))/255'[vm]`);cur='vm';}
let chain=[];
for(const b of spec.boxes||[]){chain.push(`drawbox=x=${b.x}:y=${b.y}:w=${b.w}:h=${b.h}:color=${b.color}:t=fill:enable='gte(t,${b.s})'`);
 if(b.border)chain.push(`drawbox=x=${b.x}:y=${b.y}:w=${b.w}:h=${b.h}:color=${b.border}:t=3:enable='gte(t,${b.s})'`);}
for(const t of spec.texts){const tf=`txt_${spec.name}_${n++}.txt`;fs.writeFileSync(tf,t.text);
 const s=t.s,fd=t.fade||0.6;const a=`if(lt(t,${s}),0,if(lt(t,${s+fd}),(t-${s})/${fd},1))`;
 const x=t.x==='c'?'(w-text_w)/2':t.x;const y=`${t.y}+${t.rise??18}*(1-min(1,max(0,(t-${s})/${fd})))`;
 chain.push(`drawtext=fontfile=${fonts[t.font||'bold']}:textfile=${tf}:fontsize=${t.size}:fontcolor=${t.color||'#e8e2f5'}:x=${x}:y='${y}':alpha='${a}'`+(t.shadow!==false?`:shadowcolor=black@0.55:shadowx=0:shadowy=3`:''));}
chain.push(`fade=t=in:st=0:d=0.5,fade=t=out:st=${D-0.6}:d=0.6,format=yuv420p`);
f.push(`[${cur}]${chain.join(',')}[out]`);
fs.writeFileSync(spec.name+'.filter',f.join(';\n'));

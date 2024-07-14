import{Q as $,c as m,r as F,T as L,w as T,o as a,a as n,b as _,u as s,d as e,t as u,e as U,f,v as g,g as c,F as h,h as y,n as w,i as z,Z as D}from"./app-CAgGloY0.js";import{_ as N}from"./Navbar-Cfw6XusM.js";import{F as M}from"./Footer-DfdxnOgc.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const R={class:"flex mt-10 mb-10 items-center justify-center"},E=e("p",{class:"mr-4 font-bold text-lg"},"Your landing page is here: ",-1),O=["href"],Q={class:"flex flex-col max-w-5xl flex-row mx-auto justify-center mt-10 mb-20"},Y=e("h1",{class:"text-2xl text-center items-center font-bold mb-8 mt-6"},"Appearance",-1),Z={class:"flex flex-col md:flex-row"},q={class:"flex-1"},G={class:"w-full"},H=e("label",{for:"slug",class:"text-lg font-bold"},"Slug: ",-1),J={key:0},K={class:"w-full"},W=e("label",{for:"profile_image",class:"text-lg font-bold"},"Profile Image: ",-1),X={key:0,class:"mb-2 mt-2"},A=["src"],ee={class:"w-full"},te=e("label",{for:"profile_title",class:"text-lg font-bold"},"Profile Title: ",-1),oe={key:0},se={class:"w-full flex flex-col"},le=e("label",{for:"bio",class:"text-lg font-bold"},"Bio: ",-1),ie={key:0},re={class:"w-full"},ae=e("label",{for:"theme",class:"text-lg font-bold"},"Background Image: ",-1),ne={class:"flex gap-2 mt-2 mb-2"},ue=["src","onClick"],ce={class:"theme-option w-24 h-24 bg-gray-100 border-2 border-dashed border-gray-300 rounded flex items-center justify-center relative cursor-pointer"},de={key:0,class:"text-gray-500"},me=["src"],_e={key:0},fe=["disabled"],ge={class:"flex-1 mx-auto justify-center items-center text-center mt-16 md:mt-0"},he={class:"mockup-phone"},be=e("div",{class:"camera"},null,-1),pe={class:"display"},ve=e("h2",{class:"text-xl font-bold mb-4"},"Live Preview",-1),xe=["src"],ke={class:"text-lg font-semibold"},ye={class:"mt-8 flex items-center justify-center"},we=["href"],Se=["src"],je={class:"w-full text-white text-center"},Fe={__name:"Appearance",setup(Ie){var p,v,x,k;const b=$(),l=m(()=>b.props.appearance),S=m(()=>b.props.links),d=F("");function j(o){const r=o.target.files[0];r&&(t.theme="custom",t.custom_background_image=r,d.value=URL.createObjectURL(r))}const t=L({slug:((p=l.value)==null?void 0:p.slug)||"",profile_image:null,profile_title:((v=l.value)==null?void 0:v.profile_title)||"",bio:((x=l.value)==null?void 0:x.bio)||"",theme:((k=l.value)==null?void 0:k.theme)||"",custom_background_image:null}),I=[{name:"theme1",image:"/images/themes/theme1.png"},{name:"theme2",image:"/images/themes/theme2.png"},{name:"theme3",image:"/images/themes/theme3.png"}];function B(o){t.theme=o,t.custom_background_image=null,d.value=""}T(l,o=>{t.profile_title=(o==null?void 0:o.profile_title)||"",t.bio=(o==null?void 0:o.bio)||"",t.theme=(o==null?void 0:o.theme)||"",t.slug=(o==null?void 0:o.slug)||""});const P=m(()=>{var o,r;return t.theme==="custom"&&d.value?{backgroundImage:`url(${d.value})`,backgroundSize:"cover",backgroundPosition:"center"}:((o=l.value)==null?void 0:o.theme)==="custom"&&((r=l.value)!=null&&r.custom_background_image)?{backgroundImage:`url(${l.value.custom_background_image})`,backgroundSize:"cover",backgroundPosition:"center"}:{}});function C(){const o=new FormData;o.append("slug",t.slug),t.profile_image&&o.append("profile_image",t.profile_image),o.append("profile_title",t.profile_title),o.append("bio",t.bio),o.append("theme",t.theme),t.custom_background_image&&o.append("custom_background_image",t.custom_background_image),l.value&&l.value.id?t.post(`/appearances/${l.value.id}`,{preserveScroll:!0,onSuccess:()=>{t.reset("profile_image")},data:o}):t.post("/appearances",{preserveScroll:!0,onSuccess:()=>{t.reset("profile_image")},data:o})}const V=m(()=>{var o;return(o=l.value)!=null&&o.theme?l.value.theme:""});return(o,r)=>(a(),n(h,null,[_(s(D),{title:"Appearance"}),_(N),e("div",R,[E,e("a",{class:"btn btn-neutral",href:`/${l.value.slug}`},"/"+u(l.value.slug),9,O)]),e("div",Q,[Y,e("div",Z,[e("div",q,[e("form",{onSubmit:U(C,["prevent"]),class:"flex flex-col gap-6 items-center justify-center"},[e("div",G,[H,f(e("input",{id:"slug","onUpdate:modelValue":r[0]||(r[0]=i=>s(t).slug=i),placeholder:"Slug",class:"mt-2 mb-2 input input-bordered w-full max-w-xs"},null,512),[[g,s(t).slug]]),s(t).errors.slug?(a(),n("div",J,u(s(t).errors.slug),1)):c("",!0)]),e("div",K,[W,l.value&&l.value.profile_image?(a(),n("div",X,[e("img",{src:l.value.profile_image,class:"w-24 h-24 rounded-full object-cover",alt:"Profile Image"},null,8,A)])):c("",!0),e("input",{type:"file",onInput:r[1]||(r[1]=i=>s(t).profile_image=i.target.files[0]),class:"mt-2 mb-2 file-input file-input-bordered w-full max-w-xs"},null,32)]),e("div",ee,[te,f(e("input",{id:"profile_title","onUpdate:modelValue":r[2]||(r[2]=i=>s(t).profile_title=i),placeholder:"Profile Title",class:"mt-2 mb-2 input input-bordered w-full max-w-xs"},null,512),[[g,s(t).profile_title]]),s(t).errors.profile_title?(a(),n("div",oe,u(s(t).errors.profile_title),1)):c("",!0)]),e("div",se,[le,f(e("input",{id:"bio","onUpdate:modelValue":r[3]||(r[3]=i=>s(t).bio=i),placeholder:"Bio",class:"mt-2 mb-2 input input-bordered w-full max-w-xs"},null,512),[[g,s(t).bio]]),s(t).errors.bio?(a(),n("div",ie,u(s(t).errors.bio),1)):c("",!0)]),e("div",re,[ae,e("div",ne,[(a(),n(h,null,y(I,i=>e("div",{key:i.name,class:"theme-option"},[e("img",{src:i.image,onClick:Be=>B(i.name),class:w([{"border-2 w-24 rounded border-primary-content":s(t).theme===i.name},"w-24 h-24 object-cover cursor-pointer"])},null,10,ue)])),64)),e("div",ce,[e("input",{type:"file",onChange:j,class:"absolute inset-0 opacity-0 cursor-pointer"},null,32),d.value?c("",!0):(a(),n("span",de,"+")),d.value?(a(),n("img",{key:1,src:d.value,class:"w-full h-full object-cover rounded"},null,8,me)):c("",!0)])]),s(t).errors.theme?(a(),n("div",_e,u(s(t).errors.theme),1)):c("",!0)]),e("button",{type:"submit",class:"btn btn-neutral pr-8 pl-8 md:w-full",disabled:s(t).processing},"Save",8,fe)],32)]),e("div",ge,[e("div",he,[be,e("div",pe,[e("div",{class:w([V.value,"artboard artboard-demo bg-cover phone-1"]),style:z(P.value)},[ve,e("img",{src:l.value.profile_image,class:"w-24 h-24 rounded-full object-cover mx-auto",alt:"Profile Image"},null,8,xe),e("h3",ke,u(s(t).profile_title),1),e("p",null,u(s(t).bio),1),e("div",ye,[e("ul",null,[(a(!0),n(h,null,y(S.value,i=>(a(),n("li",{key:i.id,class:"relative my-2"},[e("a",{href:i.url,target:"_blank",class:"relative flex py-2 bg-neutral hover:bg-accent-content hover:grow hover:scale-105 transition-transform duration-200 items-center w-72 px-2 pt-2 pb-2 border rounded font-bold"},[i.image?(a(),n("img",{key:0,src:i.image,class:"absolute left-2 w-10 h-10 flex-shrink-0 rounded-full object-cover",alt:"Link Image"},null,8,Se)):c("",!0),e("p",je,u(i.name),1)],8,we)]))),128))])])],6)])])])])]),_(M)],64))}};export{Fe as default};
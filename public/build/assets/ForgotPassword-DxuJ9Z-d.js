import{T as u,o as r,j as d,k as i,b as a,u as s,Z as c,a as p,t as f,g as _,d as t,l as w,n as g,e as y}from"./app-DFKW-8X9.js";import{_ as b}from"./GuestLayout-kTVbfY0v.js";import{_ as k,a as x,b as V}from"./TextInput-fhZodwZp.js";import{P as h}from"./PrimaryButton-C_4RD5cw.js";import"./ApplicationLogo-CqmhnfJQ.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const v=t("div",{class:"mb-4 text-sm text-gray-600"}," Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. ",-1),B={key:0,class:"mb-4 font-medium text-sm text-green-600"},N={class:"flex items-center justify-end mt-4"},T={__name:"ForgotPassword",props:{status:{type:String}},setup(o){const e=u({email:""}),m=()=>{e.post(route("password.email"))};return(P,l)=>(r(),d(b,null,{default:i(()=>[a(s(c),{title:"Forgot Password"}),v,o.status?(r(),p("div",B,f(o.status),1)):_("",!0),t("form",{onSubmit:y(m,["prevent"])},[t("div",null,[a(k,{for:"email",value:"Email"}),a(x,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":l[0]||(l[0]=n=>s(e).email=n),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),a(V,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),t("div",N,[a(h,{class:g({"opacity-25":s(e).processing}),disabled:s(e).processing},{default:i(()=>[w(" Email Password Reset Link ")]),_:1},8,["class","disabled"])])],32)]),_:1}))}};export{T as default};

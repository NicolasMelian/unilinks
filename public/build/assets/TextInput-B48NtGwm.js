import{e as r,x as c,o as t,a as s,b as d,t as l,m,C as p,p as _,q as f,v}from"./app-cf6BoR5w.js";const g={class:"text-sm text-red-600"},S={__name:"InputError",props:{message:{type:String}},setup(e){return(a,o)=>r((t(),s("div",null,[d("p",g,l(e.message),1)],512)),[[c,e.message]])}},x={class:"block font-medium text-sm text-gray-700"},h={key:0},y={key:1},V={__name:"InputLabel",props:{value:{type:String}},setup(e){return(a,o)=>(t(),s("label",x,[e.value?(t(),s("span",h,l(e.value),1)):(t(),s("span",y,[m(a.$slots,"default")]))]))}},M={__name:"TextInput",props:{modelValue:{type:String,required:!0},modelModifiers:{}},emits:["update:modelValue"],setup(e,{expose:a}){const o=p(e,"modelValue"),n=_(null);return f(()=>{n.value.hasAttribute("autofocus")&&n.value.focus()}),a({focus:()=>n.value.focus()}),(b,u)=>r((t(),s("input",{class:"border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm","onUpdate:modelValue":u[0]||(u[0]=i=>o.value=i),ref_key:"input",ref:n},null,512)),[[v,o.value]])}};export{V as _,M as a,S as b};

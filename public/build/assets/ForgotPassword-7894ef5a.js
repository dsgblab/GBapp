import{T as u,o as m,e as n,b as e,u as a,w as o,F as d,Z as f,t as p,f as _,a as t,n as g,i as b,g as v,j as x}from"./app-826d0887.js";import{A as h}from"./AuthenticationCard-bb2a6f94.js";import{_ as w}from"./AuthenticationCardLogo-6fe29cdc.js";import{_ as y}from"./InputError-4ed85ba8.js";import{_ as V}from"./InputLabel-6da3f361.js";import{_ as C}from"./PrimaryButton-6b407ce1.js";import{_ as N}from"./TextInput-3032170e.js";import"./_plugin-vue_export-helper-c27b6911.js";const S=t("div",{class:"mb-4 text-sm text-gray-600"}," ¿Has olvidado tu contraseña? Ningún problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace de restablecimiento de contraseña que le permitirá elegir una nueva. ",-1),$={key:0,class:"mb-4 font-medium text-sm text-green-600"},k=["onSubmit"],F={class:"flex items-center justify-end mt-4"},I={__name:"ForgotPassword",props:{status:String},setup(r){const s=u({email:""}),l=()=>{s.post(route("password.email"))};return(A,i)=>(m(),n(d,null,[e(a(f),{title:"¿Has olvidado tu contraseña?"}),e(h,null,{logo:o(()=>[e(w)]),default:o(()=>[S,r.status?(m(),n("div",$,p(r.status),1)):_("",!0),t("form",{onSubmit:x(l,["prevent"])},[t("div",null,[e(V,{for:"email",value:"Correo electrónico"}),e(N,{id:"email",modelValue:a(s).email,"onUpdate:modelValue":i[0]||(i[0]=c=>a(s).email=c),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),e(y,{class:"mt-2",message:a(s).errors.email},null,8,["message"])]),t("div",F,[e(C,{class:g({"opacity-25":a(s).processing}),disabled:a(s).processing},{default:o(()=>[e(a(b),{icon:"paper-plane",class:"mr-2"}),v(" Enviar enlace ")]),_:1},8,["class","disabled"])])],40,k)]),_:1})],64))}};export{I as default};
